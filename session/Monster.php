<?php

class Monster
{   
    public $id;
    public $name;
    public $pv;
    public $mana;
    public $initiative;
    public $strenght;
    public $attack;
    public $loot_id;
    public $xp;

    public function __construct($id, $name, $pv, $mana, $initiative, $strenght, $attack, $loot_id, $xp)
    {
        $this->id = $id;
        $this->name = $name;
        $this->pv = $pv;
        $this->mana = $mana;
        $this->initiative = $initiative;
        $this->strenght = $strenght;
        $this->attack = $attack;
        $this->loot_id = $loot_id;
        $this->xp = $xp;
    }

    static public function getMonster($id):Monster{
        $monsterInfo = $GLOBALS["base"]->request("SELECT * FROM Monster WHERE id = {$id}");

        return new Monster($id, $monsterInfo["name"], $monsterInfo["pv"], $monsterInfo["mana"], $monsterInfo["initiative"], $monsterInfo["streangth"], $monsterInfo["attack"], $monsterInfo["loot_id"], $monsterInfo["xp"]);
    }

    
}
