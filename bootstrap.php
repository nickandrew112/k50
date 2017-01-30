<?php
include_once 'vendor/autoload.php';

use Controller\Controller;

$controller = new Controller();
//Т.к. действие у нас одно, смело его вызываем
echo $controller->generateAction();