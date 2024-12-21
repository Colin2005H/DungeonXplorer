<?php
require_once 'session/monster.php';
class FightController {

    private $heros;
    private $monster;
    private $hasHerosPlayed;
    private $hasMonsterPlayed;
    

    public function __construct(){
        $this->monster = Monster::getMonster(0);

    }

    public function calculateInitiative(){
        $initiativeMonster =rand(1,6) + $monster->initiative;
        $initiativeHeros =  rand(1,6) +$heros->initiative;

        if($initiativeMonster > $initiativeHeros){
            return $monster;
        }
        elseif($initiativeMonster < $initiativeHeros){
            return $heros;
        }
        elseif($initiativeMonster == $initiativeHeros && strtoupper($heros->getClass()) == "VOLEUR" ){
            return $heros;
        }
        else{
            return $monster;
        }
        
    }

    public function fightRound(){
        if(!isset($hasHerosPlayed) && !isset($hasMonsterPlayed)){
            $characterThatMustPlay = calculateInitiative();

        }
        elseif(!isset($hasHerosPlayed)){
            $characterThatMustPlay = $monster;
        }
        elseif(!isset($hasMonsterPlayed)){
            $characterThatMustPlay = $heros;
        }
        else{
            $characterThatMustPlay = null;
        }
        if(isset($characterThatMustPlay->class_id)){// true if it's a heros
            herosTurn();
        }else{
            monsterTurn();
        }

    }

    public function herosTurn(){

    }

    public function monsterTurn(){
        $damages = rand(1,6) + $monster->strength;
        

    }

    public function show() {
        $monster = $this->monster;
        if($monster){
        require_once 'base/Database.php';
        require_once 'session/sessionStorage.php';
        require_once 'views/fight.php';
        }
        
        
        
    }
}
