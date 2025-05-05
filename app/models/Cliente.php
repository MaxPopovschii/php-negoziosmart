<?php
require_once __DIR__ . '/../core/Database.php';
class Cliente {
    private $conn;

    public function __construct() {
        $this->conn = Database::getConnection();
    }

    public function getAll() {
        $stmt = $this->conn->query("SELECT * FROM clienti");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    // Funzione per inserire un cliente
    public function inserisciCliente($nome, $cognome,  $email, $telefono) {
        $stmt = $this->conn->prepare("INSERT INTO clienti (nome, cognome,  email, telefono) VALUES (?, ?, ?, ?, ?)");
        $stmt->execute([$nome, $cognome, $email, $telefono]);
    }


    public function getById($id) {
        $stmt = $this->conn->prepare("SELECT * FROM clienti WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}
?>