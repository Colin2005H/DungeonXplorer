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
            #connection succed
            echo "connection (TODO rediriger vers choix personnage)";
        }else{
            #connection failed
            echo "connection failed";
            //require_once 'views/signin.php';
            

        }
        
    }

    public function deleteAccount(){
        session_start(); 
        require_once './base/Database.php';

        if (isset($_SESSION["username"])) {
            $username = $_SESSION["username"];
            $GLOBALS["base"]->request("DELETE FROM User WHERE user_pseudo = '$username'");
            echo "Compte supprimé";
            session_destroy(); 
        } else {
            echo "Non connecté";
        }
    }
   
    
}