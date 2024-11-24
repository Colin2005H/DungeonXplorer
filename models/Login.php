<?php

class Login
{

    public static function login($username, $password): int{
        require_once '../base/Database.php';
        return $GLOBALS["base"]->request("SELECT count(*) as connection FROM User WHERE user_pseudo = '{$username}' and user_password = '{$password}'")[0]['connection'];
    }
}

if(Login::login($_POST['username'], $_POST['password'])){
    #connection succed
    echo "connection (TODO rediriger vers choix personnage)";
}else{
    #connection failed
    echo "echec (TODO rediriger vers home)";
}
