<?php
session_start();
require_once './base/Database.php';

class SignController {

    public function signin() {
        require_once 'views/signin.php';
    }

    public function signup() {
        require_once 'views/signup.php';
    }

    public function testSignin(){
        
        $logSuccess = $GLOBALS["base"]->request("SELECT count(*) as connection FROM User WHERE user_pseudo = '{$_POST["username"]}' and user_password = '{$_POST["password"]}'")[0]['connection'];
        
        if($logSuccess){
            

            // Set session variables
            $userData = $GLOBALS["base"]->request("SELECT * FROM User WHERE user_pseudo = '{$_POST["username"]}'")[0];
            $_SESSION["username"] = $userData["user_pseudo"];
            $_SESSION["email"] = $userData["user_email"];
            $_SESSION["id"] = $userData["user_id"];
            
            header('Location: ./adventure');
            exit;

        }else{

            header('Location: ./signin');
            exit;
        }
    }

    public function register(){
        
        $GLOBALS['base']->request("INSERT INTO User(user_email, user_password, user_pseudo) VALUES ('{$_POST['email']}','{$_POST['password']}','{$_POST['username']}')");
        
        $userData = $GLOBALS["base"]->request("SELECT * FROM User WHERE user_pseudo = '{$_POST["username"]}'")[0];
        $_SESSION["username"] = $userData["user_pseudo"];
        $_SESSION["email"] = $userData["user_email"];
        $_SESSION["id"] = $userData["user_id"];
            
        header('Location: ./adventure');
        exit;
    }
}

            /*
        
            //verifie si l'utilisateur a dejà un hero
            if($GLOBALS["base"]->request("SELECT count(*) as nb_hero FROM User WHERE user_id in (Select user_id from hero)")>0){ 
                //redirige vers la page de choix de hero
                require_once 'views/adventure_choice.php';
            }
            else{
                //redirige vers la page de creation de hero
                require_once 'views/hero_choice.php';
            }  
            */