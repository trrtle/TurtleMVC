<?php
/**
 * libs/Controller.php - Base controller, loads models and views.
 *
 * @package    TurtleMVC-Core
 * @license    https://opensource.org/licenses/BSD-3-Clause
 * @author     Micky Aarnoudse
 * @copyright  2020 Micky Aarnoudse
 */

class Controller{
    /**
     * Loads the model
     *
     * @param string $model Path to model.
     * @return object of the given model class
     */
    public function model($model){
        // require model file
        require '../app/models/' . $model . '.php';

        // instantiate model
        return new $model;
    }

    /**
     * Loads the view and data array
     *
     * @param string $view Path to view from the views directory
     * @param array $data Associative array with data that must be passed on to the view
     * @return void
     */
    public function view($view, $data = []){
        // check if view exists.
        if(file_exists('../app/views/' . $view . '.php')){
            require_once '../app/views/' . $view . '.php';
        }else{
            exit('view does not exist');
        }

    }
}   