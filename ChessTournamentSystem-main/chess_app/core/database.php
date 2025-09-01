<?php
function getDB() {
    static $db = null;
    if ($db === null) {
        $host = 'localhost';
        $dbname = 'chess_tournament';
        $user = 'root';
        $pass = '';
        $charset = 'utf8mb4';
        $port = '3307'; 

        $dsn = "mysql:host=$host;dbname=$dbname;charset=$charset;port=$port";
        try {
            $db = new PDO($dsn, $user, $pass);
            $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            die('Database connection failed: ' . $e->getMessage());
        }
    }
    return $db;
}
