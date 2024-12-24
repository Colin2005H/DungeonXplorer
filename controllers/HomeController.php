<?php
class HomeController {
    public function index() {
        session_start();
        session_destroy();
        require_once 'views/homePage.php';
        
    }
}