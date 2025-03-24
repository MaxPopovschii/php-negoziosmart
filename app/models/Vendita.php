<?php
require_once __DIR__ . '/../core/Database.php';

class Vendita {
    private $conn;

    public function __construct() {
        $this->conn = Database::getConnection();
    }

    public function inserisciVendita($idCliente, $idTelefono, $prezzoFinale, $dataVendita) {
        $stmt = $this->conn->prepare("INSERT INTO vendite (id_cliente, id_telefonino, prezzo, data_vendita) VALUES (?, ?, ?, ?)");
        return $stmt->execute([$idCliente, $idTelefono, $prezzoFinale, $dataVendita]);
    }

    public function getTelefoniniDisponibili() {
        $query = "SELECT * FROM telefonini WHERE quantita > 0";
        $stmt = $this->conn->query($query);
        return $stmt->fetchAll();
    }

    // Recupera i clienti
    public function getClienti() {
        $query = "SELECT * FROM clienti";
        $stmt = $this->conn->query($query);
        return $stmt->fetchAll();
    }

    // Recupera le vendite
    public function getVendite() {
        $query = "SELECT v.*, c.nome AS cliente_nome, c.cognome AS cliente_cognome, t.marca AS telefono_marca, t.modello AS telefono_modello 
                  FROM vendite v
                  JOIN clienti c ON v.cliente_id = c.id
                  JOIN telefonini t ON v.telefono_id = t.id";
        $stmt = $this->conn->query($query);
        return $stmt->fetchAll();
    }
}
