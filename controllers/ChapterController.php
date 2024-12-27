<?php
require_once 'session/sessionStorage.php';
require_once 'session/Monster.php';
require_once 'models/Chapter.php';
require_once 'models/Choice.php';

class ChapterController
{
    public $chapter;
    public $choices = [];

    public function __construct(){
        
    }


    //display the current chapter
    public function show(){
    
        if(isset($_SESSION['adventure']) && isset($_SESSION['chapter'])){

            $this->chapter = Chapter::getChapter($_SESSION['adventure'], $_SESSION['chapter']);
            $this->choices = Choice::getAllChoices($this->chapter);

            require_once 'views/chapter.php';

        }else{
            
            //User $_SESSION doesn't containe chapter or adventure inforfation
            header('Location: adventure');
            exit;

        }

        return;
    }


    //Allow to start an adventure from the start
    public function startAdventure($adventureId){
   
        
            
        $_SESSION['adventure'] = $adventureId;
        $_SESSION['chapter'] = $GLOBALS['base']->request("SELECT * FROM Adventure WHERE ad_id = {$adventureId}")[0]['ad_first_chapter'];
        
        header('Location: ../chapter');
        exit();
        return;
    }


    //go to the next chapter/fight
    public function nextChapter($nextChapterId){

        if(isset($_SESSION['adventure']) && isset($_SESSION['chapter'])){
            
            $_SESSION['chapter'] = $nextChapterId;

            $monsterID = $GLOBALS['base']->request("SELECT * FROM Encounter WHERE chapter_id = {$_SESSION['chapter']} AND adventure_id = {$_SESSION['adventure']}")[0]['monster_id'];

            if(isset($monsterID)){

                $_SESSION["monster"] = serialize(Monster::getMonster($monsterID));

                header('Location: ../fight');

            }else{
                header('Location: ../chapter');
            }
            exit();

        }else{

            //User $_SESSION doesn't contain chapter or adventure inforfation
            header('Location: ../adventure');
            exit;
           
        }

        return;
    }


    public function save(){

        if(isset($_SESSION['hero']) && isset($_SESSION['inventory'])){
            echo 'info saving';
            Session::saveData();
            unset($_SESSION['adventure']);
            unset($_SESSION['chapter']);
            unset($_SESSION['hero']);
            unset($_SESSION['inventory']);
        }

        header('Location: adventure');
        exit;
    } 



}


