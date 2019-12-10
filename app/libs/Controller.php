<?php

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
        if(file_exists('../views/' . $view . '.php')){
            require_once '../views/' . $view . '.php';
        }else{
            exit('view does not exist');
        }

    }
}