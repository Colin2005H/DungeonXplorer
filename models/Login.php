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
        $query = $db->query("SELECT count(*) FROM  WHERE user_pseudo = {$username}; and user_password = {$password}");
        var_dump($query);

    }
    }
    Login::login($_POST["username"], $_POST["password"]);
    echo"coucou";