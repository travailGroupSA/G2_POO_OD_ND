<?php
require './helpers/sessions.php';
require './helpers/functions.php';

require './config/config.php';
spl_autoload_register(function ($class) {
    $pathModels = "./models/" . $class . ".php";
    $pathLibs = "./libraries/" . $class . ".php";
    $pathDao = "./dao/" . $class . ".php";
    if (file_exists($pathModels)) {
        require_once($pathModels);
    } elseif (file_exists($pathLibs)) {
        require_once($pathLibs);
    } elseif (file_exists($pathDao)) {
        require_once($pathDao);
    }
});
require('./libraries/Router.php');

$route = new Router();