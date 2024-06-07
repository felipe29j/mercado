<?php
require 'conexao.php';

$stmt = $pdo->query('SELECT p.id, p.nome, t.nome AS tipo, p.preco FROM produtos p JOIN tipos_produtos t ON p.tipo_id = t.id');
$produtos = $stmt->fetchAll(PDO::FETCH_ASSOC);

header('Content-Type: application/json');
echo json_encode($produtos);
?>
