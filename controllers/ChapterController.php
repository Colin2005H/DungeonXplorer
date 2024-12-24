<?php

require_once './models/Chapter.php';
require_once './models/Choice.php';

class ChapterController
{
    public $chapter;
    public $choices = [];

    public function __construct(){
        require_once 'session/sessionStorage.php';
    }


    //display the current chapter
    public function showChapter(){
        
        require_once './session/sessionStorage.php';
    
        if(isset($_SESSION['adventure']) && isset($_SESSION['chapter'])){

            $this->chapter = Chapter::getChapter($_SESSION['adventure'], $_SESSION['chapter']);//Change params to use $_SESSION insted after checking if possible  
            $this->choices = Choice::getAllChoices($this->chapter);

            require_once './views/chapter.php';
            return;

        }else{
            
            //User $_SESSION doesn't containe chapter or adventure inforfation
            require_once './views/404.php';
            echo 'User $_SESSION does not containe chapter or adventure information';
            
            return;
        }

        
    }


    //Allow to start an adventure from the start
    public function startAdventure($adventureId){

        require_once './session/sessionStorage.php';


        if(!isset($_SESSION['adventure']) || !isset($_SESSION['chapter'])){
            
            require_once './base/Database.php';
            
            $_SESSION['adventure'] = $adventureId;
            $_SESSION['chapter'] = $GLOBALS['base']->request("SELECT * FROM Adventure WHERE ad_id = {$adventureId}")[0]['ad_first_chapter'];
            
        }
        
        $this->showChapter();
        return;
    }

    //use when showChapter as no longer params
    //change session chapter to one of the possible next one
    public function nextChapter($nextChapterId){
        
        require_once './session/sessionStorage.php';

        if(isset($_SESSION['adventure']) && isset($_SESSION['chapter'])){

            $_SESSION['chapter'] = $nextChapterId;
            $this->showChapter();

        }else{

            //User $_SESSION doesn't containe chapter or adventure inforfation
            require_once './views/404.php';
            echo 'User $_SESSION does not containe chapter or adventure information';
            
            return;
        }

        return;
    }

}


