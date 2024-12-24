<?php
require_once 'session/monster.php';
require_once 'session/Hero.php';
class FightController {

    private $hero;
    private $monster;
    private $effectiveDamage;
    private $damMon;
    private $sentence;
    

    public function __construct(){
        if(isset($_SESSION["hero"]) && isset($_SESSION["monster"]) && !isset($_SESSION["oui"])){
            $this->hero = $_SESSION["hero"];
            $this->monster = $_SESSION["monster"];
        }elseif(!isset($_SESSION["oui"])){
            require_once './base/Database.php';
            $_SESSION["monster"] = Monster::getMonster(0);
            $heroData = $GLOBALS["base"]->request("SELECT * FROM Hero where id= 0")[0];
            $_SESSION["hero"] = new Hero($heroData["id"],$heroData["name"],$heroData["class_id"],$heroData["pv"],$heroData["mana"],$heroData["strength"],$heroData["initiative"],$heroData["shield"], null,$heroData["xp"],$heroData["current_level"],$heroData["am_id"],$heroData["primary_wp_id"],$heroData["secondary_wp_id"],$heroData["weight_limit"],$heroData["qte_item_limit"]);
            $this->hero =  $_SESSION["hero"];
            $this->monster = $_SESSION["monster"];
            $_SESSION["hasHeroPlayed"] = false;
            $_SESSION["hasMonsterPlayed"] = false;
            $_SESSION["monster"]->initiative = 0;
            $_SESSION["hero"]->strength = 0;
            
        }
        $this->effectiveDamage = 0;
        $this->damMon = 0;
        

        

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
        if($_SESSION["hasHeroPlayed"] == true && $_SESSION["hasMonsterPlayed"] == true){
            $_SESSION["hasHeroPlayed"] = false;
            $_SESSION["hasMonsterPlayed"] = false;
        }
        $this->hero = $_SESSION["hero"];
        $this->monster = $_SESSION["monster"];
        if($_SESSION["hasHeroPlayed"] == false && $_SESSION["hasMonsterPlayed"] == false){
            echo "\n autre";
            $characterThatMustPlay = $this->calculateInitiative();

        }
        elseif($_SESSION["hasHeroPlayed"] == true || isset($_POST["actionChoice"])){
            $characterThatMustPlay = $this->monster;
            echo "\n monstre";
        }
        elseif($_SESSION["hasMonsterPlayed"] == true || !isset($_POST["actionChoice"])){
            $characterThatMustPlay = $this->hero;
            echo "\n hero";
        }
        if(isset($characterThatMustPlay->class_id)){// true if it's a hero
            $this-> heroTurn();
        }else{
            $this->monsterTurn();
        }

    }

    public function heroTurn(){
        if(!isset($_POST["actionChoice"])){$_SESSION["hasHeroPlayed"] = true;$this->show();}
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
                $this->monster->pv -= max(0,$damage-$defense);
                if($this->monster->pv < 0)$this->monster->pv = 0;
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
        $this->damMon = max(0,$damages-$defense);
        $this->hero->pv -= max(0, $damages - $defense );
        if( $this->hero->pv < 0) $this->hero->pv = 0;
        $_SESSION["hasMonsterPlayed"] = true;
        $this->show();

    }

    public function show() {
        echo print_r( $_SESSION["hero"]);
        echo print_r( $_SESSION["monster"]);
        if($this->hero->pv <= 0){
            $this->sentence = "Vous êtes mort";
            unset($_SESSION["hero"]);
            unset($_SESSION["monster"]);
            echo "dqdqd";
            $_SESSION["oui"] = 1;
           
        }
        elseif($this->monster->pv <= 0){
            $this->sentence = "Vous avez gagné";
            unset($_SESSION["hero"]);
            unset($_SESSION["monster"]);
            echo "aaaa";
            $_SESSION["oui"] = 1;
           
        }
        else{
       $_SESSION["hero"]->pv = $this->monster->pv;
       $_SESSION["monster"]->pv = $this->monster->pv;
       $mo = $_SESSION["hasMonsterPlayed"];
       $he = $_SESSION["hasHeroPlayed"];
       //$_SESSION["monster"] = $monster;
      // $_SESSION["hero"] = $hero;

        require_once 'base/Database.php';
        require_once 'session/sessionStorage.php';
        require_once 'views/fight.php';
        }
        
        
        
    }
}
