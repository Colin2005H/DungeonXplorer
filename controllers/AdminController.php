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
   

    
}