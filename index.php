<?php
session_start();

require_once 'controllers/Controller.class.php';
require_once 'models/Model.class.php';

$controllerName = $_GET['c'] ?? 'Home'; 
$methodName = $_GET['m'] ?? 'index';  

$controllerFileName = 'controllers/' . $controllerName . '.class.php';

if (file_exists($controllerFileName)) {
    require_once $controllerFileName;
    if (class_exists($controllerName) && method_exists($controllerName, $methodName)) {
        $controller = new $controllerName();
        $controller->$methodName();
    } else {
        echo "Error: Controller or method not found.";
    }
} else {
    echo "Error: Controller file not found.";
}
?>