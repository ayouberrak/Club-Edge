<?php

namespace App\Controllers;

use Core\Controller;

class AuthController extends Controller
{
    public function login()
    {
        return $this->render('auth.login');
    }

    public function register()
    {
        return $this->render('auth.register');
    }

      public function postLogin($data)
    {
        // Mock login
        header('Location: ' . $this->view->shared('base_url') . '/dashboard');
        exit;
    }

    public function logout()
    {
        header('Location: ' . $this->view->shared('base_url') . '/');
        exit;
    }
}
