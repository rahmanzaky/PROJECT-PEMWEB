<?php
// Memulai session untuk seluruh aplikasi
session_start();

// Memuat kelas-kelas dasar yang akan selalu digunakan
require_once 'controllers/Controller.class.php';
require_once 'models/Model.class.php'; // <<< TAMBAHKAN BARIS INI

// ---- Logika Routing Anda Dimulai Di Sini ----
$controllerName = $_GET['c'] ?? 'Home'; // Default ke 'Home' controller
$methodName = $_GET['m'] ?? 'index';   // Default ke 'index' method

$controllerFileName = 'controllers/' . $controllerName . '.class.php';

if (file_exists($controllerFileName)) {
    require_once $controllerFileName;
    if (class_exists($controllerName) && method_exists($controllerName, $methodName)) {
        $controller = new $controllerName();
        $controller->$methodName();
    } else {
        // Handle error: class or method not found
        echo "Error: Controller or method not found.";
    }
} else {
    // Handle error: controller file not found
    echo "Error: Controller file not found.";
}
?>