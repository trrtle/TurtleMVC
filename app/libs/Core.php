<?php
/*
 * App Core Class
 * Creates URL & loads core controller
 * URL format: /controller/method/params
 */

Class Core{
    protected $currentController = 'Pages';
    protected $currentMethod = 'index';
    protected $params = [];

    public function __construct(){
        // print_r($this->getUrl());

        $url = $this->getUrl();

        // look into controllers for the first value
        if(file_exists('../app/controllers' . ucwords($url[0]) . '.php')){

            // if exists, set current controller
            $this->currentController = ucwords($url[0]);
            echo $this->currentController;
            unset($url[0]);
        }

        // require the controller
        require_once '../app/controllers/' . $this->currentController . '.php';

        // init the controller. example: $pages = new Pages
        $this->currentController = new $this->currentController;
    }

    /*
     * function getUrl
     * returns array with the url
     */
    public function getUrl(){
        if(isset($_GET['url'])){
            $url = rtrim($_GET['url'], '/');
            $url = filter_var($url, FILTER_SANITIZE_URL);
            $url = explode('/', $url);
            return $url;
        }
    }
}