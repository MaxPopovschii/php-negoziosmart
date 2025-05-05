<?php

use mysqli;

class Database {
    private static ?mysqli $conn = null;
    private static array $config = [];

    /**
     * Inizializza la connessione al database
     * @throws Exception Se la configurazione del database non è valida o la connessione fallisce
     * @return mysqli
     */
    public static function getConnection(): mysqli {
        if (self::$conn === null) {
            self::loadConfig();
            self::connect();
            if (!(self::$conn instanceof mysqli)) {
                throw new Exception("Connessione al database non riuscita");
            }
        }
        return self::$conn;
    }

    /**
     * Carica la configurazione dal file .env
     * @throws Exception Se il file .env non esiste o mancano parametri necessari
     */
    private static function loadConfig(): void {
        $envPath = __DIR__ . '/../../.env';
        
        if (!file_exists($envPath)) {
            throw new Exception('File di configurazione .env non trovato');
        }

        self::$config = parse_ini_file($envPath);
        
        $requiredParams = ['DB_HOST', 'DB_NAME', 'DB_USER', 'DB_PASS'];
        foreach ($requiredParams as $param) {
            if (!isset(self::$config[$param])) {
                throw new Exception("Parametro di configurazione mancante: {$param}");
            }
        }
    }

    /**
     * Stabilisce la connessione al database
     * @throws Exception Se la connessione fallisce
     */
    private static function connect(): void {
        try {
            $connection = new mysqli(
                self::$config['DB_HOST'],
                self::$config['DB_USER'],
                self::$config['DB_PASS'],
                self::$config['DB_NAME']
            );

            if ($connection->connect_error) {
                throw new Exception("Connessione fallita: " . $connection->connect_error);
            }

            self::$conn = $connection;

            self::$conn->set_charset("utf8mb4");
            
        } catch (Exception $e) {
            throw new Exception("Errore di connessione al database: " . $e->getMessage());
        }
    }

    /**
     * Chiude la connessione al database
     */
    public static function closeConnection(): void {
        if (self::$conn !== null) {
            self::$conn->close();
            self::$conn = null;
        }
    }
}
