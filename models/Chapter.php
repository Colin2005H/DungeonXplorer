<?php

class Chapter{

    public $id;
    public $adventureId;
    public $text;
    public $image;
    public $treasureId;


    public function __construct($id, $adventureId, $text, $image, $treasureId){

        $this->id =$id;
        $this->adventureId = $adventureId;
        $this->text = $text;
        $this->image = $image;
        $this->treasureId = $treasureId;

    }

    public static function getChapter($adventureId, $id):Chapter{
        require_once './base/Database.php';
        $chapterInfo = $GLOBALS['base']->request("SELECT * FROM Chapter WHERE id = {$id} AND ad_id = {$adventureId}")[0];
        return new Chapter($chapterInfo['id'], $chapterInfo['ad_id'], $chapterInfo['content'], $chapterInfo['image'], $chapterInfo['treasure_id']);
    }
}