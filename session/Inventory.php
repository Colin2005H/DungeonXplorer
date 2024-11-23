<?php

class Inventory{

    public $items;
    public $weapons;
    public $armors;

    public function __construct($items, $weapons, $armors){
        $this->items =  $items;
        $this->weapons = $weapons;
        $this->armors = $armors;
    }

    
    public function addItem($item): int{ //TODO test poids
        foreach($this->items as &$item){
            if($item->itemID == $id->itemID){
                $item->itemQuantity += 1;
                return 1;
            }
        }
        unser($item);

        $this->items[$this->items.count()] = $item;
        return 1;
    }

}