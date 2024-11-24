<?php

require_once '../session/Item.php';
require_once '../session/Armor.php';
require_once '../session/Weapon.php';

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

        $this->items[] = $item;
        return 1;
    }

    public function getTotalWeight():Float{
        $sum = 0;

        foreach($this->items as &$item){
            $sum += $item->getTotalWeight();
        }

        foreach($this->armors as &$armor){
            $sum += $armor->getTotalWeight();
        }

        foreach($this->weapons as &$weapon){
            $sum += $weapon->getTotalWeight();
        }
        
        unser($item);
        unser($armor);
        unser($weapon);
        return $sum;
    }

}