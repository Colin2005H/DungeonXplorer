<?php

require_once 'Armor.php';
require_once 'Weapon.php';
require_once '../base/Database.php';

class Hero{

    public $id;
    public $name;

    #stats
    public $pv;
    public $mana;
    public $strength;
    public $initiative;
    public $shield;

    #details
    public $class_id;
    public $weight_limit;
    public $qte_item_limit;

    #equipement
    public $armor;
    public $primary_wp;
    public $secondary_wp;
    #spell
    public $spell_list;

    #xp
    public $xp;
    public $current_level;
    
    
    
    public function __construct($id, $name, $class_id, $pv, $mana, $strength, $initiative, $shield, $xp, $current_level, $primary_wp_id, $secondary_wp_id, $weight_limit, $qte_item_limit){
        $this->id = $id;
        $this->name = $name;
        $this->class_id = $class_id;
        $this->pv = $pv;
        $this->mana = $mana;
        $this->strength = $strength;
        $this->initiative = $initiative;
        $this->shield = $shield;
        //$this->spell_list = $spell_list;
        $this->xp = $xp;
        $this->current_level = $current_level;
        //$this->armor = Armor::getArmor($armor_id);
        $this->primary_wp = Weapon::getWeapon($primary_wp_id);
        $this->secondary_wp = Weapon::getWeapon($secondary_wp_id);
        $this->weight_limit = $weight_limit;
        $this->qte_item_limit = $qte_item_limit;
    }

    public function getTotalWeight():Float{
        $sum = 0;

        if(isset($this->armor)){
            $sum += $this->armor->getTotalWeight();
        }
        if(isset($this->primary_wp)){
            $sum += $this->primary_wp->getTotalWeight();
        }
        if(isset($this->secondary_wp)){
            $sum += $this->secondary_wp->getTotalWeight();
        }
        return $sum;
    }


    public static function getAllHeroes(): array {
        //récupère tous les héros de la base de données
        $heroesInfo = $GLOBALS["base"]->request("SELECT * FROM Hero");
        $heroes = [];
        

       
        foreach ($heroesInfo as $heroInfo) {
            $heroes[] = new Hero(
                $heroInfo["id"],
                $heroInfo["name"],
                $heroInfo["class_id"],
                $heroInfo["pv"],
                $heroInfo["mana"],
                $heroInfo["strength"],
                $heroInfo["initiative"],
                $heroInfo["shield"],
                //$heroInfo["spell_list"],
                $heroInfo["xp"],
                $heroInfo["current_level"],
                //$heroInfo["armor_id"],
                $heroInfo["primary_wp_id"],
                $heroInfo["secondary_wp_id"],
                $heroInfo["weight_limit"],
                $heroInfo["qte_item_limit"]
            );
        }
        return $heroes;
    }

    
}