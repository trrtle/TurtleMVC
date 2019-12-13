<?php

class Pages extends Controller{

    public function __construct(){

        // set model here, for example:  $this->postModel = $this->model('Post');

    }

    public function index(){

        $data = [
            "title"=>"Welcome"
        ];
        $this->view('/Pages/index', $data);
    }

    public function about(){
        $data = [
            "title"=>"About us"
        ];
        $this->view('/Pages/about', $data);
    }
}