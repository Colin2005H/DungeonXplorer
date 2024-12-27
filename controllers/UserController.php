<?php
class UserController {
    public function login() {
        require_once 'views/signin.php';
        
    }
    public function signup() {
        require_once 'views/signup.php';
        
    }

    public function testLogin(){
        require_once './base/Database.php';
        $logSuccess = $GLOBALS["base"]->request("SELECT count(*) as connection FROM User WHERE user_pseudo = '{$_POST["username"]}' and user_password = '{$_POST["password"]}'")[0]['connection'];
        
        if($logSuccess){
            $userData = $GLOBALS["base"]->request("SELECT * FROM User WHERE user_pseudo = '{$_POST["username"]}'")[0];

            // Set session variables
            session_start();
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
            #connection failed
            echo "connection failed";
            require_once 'views/signin.php';
            

        }
        
    }

    public function deleteAccount(){
        session_start(); 
        require_once './base/Database.php';

        if (isset($_SESSION["id"])) {
            $id = $_SESSION["id"];
            $GLOBALS["base"]->request("DELETE FROM Hero WHERE user_id = '$id'");
            $GLOBALS["base"]->request("DELETE FROM User WHERE user_id = '$id'");
            echo "Compte supprimé";
            session_destroy();
            require_once 'views/homePage.php';

        } else {
            echo "Non connecté";
        }
    }

    public function logOut(){
        session_start(); 
        session_destroy();

        header('Location: ./');
        exit;
    }
   
}