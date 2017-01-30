<?php
define('DATA_DIR' , __DIR__ . DIRECTORY_SEPARATOR  . 'data');

include_once 'vendor/autoload.php';

use Controller\Controller;
use System\ErrorHandler;

ErrorHandler::init();

$controller = new Controller();
//Т.к. действие у нас одно, смело его вызываем
echo $controller->generateAction();