<?php



class Admin{
    
    static public function createAdventure($name){
        require_once 'Database.php';
        $GLOBALS["base"]->request("INSERT INTO Adventure(ad_name) VALUES ({$name})");
    }
    static public function function2(){
        require_once 'Database.php';
        $GLOBALS["base"]->request("INSERT INTO Adventure(ad_name) VALUES ({$name})");
    }

    static public function addChapter($adventure, $chapter, $content, $image){
        require_once 'Database.php';
        $GLOBALS["base"]->request("INSERT INTO Chapter() VALUES ({$name})");
    }

    static public function function4(){
        
    }

    static public function function5(){
        
    }

    static public function function6(){
        
    }

    static public function function7(){
        
    }
}