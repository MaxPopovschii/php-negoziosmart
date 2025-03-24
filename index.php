<?php
require_once __DIR__ . '/app/controllers/TelefonoController.php';
require_once 'app/controllers/ClienteController.php';
require_once 'app/controllers/VenditaController.php';  

$pagina = $_GET['pagina'] ?? 'telefoni';

if ($pagina === 'clienti') {
    $controller = new ClienteController();
    $controller->handleRequest();
} elseif ($pagina === 'telefoni') {
    $controller = new TelefonoController();
    $controller->handleRequest();
} elseif ($pagina === 'vendita') {  
    $controller = new VenditaController();
    $controller->handleRequest();
} else {
    echo "<h1>404 - Pagina non trovata</h1>";
}
