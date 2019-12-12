<?php
// Load config
require_once 'config/config.php';

// load all classes in libs/ when they are instantiated
spl_autoload_register(function($className){
    require_once "libs/". $className .".php";
});