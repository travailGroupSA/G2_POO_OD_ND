<?php
require './helpers/sessions.php';
require './config/config.php';
spl_autoload_register(function ($class) {
    $pathModels = "./models/" . $class . ".php";
    $pathLibs = "./libraries/" . $class . ".php";
    if (file_exists($pathModels)) {
        require_once($pathModels);
    } elseif (file_exists($pathLibs)) {
        require_once($pathLibs);
    }
});
require('./libraries/Router.php');

$route = new Router();