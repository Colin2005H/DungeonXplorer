<?php

class Item {

    public $id;
    public $name;
    public $description;
    public $quantity;
    public $weight;

    public function __construct($id, $name, $description, $weight)
    {
        $this->id = $id;
        $this->name = $name;
        $this->description = $description;
        $this->weight = $weight;
        $this->quantity = 1;
    }

    public function getTotalWeight():Float{
        return $this->quantity * $this->weight;
    }

    public static function getItem($id):Item{
        $itemInfo = $GLOBALS["base"]->request("SELECT * FROM Items WHERE id = {$id}")[0];
        return new Item($id, $itemInfo["name"], $itemInfo["description"], $itemInfo["weight"]);
    }

}