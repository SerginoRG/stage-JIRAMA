<?php

class Db {
    private const HOST = "localhost";
    private const DBNAME = "server";
    private const USER = "root";
    private const PASSWORD = "";
    private const DNS = "mysql:host=" . self::HOST . ";dbname=" . self::DBNAME . ";charset=utf8";

    function connexion() {
        try {
            $pdo = new PDO(self::DNS, self::USER, self::PASSWORD);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            
            return $pdo;
        } catch (PDOException $e) {
            echo "Échec de la connexion : " . $e->getMessage();
            return null;
        }
    }
}

// Test de connexion
$db = new Db();
$conn = $db->connexion();

?>
