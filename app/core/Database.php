<?php
class Database {
    private static $conn;

    public static function getConnection() {
        if (!self::$conn) {
            $env = parse_ini_file(__DIR__ . '/../../.env');

            $host = $env['DB_HOST'];
            $db = $env['DB_NAME'];
            $user = $env['DB_USER'];
            $pass = $env['DB_PASS'];

            $dsn = "mysql:host=$host;dbname=$db;charset=utf8mb4";
            try {
                self::$conn = new PDO($dsn, $user, $pass);
                self::$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            } catch (PDOException $e) {
                die("Connessione fallita: " . $e->getMessage());
            }
        }
        return self::$conn;
    }
}
