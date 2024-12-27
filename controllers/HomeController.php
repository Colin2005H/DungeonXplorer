<?php
session_start();

class HomeController {
    public function index() {

        if(isset($_SESSION['id'])){
            
            header('Location: adventure');
            exit;


        }else{
            require_once 'views/homePage.php';
        }
        return;
    }
}