<?php

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
    public $armor_id;
    public $primary_wp_id;
    public $secondary_wp_id;
    #spell
    public $spell_list;

    #xp
    public $xp;
    public $current_level;
    
    
    
    public function __construct($id, $name, $class_id, $pv, $mana, $strength, $initiative, $shield, $spell_list, $xp, $current_level, $armor_id, $primary_wp_id, $secondary_wp_id, $weight_limit, $qte_item_limit){
        $this->id = $id;
        $this->name = $name;
        $this->class_id = $class_id;
        $this->pv = $pv;
        $this->mana = $mana;
        $this->strength = $strength;
        $this->initiative = $initiative;
        $this->shield = $shield;
        $this->spell_list = $spell_list;
        $this->xp = $xp;
        $this->current_level = $current_level;
        $this->armor_id = $armor_id;
        $this->primary_wp_id = $primary_wp_id;
        $this->secondary_wp_id = $secondary_wp_id;
        $this->weight_limit = $weight_limit;
        $this->qte_item_limit = $qte_item_limit;
    }
}