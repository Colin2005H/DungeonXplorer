<?php
session_start();
require_once 'base/Database.php';

class ProfileController{

    private $username;

    public function __construct(){

        if (isset($_SESSION["username"])) {
            $this->username = $_SESSION["username"];
        } else {
            $this->username = "Invité"; 
        }
    }

    public function show(){
        
        if (isset($_SESSION["id"])) {
            
            require_once 'views/profil.php';
            return;

        }else{

            header('Location: ./');
            exit;
        }
        
    }

    public function deleteAccount(){

        if (isset($_SESSION["id"])) {
            
            $id = $_SESSION["id"];
            $GLOBALS["base"]->request("DELETE FROM User WHERE user_id = '$id'");

            //TODO delete everything related to te user
            $GLOBALS["base"]->request("DELETE FROM Hero WHERE user_id = '$id'");

            session_destroy();
        }

        header('Location: ./');
        exit;
    }

    public function disconnect(){

        session_destroy();
        header('Location: ./');
        exit;
    }
}