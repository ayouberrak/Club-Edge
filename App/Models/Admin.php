<?php

namespace App\Models;

class Admin extends User
{
    public function __construct(?int $id_user = null, string $nom = "", string $email = "", string $password = "")
    {
        parent::__construct($id_user, $nom, $email, $password, 'admin');
    }
}