<?php
require_once 'session/monster.php';
class FightController {

    private $heros;
    private $monster;

    public function __construct(){
        $this->monster = Monster::getMonster(0);

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
