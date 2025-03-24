<?php
require_once __DIR__ . '/../models/Telefono.php';
require_once __DIR__ . '/../models/Cliente.php';

class TelefonoController {
   private $telefonoModel;
    private $clienteModel;

    public function __construct() {
        $this->telefonoModel = new Telefono();
        $this->clienteModel = new Cliente();
    }

    public function handleRequest() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (isset($_POST['aggiungi'])) {
                $this->telefonoModel->add($_POST['marca'], $_POST['modello'], $_POST['prezzo'], $_POST['sconto'], $_POST['quantita']);
            }
            if (isset($_POST['aggiorna'])) {
                $this->telefonoModel->updatePrezzoSconto($_POST['id_agg'], $_POST['prezzo_agg'], $_POST['sconto_agg']);
            }
            if (isset($_POST['cancella'])) {
                $this->telefonoModel->delete($_POST['marca_del'], $_POST['modello_del']);
            }
            if (isset($_POST['aumenta'])) {
                $this->telefonoModel->aumentaQuantita($_POST['id_aum'], $_POST['quantita_aum']);
            }
        }

        $telefonini = $this->telefonoModel->getAll();
        $totale = $this->telefonoModel->getValoreTotale();
        $valoriMarca = $this->telefonoModel->getValorePerMarca();
        $minmax = $this->telefonoModel->getPrezzoMinMax();

        include __DIR__ . '/../../views/telefoni_view.html';
    }
}
