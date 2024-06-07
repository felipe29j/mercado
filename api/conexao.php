<?php
$host = 'localhost';
$port = '8080'; // Altere para a porta correta, se necessário porta padrão: 5432
$dbname = 'mercado';
$username = 'postgres';
$password = 'Fe@290196';

try {
    $pdo = new PDO("pgsql:host=$host;port=$port;dbname=$dbname", $username, $password);
    
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
} catch (PDOException $e) {
    die("Erro ao conectar ao banco de dados: " . $e->getMessage());
}
?>
