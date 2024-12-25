<?php

class Monster
{   
    public $id;
    public $name;
    public $pv;
    public $mana;
    public $initiative;
    public $strength;
    public $attack;
    public $loot_id;
    public $xp;

    public function __construct($id, $name, $pv, $mana, $initiative, $strength, $attack, $loot_id, $xp)
    {
        $this->id = $id;
        $this->name = $name;
        $this->pv = $pv;
        $this->mana = $mana;
        $this->initiative = $initiative;
        $this->strength = $strength;
        $this->attack = $attack;
        $this->loot_id = $loot_id;
        $this->xp = $xp;
    }

    static public function getMonster($id):Monster{
        require_once './base/Database.php';
        $monsterInfo = $GLOBALS["base"]->request("SELECT * FROM Monster WHERE id = {$id}")[0];
        return new Monster($id, $monsterInfo["name"], $monsterInfo["pv"], $monsterInfo["mana"], $monsterInfo["initiative"], $monsterInfo["strength"], $monsterInfo["attack"], $monsterInfo["loot_id"], $monsterInfo["xp"]);
        
    }


    
}
