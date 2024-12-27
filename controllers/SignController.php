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
            $userData = $GLOBALS["base"]->request("SELECT * FROM User WHERE user_pseudo = '{$_POST["username"]}'")[0];

            // Set session variables
            $_SESSION["username"] = $userData["user_pseudo"];
            $_SESSION["email"] = $userData["user_email"];
            $_SESSION["id"] = $userData["user_id"];
            
            header('Location: ./adventure');
            exit;

        }else{
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

            header('Location: ./signin');
            exit;
        }
    }

    public function deleteAccount(){

        if (isset($_SESSION["id"])) {
            
            $id = $_SESSION["id"];
            $GLOBALS["base"]->request("DELETE FROM User WHERE user_id = '$id'");

            //TODO delete everything related to te user
            $GLOBALS["base"]->request("DELETE FROM Hero WHERE user_id = '$id'");

            echo "Compte supprimé";
            session_destroy();
        }

        header('Location: ./');
        exit;
    }

    public function logOut(){

        session_start(); 
        session_destroy();
        header('Location: ./');
        exit;
    }
}