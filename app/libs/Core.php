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

        $url = $this->getUrl();

        // look into controllers for the first value
        if(file_exists('../app/controllers/' . ucwords($url[0]) . '.php')){

            // if exists, set current controller
            $this->currentController = ucwords($url[0]);
        }

        // if controller isset
        if (isset($url[0])){
            // remove the Controller from the url array
            array_shift($url);
        }

        // require the controller
        require_once '../app/controllers/' . $this->currentController . '.php';

        // instantiate the controller. example: $pages = new Pages
        $this->currentController = new $this->currentController;

        //check for second part of the url
        if(isset($url[0])){

            // check if method exists in the current controller
            if(method_exists($this->currentController, $url[0])){

                // set current method the same as second part of the url
                $this->currentMethod = $url[0];


            }

            // remove the method from the url array
            array_shift($url);
        }

        // get params
        if(isset($url)){
            $this->params = array_values($url);
        }else{
            $this->params = [];
        }

        // call a callback function with the currentController->currentMethod(params)
        call_user_func_array([$this->currentController, $this->currentMethod], $this->params);
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
        }
        else{
            $url = null;
        }
        return $url;
    }
}