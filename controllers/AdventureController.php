<?php
require_once 'session/sessionStorage.php';
require_once 'base/Database.php';


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

            header('Location: home');
            exit;
        }
    }

    public function goThrow(){
        
        if(isset($_POST['ad_id'])){
            $ad_id = $_POST['ad_id'];
            if($GLOBALS['base']->request("SELECT COUNT(*) as nb FROM Quest WHERE adventure_id = {$ad_id} AND hero_id in (SELECT id as hero_id FROM Hero WHERE user_id = {$_SESSION['id']})")[0]['nb']){
                
                $this->loadOld($ad_id);

            }else{

                $this->startNew($ad_id);
            }
        }else{

            header('Location: adventure');
            exit;
        }
    }



    public function loadOld($adventureID){

        Session::loadData($GLOBALS['base']->request("SELECT * FROM Quest WHERE adventure_id = {$adventureID} AND hero_id in (SELECT id as hero_id FROM Hero WHERE user_id = {$_SESSION['id']})")[0]['id']);

        header('Location: chapter');
        exit;
    }

    public function startNew($adventureID){

        $_SESSION['adventure'] = $adventureID;

        header('Location: herocreation');
        exit;
    }



}
