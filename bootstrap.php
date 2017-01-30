<?php
include_once 'autoloader.php';

$controller = new Controller();
//Т.к. действие у нас одно, смело его вызываем
echo $controller->generateAction();