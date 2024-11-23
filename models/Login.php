<?php

class Login
{
    private $username;
    private $password;

    public function __construct($username, $password)
    {
        $this->username = $username;
        $this->password = $password;
        
    }

    public static function login($username, $password): void
    {
        require_once '../base/Database.php';
        $res = $base->request("SELECT count(*) as connection FROM User WHERE user_pseudo = '{$username}' and user_password = '{$password}'");
        print_r($res[0]['connection']);
    }
}

    Login::login($_POST['username'], $_POST['password']);
    