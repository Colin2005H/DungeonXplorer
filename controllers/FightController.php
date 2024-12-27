<?php
require_once 'session/monster.php';
require_once 'session/Hero.php';
require_once 'session/sessionStorage.php';
class FightController {

    private $hero;
    private $monster;
    private $sentenceHero;
    private $sentenceEnd;
    private $sentenceMonster;
    private $sentenceInitiative;
    private $initiativeAfterReduce;


    

    public function __construct(){
        if(!isset($_SESSION["hero"])){
            echo "hero unloaded";
            $this->createTestFight(); //test function, uncomment to test
        }
        
        $_SESSION["hasHeroPlayed"] = false;
        $_SESSION["hasMonsterPlayed"] = false;

        $this->hero = $_SESSION["hero"];
        $this->monster = $_SESSION["monster"];
        $this->hero->pv =  $_SESSION["hero"]->pv;
        $this->sentenceHero = "";
        $this->sentenceMonster = "";
        $this->sentenceInitiative = "";
        $this->initiativeAfterReduce = 0;
    }

    public function createTestFight(){
            $_SESSION["hero"] = Hero::getHero(0);
            $_SESSION["hero"]->pv = 100;
    }

    public function resetMonster(){
        unset($this->monster);
        unset($_SESSION["monster"]);
        $this-> __construct();
    }

    public function calculateInitiative(){
        $initiativeMonster =rand(1,6) + $this->monster->initiative;
        $initiativeHero =  rand(1,6) +$this->hero->initiative -$this->hero->armor->initiativePenalty -$this->hero->primary_wp->initiativePenalty- $this->hero->secondary_wp->initiativePenalty;
        if($initiativeHero < 0)$initiativeHero = 0;
        $this->initiativeAfterReduce = $initiativeHero;
        $this->sentenceInitiative = "Test initiative: ".$this->monster->name." --> ".$initiativeMonster." contre ". $initiativeHero." pour vous.";
        if($initiativeMonster > $initiativeHero){
            return $this->monster;
        }
        elseif($initiativeMonster < $initiativeHero){
            return $this->hero;
        }
        elseif($initiativeMonster == $initiativeHero && $this->hero->getClass() == "VOLEUR" ){
            return $this->hero;
        }
        else{
            return $this->monster;
        }
        
    }

    public function fightRound(){ //manage the fight
        if($_SESSION["hasHeroPlayed"] == true && $_SESSION["hasMonsterPlayed"] == true){
            $_SESSION["hasHeroPlayed"] = false;
            $_SESSION["hasMonsterPlayed"] = false;
            unset($_POST["actionChoice"]);
        }
        $this->hero = $_SESSION["hero"];
        $this->monster = $_SESSION["monster"];
        if($_SESSION["hasHeroPlayed"] == false && $_SESSION["hasMonsterPlayed"] == false){
            $characterThatMustPlay = $this->calculateInitiative();

        }
        elseif($_SESSION["hasMonsterPlayed"] == true || isset($_POST["actionChoice"])){
            $characterThatMustPlay = $this->hero;
        }
        elseif($_SESSION["hasHeroPlayed"] == true ){
            $characterThatMustPlay = $this->monster;
        }
        if(isset($characterThatMustPlay->class_id)){// true if it's a hero
            $this-> heroTurn();
        }else{
            $this->monsterTurn();
        }
        

    }

    public function heroTurn(){
        $_SESSION["hasHeroPlayed"] = true;
        if(isset($_POST["actionChoice"])){
            if($_POST["actionChoice"] == "physical" ){ //remove if just physical attacks are implemented
                $damage = rand(1,6) + $this->hero->strength;
                if($this->hero->getClass() == "VOLEUR"){
                    $damage += $this->hero->primary_wp->bonusStrength + $this->hero->secondary_wp->bonusStrength;
                }else{
                    if($_POST["weaponSelector"] == "primary" ){
                        $damage += $this->hero->primary_wp->bonusStrength;
                    }else{
                        $damage += $this->hero->secondary_wp->bonusStrength;
                    }
                }
                $defense = rand(1,6) + (int)($this->monster->strength/2);
                $this->monster->pv -= max(0,$damage-$defense);
                if($this->monster->pv < 0)$this->monster->pv = 0;
                $this->sentenceHero = "Vous effectuez une attaque physique: ".$this->monster->name." prend ".max(0,$damage-$defense). " dégats !";
                $this->updateData();
            }
        }else{
            $this->showForPlayer();
        }
        
        
    }

    public function monsterTurn(){
        $damages = rand(1,6) + $this->monster->strength;
        if($this->hero->getClass() == "VOLEUR"){
            $defense = rand(1,6) + (int)($this->hero->initiative/2) + $this->hero->armor->amPoint;
        }else{
            $defense = rand(1,6) + (int)($this->hero->strength/2) + $this->hero->armor->amPoint;
        }
        $this->hero->pv -= max(0, $damages - $defense );
        if( $this->hero->pv < 0) $this->hero->pv = 0;
        $_SESSION["hasMonsterPlayed"] = true;
        $this->sentenceMonster = $this->monster->name." effectue une attaque physique: Vous prenez ".max(0,$damages-$defense). " dégats !";
        $this->updateData();

    }


    public function updateData(){

        
        if($this->hero->pv <= 0){
            $this->sentenceEnd = "Vous êtes mort";
            unset($_SESSION["monster"]);
           // echo  $this->sentenceEnd;// echo here
            $_SESSION["hasHeroPlayed"] = false;
            $_SESSION["hasMonsterPlayed"] = false;

            header('Location: ./chapter');
            exit;
           
        }
        elseif($this->monster->pv <= 0){
            $this->sentenceEnd = "Vous avez gagné";
            unset($_SESSION["monster"]);
            //echo $this->sentenceEnd; // echo here
            $_SESSION["hasHeroPlayed"] = false;
            $_SESSION["hasMonsterPlayed"] = false;
            
            header('Location: ./chapter');
            exit;
           
        }
        else{
            $_SESSION["hero"] = $this->hero;
            $_SESSION["monster"] = $this->monster;
            $mo = $_SESSION["hasMonsterPlayed"];
            $he = $_SESSION["hasHeroPlayed"];
        }
        $this->secondTurnManager();

        
    }

    public function secondTurnManager(){
        if($_SESSION["hasMonsterPlayed"] == true){
            if($_SESSION["hasHeroPlayed"] == true){
                $this->fightRound();
            }else{
                $this->showForPlayer();
            }
        }else{
            $this->monsterTurn();
        }
    }

    public function showForPlayer() {
        require_once 'base/Database.php';
        require_once 'session/sessionStorage.php';
        require_once 'views/fight.php';
    }
        

}
