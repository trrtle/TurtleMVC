<?php

class Pages extends Controller{

    public function __construct(){

    }

    public function index(){

    }

    public function about($param){
        echo "this is about";
        echo "<br> this is the $param";
    }
}