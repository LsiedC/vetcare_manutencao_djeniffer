<?php
$host = 'localhost';
// Chamado 12 - Insercao no banco de dados nao estava funcionando pq
// o nome do banco estava errado

$db   = 'vetcare_lsc';
$user = 'root';
$pass = '';
$charset = 'utf8mb4';
$dsn = "mysql:host=$host;dbname=$db;charset=$charset";
try {
    $pdo = new PDO($dsn, $user, $pass, [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
    ]);
} catch (PDOException $e) {
    die('Erro ao conectar ao banco: ' . $e->getMessage());
}
