<?php

require_once 'session/sessionStorage.php';

class HeroChoiceController {

    private $adventure;
    private $userID;

    public function __construct(){
            if(isset($_SESSION['adventure']) && isset($_SESSION['id'])){
                $this->adventure = $_SESSION['adventure'];
                $this->userID = $_SESSION['id'];
            }
    }


    public function show(){
        if(isset($this->adventure)){

            require_once './views/adventure_choice.php';
            return;
            
        }else{

            header('Location: ./');
            exit;
        }
        
    }

    public function processHeroChoice() {
        require_once '../session/Hero.php';

        require_once '../views/hero_choice.php';

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $heroId = $_POST['hero_id'];
        
            if (!empty($heroId)) {
                //recuperer les données du hero selectionné
                $selectedHero = Hero::getHero($heroId);
        
               //je ne sais pas vers quelle page rediriger pour le moement
        
        
                exit();
            } else {
                echo "Veuillez sélectionner un héros.";
            }
        
    }
    }
}
