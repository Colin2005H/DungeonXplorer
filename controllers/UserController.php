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
        
            //verifie si l'utilisateur a dejà un hero
            if($GLOBALS["base"]->request("SELECT count(*) as nb_hero FROM User WHERE user_id in (Select user_id from hero)")>0){ 
                //redirige vers la page de choix de hero
                require_once 'views/adventure_choice.php';
            }
            else{
                //redirige vers la page de creation de hero
                require_once 'views/hero_choice.php';
            }
        }
        else{
            #connection failed
            echo "connection failed";
            //require_once 'views/signin.php';
            

        }
        
    }
   
}