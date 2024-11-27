<?php
define("DB_HOST", "localhost");
define("DB_NAME", "mana");
define("DB_USER", "root");
define("DB_PASS", "PkU3qJ35jr(4/r-V");

function getDBConnection() {
    try {
        $conn = new PDO("mysql:host=" . DB_HOST . ";dbname=" . DB_NAME, DB_USER, DB_PASS);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $conn;
    } catch (PDOException $e) {
        die("Error al conectar a la base de datos: " . $e->getMessage());
    }
}
?>