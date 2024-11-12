<?php



session_start();

#    $_SESSION DESCRIPTION
#  
#
#   ["adventure"] => int
#
#   ["chapterID"] => int
#
#   ["character"] => Hero{}
#   
#   ["inventory"] =>Array{
#       0:Item{
#           itemID => int
#           itemName => string
#           itemDescrition => string
#           itemQuantity =>  int
#           }
#       1: ...
#   }
  


class Session{
    
    static function saveData(){
        require_once './base/Database.php';
    }

    static function loadData($heroID){
        require_once './base/Database.php';
        $_SESSION["chapterID"] = $db->query("SELECT chapter_id FROM quest WHERE hero_id = {$heroID};");

        $_SESSION["adventure"] = $db->query("SELECT ad_id FROM chapter WHERE id = {$_SESSION["chapterID"]};");

    }


}