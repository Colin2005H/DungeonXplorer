<?php

// controllers/ChapterController.php

require_once './models/Chapter.php';
require_once './models/Choice.php';

class ChapterController
{
    public $chapter;
    public $choices = [];


    public function __construct(){}


    //TODO
    public function startAdventure($id){

        require_once './base/Database.php';
        
        require_once './views/chapter.php';
    }

    public function goThrowChapter($adventureId, $chapterId){
        
        //$this->chapter = new Chapter($adventureId, $chapterId);
        //$this->choices = Choice::getAllChoices($this->chapter);

        require_once './views/chapter.php';
    }

}


