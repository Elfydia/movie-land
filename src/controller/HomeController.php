<?php

class HomeController{

    private $display;
    private $msg;
    
    public function __construct(){

    }

    public function manage(){
        include __DIR__ . './../view/view_home.php';
    }
}

?>
