<?php

class Pages{

    public function __construct(){

    }

    public function index(){
        echo "this is index";
    }

    public function about($param){
        echo "this is about";
        echo "<br> this is the $param";
    }
}