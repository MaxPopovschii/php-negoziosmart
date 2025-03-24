<?php
require_once __DIR__ . '/../core/Database.php';

class Telefono {
    private $conn;

    public function __construct() {
        $this->conn = Database::getConnection();
    }

    public function getAll() {
        $stmt = $this->conn->query("SELECT * FROM articoli");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function add($marca, $modello, $prezzo, $sconto, $quantita) {
        $sql = "INSERT INTO articoli (marca, modello, prezzo, sconto, quantita) VALUES (?, ?, ?, ?, ?)";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([$marca, $modello, $prezzo, $sconto, $quantita]);
    }

    public function updatePrezzoSconto($id, $prezzo, $sconto) {
        $sql = "UPDATE articoli SET prezzo=?, sconto=? WHERE id=?";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([$prezzo, $sconto, $id]);
    }

    public function delete($marca, $modello) {
        $sql = "DELETE FROM articoli WHERE marca=? AND modello=?";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([$marca, $modello]);
    }

    public function aumentaQuantita($id, $quantita) {
        $sql = "UPDATE articoli SET quantita = quantita + ? WHERE id=?";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([$quantita, $id]);
    }

    public function getValoreTotale() {
        $stmt = $this->conn->query("SELECT SUM(prezzo * quantita) AS totale FROM articoli");
        return $stmt->fetch(PDO::FETCH_ASSOC)['totale'];
    }

    public function getValorePerMarca() {
        $sql = "SELECT marca, SUM((prezzo - prezzo * sconto / 100) * quantita) AS valore FROM articoli GROUP BY marca";
        $stmt = $this->conn->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getPrezzoMinMax() {
        $stmt = $this->conn->query("SELECT MIN(prezzo) AS min, MAX(prezzo) AS max FROM articoli");
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function diminuisciQuantita($id) {
        $sql = "UPDATE articoli SET quantita = quantita - 1 WHERE id=? AND quantita > 0";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([ $id]);
    }


    public function getById($id) {
        $stmt = $this->conn->prepare("SELECT * FROM articoli WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    
}
