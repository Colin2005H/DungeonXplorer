<?php

class Choice{

    public $text;
    public $nextChapter;
    public $keyItem;

    public function __construct($text, $nextChapter, $keyItem){

        $this->text;
        $this->nextChapter;
        $this->keyItem;
    }

    public static function getallChoices($chapter){
        require_once './base/Database.php';
        require_once './session/Item.php';
        $allChoices = [];

        $choicesInfo = $GLOBALS['base']->request("SELECT * FROM Links WHERE chapter_id = {$chapter->id} AND adventure_id = {$chapter->adventureId}");
        for($i = 0; $i < count($choicesInfo); $i++){
            $allChoices[$i] = new Choice($choicesInfo[$i]['description'], $choicesInfo[$i]['next_chapter_id'], Item::getItem($choicesInfo[$i]['key_item_id']));
        }

        return $allChoices;
    }
}