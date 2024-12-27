<?php
session_start();
require_once './base/Database.php';


class AdventureController{

    private $adventures;


    public function __construct(){
        $this->adventures = $GLOBALS["base"]->request("SELECT * FROM Adventure");
    }


    public function show(){
        if(isset($_SESSION["id"])){          

            require_once 'views/adventure_choice.php';
            return;

        }else{

            header('Location: ./');
            exit;
        }
    }

    public function startNew($adventureID){

        $_SESSION['adventure'] = $adventureID;

        header('Location: ./herocreation');
        exit;
    }



}
