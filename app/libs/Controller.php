<?php
/**
 * libs/Controller.php - Base controller, loads models and views.
 *
 * @package    TurtleMVC-Core
 * @license    https://opensource.org/licenses/BSD-3-Clause
 * @author     Micky Aarnoudse
 * @copyright  2020 Micky Aarnoudse
 */

/*
 * Base Controller
 * Loads models and views.
 */

class Controller{
    // load model
    public function model($model){
        // require model file
        require '../app/models/' . $model . '.php';

        // instantiate model
        return new $model;
    }

    // load view
    public function view($view, $data = []){
        // check if view exists.
        if(file_exists('../app/views/' . $view . '.php')){
            require_once '../app/views/' . $view . '.php';
        }else{
            exit('view does not exist');
        }

    }
}   