<?php
/**
 * controllers/Pages.php - Pages controller loads the generic pages.
 *
 * @package    TurtleMVC-Core
 * @license    https://opensource.org/licenses/BSD-3-Clause
 * @author     Micky Aarnoudse
 * @copyright  2020 Micky Aarnoudse
 */

class Pages extends Controller{

    public function __construct(){

    }

    public function index(){

        $data = [
            "title"=>"TurtleMVC"
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