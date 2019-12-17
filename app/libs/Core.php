<?php
/**
 * libs/Core.php - This is where the magic happens.
 *
 * @package    TurtleMVC-Core
 * @license    https://opensource.org/licenses/BSD-3-Clause
 * @author     Micky Aarnoudse
 * @copyright  2020 Micky Aarnoudse
 */


/**
 * App core class
 *
 * Gets URL & executes Controller->Method(params)
 * URL format: /controller/method/params
 * @example Posts->edit(post10)
 * It uses call_user_func_array() to achieve this.
 *
 * @property string $currentController - controller that is requested by the URL
 * @property string $currentMethod - Method of the controller (second part of the url)
 * @property array $params - Parameters given to the $currentMethod
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

    /**
     * Gets the url and convert it to an array
     *
     * @return array url seperated by /
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