<?php

namespace App\Controllers;

use Config\Database;
use Core\Controller;
USE PDO;
use PDOException;

class AuthController extends Controller
{
    public function login()
    {

        if(session_status() === PHP_SESSION_NONE) session_start();

        if(!isset($_SESSION['csrf_token'])) {
            $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
        }

        $success = ($_GET['registered'] ?? '') === 'success' ? 'Account created! Please sign in.' : null;


        return $this->render('auth.login', ['success' => $success]);
    }

    public function register()
    {
        if(session_status() === PHP_SESSION_NONE) session_start();

        if(!isset($_SESSION['csrf_token'])) {
            $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
        }
        return $this->render('auth.register');
    }

    public function postLogin($data)
    {
        session_start();
    
        if(!isset($_POST['csrf_token']) || $_POST['csrf_token'] !== $_SESSION['csrf_token']) {
            die("Erreur CSRF");
        }

        $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
        $password = $_POST['password'] ?? '';

        $db = Database::getInstance()->getConnection();

        $stmt = $db->prepare("SELECT * FROM users WHERE email = :email");
        $stmt->execute(['email' => $email]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if($user && password_verify($password, $user['password'])){
            $_SESSION['user_id'] = $user['id_user'];
            $_SESSION['user_nom'] = $user['nom'];
            $_SESSION['user_role'] = $user['role'];

            header('Location: ' . $this->view->shared('base_url') . '/dashboard');
            exit;
        }

        return $this->render('auth.login', ['error' => 'Email ou mot de passe incorrect']);

    }

    public function postRegister() 
    {
        if(session_status() === PHP_SESSION_NONE) session_start();

        if(!isset($_POST['csrf_token']) || $_POST['csrf_token'] !== $_SESSION['csrf_token']) {
            die('Erreur CSRF');
        }

        $name = $_POST['name'];
        $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
        $password = $_POST['password'];

        if($password !== $_POST['confirm_password']) {
            return $this->render('auth.register', ['error' => 'Passwords do not match']);
        }

        $db = Database::getInstance()->getConnection();

        try {
            $hashedPassword = password_hash($password, PASSWORD_BCRYPT);

            $stmt = $db->prepare("INSERT INTO users (nom, email, password, role) 
                                    VALUES (:nom, :email, :password, :role)");
            $stmt->execute([
                'nom' => $name,
                'email' => $email,
                'password' => $hashedPassword,
                'role' => 'etudiant'
            ]);

            header('Location: ' . $this->view->shared('base_url') . '/login?registered=success');
            exit;
        } catch (PDOException $e) {
            if($e->getCode() == 23505) {
                return $this->render('auth.register', ['error' => 'This email is already in use']);
            }

            return $this->render('auth.register', ['error' => 'Registration Failed']);
        }
    }

    public function logout()
    {
        if(session_status() === PHP_SESSION_NONE) session_start();

        session_unset();
        session_destroy();


        if(ini_get('session.use_cookies')) {
            $params = session_get_cookie_params();
            setcookie(session_name(), '', time() - 42000, 
                $params['path'], $params['domain'],
                $params['secure'], $params['httponly']
            );
        }

        
        header('Location: ' . $this->view->shared('base_url') . '/');
        exit;
    }
}
