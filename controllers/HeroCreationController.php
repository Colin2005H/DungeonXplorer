<?php

require_once 'session/sessionStorage.php';

class HeroCreationController {

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

        if (!isset($_POST['nom']) || !isset($_POST['classe'])) {
            
            header('Location: herocreation');
            exit;

        }else {
            $name = trim($_POST['nom']);
            $classid = trim($_POST['classe']);
            $biographie = "NULL";
            if(isset($_POST['biographie'])){
                $biographie = trim($_POST['biographie']);
            }
            var_dump($this->allClass);
            $class = $this->allClass[$classid];

            $GLOBALS["base"]->request("INSERT INTO Hero (name,class_id,biographie,pv,mana,strenght,initiative,shield,xp,current_level,user_id,am_id,primary_wp_id,secondary_wp_id,wheight_limit,qte_item_limit) VALUES ($name,$classid,$biographie,{$class['base_pv']},{$class['base_mana']},{$class['base_strenght']},{$class['base_initiative']},{$class['base_shield']},0,1,{$_SESSION[user_id]}  ,{$class['base_armor']},{$class['base_primary_wp']},{$class['base_secondary_wp']},{$class['base_wheight_limit']},{$class['base_qte_item_limit']})");
            
            $hero = Hero::getHero($GLOBALS["base"]->request("SELECT * FROM Hero WHERE user_id = {$_SESSION['id']} AND name = {$name}")[0]['id']);

            
            $_SESSION['hero'] = serialize($hero);
            $_SESSION['inventory'] = serialize(new Inventory([], [], []));
            $_SESSION['chapter'] = $GLOBALS['base']->request("SELECT * FROM Adventure WHERE ad_id = {$this->adventure}")[0]['chapter_id'];
            $GLOBALS["base"]->request("INSERT INTO Quest(hero_id, chapter_id, adventure_id) VALUES({$hero->id}, {$_SESSION['chapter']}, {$this->adventure})");
            
            header('Location: chapter/'.$this->adventure);
            exit;
        }
    }

}
