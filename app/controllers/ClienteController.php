<?php
require_once __DIR__ . '/../models/Cliente.php';

class ClienteController {
    private $model;

    public function __construct() {
        $this->model = new Cliente();
    }

    public function handleRequest() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (isset($_POST['aggiungi_cliente'])) {
                $nome = $_POST['nome'];
                $cognome = $_POST['cognome'];
                $email = $_POST['email'];
                $telefono = $_POST['telefono'];
                $this->model->inserisciCliente($nome, $cognome, $email, $telefono);
            }
        }

        $clienti = $this->model->getAll();

        include __DIR__ . '/../../views/aggiungi_cliente_view.php';
    }
}
