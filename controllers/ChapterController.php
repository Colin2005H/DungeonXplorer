<?php

require_once './models/Chapter.php';
require_once './models/Choice.php';

class ChapterController
{
    public $chapter;
    public $choices = [];

    public function __construct(){}


    //display the current chapter
    public function showChapter($adventureId, $chapterId){
        
        //TODO test if the player can access a chapter with SESSION else redirect him

        $this->chapter = Chapter::getChapter($adventureId, $chapterId);//Change params to use $_SESSION insted after checking if possible  
        $this->choices = Choice::getAllChoices($this->chapter);

        require_once './views/chapter.php';
        return;
    }


    //Allow to start an adventure from the start
    //(May not be usefull because this could be done else where)
    public function startAdventure($id){

        require_once './session/sessionStorage.php';

        if(!isset($_SESSION['adventure']) || !isset($_SESSION['chapter'])){
            
            require_once './base/Database.php';
            
            $_SESSION['adventure'] = $id;
            $_SESSION['chapter'] = $GLOBALS['base']->request("SELECT * FROM Adventure WHERE ad_id = {$id}")[0]['ad_first_chapter'];
        }

        $this->showChapter($_SESSION['adventure'], $_SESSION['chapter']);
        
        return;
    }

    //use when showChapter as no longer params
    //change session chapter to one of the possible next one
    public function nextChapter($nextChapterId){
        if(isset($_SESSION['adventure']) && !isset($_SESSION['chapter'])){

            $_SESSION['chapter'] = $nextChapterId;
            //$this->showChapter()   

        }else{

            //TODO redirect toward /home
        }

        return;
    }

}


