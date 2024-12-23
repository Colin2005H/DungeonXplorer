<?php
require_once 'session/monster.php';
require_once 'session/Hero.php';
class FightController {

    private $hero;
    private $monster;
    private $effectiveDamage;
    private $sentense;
    

    public function __construct(){
        if(isset($_SESSION["hero"]) && isset($_SESSION["monster"])){
            $this->hero = $_SESSION["hero"];
            $this->monster = $_SESSION["monster"];
        }else{
            require_once './base/Database.php';
            $_SESSION["monster"] = Monster::getMonster(0);
            $heroData = $GLOBALS["base"]->request("SELECT * FROM Hero where id= 0")[0];
            $_SESSION["hero"] = new Hero($heroData["id"],$heroData["name"],$heroData["class_id"],$heroData["pv"],$heroData["mana"],$heroData["strength"],$heroData["initiative"],$heroData["shield"], null,$heroData["xp"],$heroData["current_level"],$heroData["am_id"],$heroData["primary_wp_id"],$heroData["secondary_wp_id"],$heroData["weight_limit"],$heroData["qte_item_limit"]);
            $this->hero =  $_SESSION["hero"];
            $this->monster = $_SESSION["monster"];
        }

        

    }

    public function calculateInitiative(){
        $initiativeMonster =rand(1,6) + $this->monster->initiative;
        $initiativeHero =  rand(1,6) +$this->hero->initiative -$this->hero->armor->initiativePenalty;

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
        if(!isset($_SESSION["hasHeroPlayed"]) && !isset($_SESSION["hasMonsterPlayed"])){
            $characterThatMustPlay = $this->calculateInitiative();

        }
        elseif(!isset($_SESSION["hasHeroPlayed"])){
            $characterThatMustPlay = $this->monster;
        }
        elseif(!isset($_SESSION["hasMonsterPlayed"])){
            $characterThatMustPlay = $this->hero;
        }
        else{
            unset($_SESSION["hasHeroPlayed"]);
            unset($_SESSION["hasMonsterPlayed"]);
            $this->fightRound();
        }
        if(isset($characterThatMustPlay->class_id)){// true if it's a hero
            $this-> heroTurn();
        }else{
            $this->monsterTurn();
        }

    }

    public function heroTurn(){
        if(!isset($_POST["actionChoice"]))show();
        else{
            if($_POST["actionChoice"] == "physical" ){
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
                $this->effectiveDamage = max(0,$damage-$defense);
                $_SESSION["monster"]->pv -= max(0,$damage-$defense);
                if($_SESSION["monster"]->pv < 0)$_SESSION["monster"]->pv = 0;
            }
        }
        $_SESSION["hasHeroPlayed"] = true;
        $this->show();
    }

    public function monsterTurn(){
        $damages = rand(1,6) + $this->monster->strength;
        if($this->hero->getClass() == "VOLEUR"){
            $defense = rand(1,6) + (int)($this->hero->initiative/2) + $this->hero->armor->amPoint;
        }else{
            $defense = rand(1,6) + (int)($this->hero->strength/2) + $this->hero->armor->amPoint;//Todo: shield
        }
        $this->effectiveDamage = max(0,$damages-$defense);
        $_SESSION["hero"]->pv -= max(0, $damages - $defense );
        if( $_SESSION["hero"]->pv < 0) $_SESSION["hero"]->pv = 0;
        $_SESSION["hasMonsterPlayed"] = true;
        $this->show();

    }

    public function show() {
        if($this->hero->pv <= 0){
            unset($_SESSION["hero"]);
            unset($_SESSION["monster"]);
           require_once 'views/404.php';
        }
        if($this->monster->pv <= 0){
            unset($_SESSION["hero"]);
            unset($_SESSION["monster"]);
           require_once 'views/homePage.php';
        }
       $monster = $_SESSION["monster"];
       $hero =  $_SESSION["hero"];
       //$_SESSION["monster"] = $monster;
      // $_SESSION["hero"] = $hero;

        require_once 'base/Database.php';
        require_once 'session/sessionStorage.php';
        require_once 'views/fight.php';
        
        
        
        
    }
}
