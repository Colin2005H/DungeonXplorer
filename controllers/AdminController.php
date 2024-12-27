<?php
class AdminController {
    
    public function Admin() {
        require_once 'views/adminPage.php';
        
    }

    public function deleteUser() {
        require_once 'base/Database.php';
        $GLOBALS["base"]->request("DELETE FROM Hero WHERE user_id = {$_POST['user_id']}");
        $GLOBALS["base"]->request("DELETE FROM User WHERE user_id = {$_POST['user_id']}");
        header('Location: admin');
    }

    public function deleteAdventure() {
        require_once 'base/Database.php';
        $GLOBALS["base"]->request("DELETE FROM Adventure WHERE ad_id = {$_POST['ad_id']}");
        header('Location: admin');
    }

    public function addAdventure() {
        require_once 'base/Database.php';
        $GLOBALS["base"]->request("INSERT INTO Adventure (ad_name, ad_first_chapter) VALUES ('{$_POST['ad_name']}', '0')");
        header('Location: admin');
        
    }
   

    
}