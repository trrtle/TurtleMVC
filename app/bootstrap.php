<?php
// Load config
require_once 'config/config.php';

// Load libraries
//require_once 'libs/Controller.php';
//require_once 'libs/Core.php';
//require_once 'libs/Database.php';

spl_autoload_register(function($className){
    require_once "libs/". $className .".php";
});