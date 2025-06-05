<?php
error_reporting(E_ALL);
ini_set('display_errors', '1');

$controller = $_GET['c'] ?? 'Home';
$method = $_GET['m'] ?? 'index';

require_once "controllers/Controller.class.php";
require_once "controllers/$controller.class.php";

$c = new $controller();
$c->$method();

if (empty($_GET['c']) && empty($_GET['m'])) {
    header('Location: index.php?c=Todos&m=grow');
    exit;
}
