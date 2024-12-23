<?php
require_once 'session/monster.php';
class FightController {

    private $hero;
    private $monster;
    

    public function __construct(){
        if(isset($_SESSION["hero"]) && isset($_SESSION["monster"])){
            $hero = $_SESSION["hero"];
            $monster = $_SESSION["monster"];
        }else{
            $this->monster = Monster::getMonster(0);
        }
        

    }

    public function calculateInitiative(){
        $initiativeMonster =rand(1,6) + $monster->initiative;
        $initiativeHero =  rand(1,6) +$hero->initiative -$hero->armor->initiativePenalty;

        if($initiativeMonster > $initiativeHero){
            return $monster;
        }
        elseif($initiativeMonster < $initiativeHero){
            return $hero;
        }
        elseif($initiativeMonster == $initiativeHero && $hero->getClass()) == "VOLEUR" {
            return $hero;
        }
        else{
            return $monster;
        }
        
    }

    public function fightRound(){ //manage the fight
        if(!isset($_SESSION["hasHeroPlayed"]) && !isset($_SESSION["hasMonsterPlayed"])){
            $characterThatMustPlay = calculateInitiative();

        }
        elseif(!isset($_SESSION["hasHeroPlayed"])){
            $characterThatMustPlay = $monster;
        }
        elseif(!isset($_SESSION["hasMonsterPlayed"])){
            $characterThatMustPlay = $hero;
        }
        else{
            unset($_SESSION["hasHeroPlayed"]);
            unset($_SESSION["hasMonsterPlayed"]);
            fightRound();
        }
        if(isset($characterThatMustPlay->class_id)){// true if it's a hero
            heroTurn();
        }else{
            monsterTurn();
        }

    }

    public function heroTurn(){
        if(!isset($_POST))show();
        else{
            if($_POST["actionChoice"] == "physical" ){
                $damage = rand(1,6) + $hero->strength
                if($hero->getClass() == "VOLEUR"){
                    $damage += $hero->primary_wp->bonusStrength + $hero->secondary_wp->bonusStrength
                }else{
                    if($_POST["weaponSelector"] == "primary" ){
                        $damage += $hero->primary_wp->bonusStrength;
                    }else{
                        $damage += $hero->secondary_wp->bonusStrength;
                    }
                }
                $defense = rand(1,6) + (int)($monster->strength/2);
                $monster->pv -= max(0,$damage-$defense);
                if($monster->pv < 0)$monster->pv = 0;
            }
        }
        $_SESSION["hasHeroPlayed"] = true;
        show()
    }

    public function monsterTurn(){
        $damages = rand(1,6) + $monster->strength;
        if($hero->getClass() == "VOLEUR"){
            $defense = rand(1,6) + (int)($hero->initiative/2) + $hero->armor->amPoint;
        }else{
            $defense = rand(1,6) + (int)($hero->strength/2) + $hero->armor->amPoint;//Todo: shield
        }
        $hero->pv -= max(0, $damages - $defense )
        if($hero->pv < 0)$hero->pv = 0;
        $_SESSION["hasMonsterPlayed"] = true;
        show()

    }

    public function show() {
        $monster = $this->monster;
        $hero = $this->hero;
        require_once 'base/Database.php';
        require_once 'session/sessionStorage.php';
        require_once 'views/fight.php';
        }
        
        
        
    }
}
