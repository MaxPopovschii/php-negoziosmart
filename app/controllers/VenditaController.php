<?php
require_once __DIR__ . '/../models/Cliente.php';
require_once __DIR__ . '/../models/Telefono.php';
require_once __DIR__ . '/../models/Vendita.php';

class VenditaController {
    public function handleRequest() {
        $clienteModel = new Cliente();
        $telefonoModel = new Telefono();
        $vendita = new Vendita();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $idCliente = intval($_POST['cliente_id']);
            $idTelefono = intval($_POST['telefono_id']);

            $cliente = $clienteModel->getById($idCliente);
            $telefono = $telefonoModel->getById($idTelefono);
    
            if ($cliente && $telefono && $telefono['quantita'] > 0) {
                $prezzoScontato = $telefono['prezzo'] * (1 - $telefono['sconto'] / 100);
                $dataVendita = date('Y-m-d H:i:s');
                $vendita->inserisciVendita($idCliente, $idTelefono, $prezzoScontato, $dataVendita);
                $telefonoModel->diminuisciQuantita($idTelefono);

                include __DIR__ . '/../../views/fattura_view.php';
                return;
            } else {
                echo "<p>Errore: cliente o telefono non valido, o quantità insufficiente.</p>";
                if (!$cliente) echo "<p>❌ Cliente non trovato</p>";
                if (!$telefono) echo "<p>❌ Telefono non trovato</p>";
                if ($telefono && $telefono['quantita'] <= 0) echo "<p>❌ Quantità zero</p>";
            }
        }

        $clienti = $clienteModel->getAll();
        $telefonini = $telefonoModel->getAll();

        include __DIR__ . '/../../views/vendita_view.php';
    }
}
