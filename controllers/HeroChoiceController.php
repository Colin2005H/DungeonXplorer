<?php

require_once 'session/sessionStorage.php';

class HeroChoiceController {

    private $adventure;
    private $userID;
    private $allClass; 

    public function __construct(){
        
        $this->allClass = $GLOBALS['base']->request('SELECT * FROM Class');
        $_SESSION['adventure'] = 0;//test

        if(isset($_SESSION['adventure']) && isset($_SESSION['id'])){
            $this->adventure = $_SESSION['adventure'];
            $this->userID = $_SESSION['id'];
        }  
    }


    public function show(){
        if(isset($this->adventure)){

            ini_set('display_errors', 1);
            ini_set('display_startup_errors', 1);
            error_reporting(E_ALL); 

            require_once 'views/characterCreation.php';
            return;
            
        }else{

            header('Location: home');
            exit;
        }
        
    }

    public static function printClassesTemplate($classes) {
        $templatePath = "template/classTemplate.php";

        if (!file_exists($templatePath)) {
            throw new Exception("Le template n'existe pas (c'est un bug).");
        }

        foreach ($classes as $class) {
            extract($class);
            ob_start();
            include $templatePath;
            echo ob_get_clean();
        }
    }

    public function create(){

        $name = isset($_POST['name']) ? htmlspecialchars(trim($_POST['name'])) : '';
        $biographie = isset($_POST['email']) ? htmlspecialchars(trim($_POST['email'])) : '';
        $classid = isset($_POST['classe']) ? htmlspecialchars(trim($_POST['classe'])) : '';
        if (empty($name) || empty($classid)) {
            $this->show();
        }else {
            // Exemple de traitement : affichage des données
            $base = $GLOBALS["base"];
            $class = $base->request("SELECT * FROM class WHERE id = $classid");
            $base->request("INSERT INTO Hero (name,class_id,biographie,pv,mana,strenght,initiative,shield,xp,current_level,user_id,am_id,primary_wp_id,secondary_wp_id,wheight_limit,qte_item_limit) VALUES ($name,$classid,$biographie,{$class['base_pv']},{$class['base_mana']},{$class['base_strenght']},{$class['base_initiative']},{$class['base_shield']},0,1,{$_SESSION[user_id]}  ,{$class['base_armor']},{$class['base_primary_wp']},{$class['base_secondary_wp']},{$class['base_wheight_limit']},{$class['base_qte_item_limit']})");
        
            // Vous pouvez aussi enregistrer ces données dans une base de données
    
        }
    }

}
