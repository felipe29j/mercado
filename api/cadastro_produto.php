<?php
require 'conexao.php';

$nome = $_POST['nome'];
$tipo_id = $_POST['tipo_id'];
$preco = str_replace(',', '.', $_POST['preco']);

$stmt = $pdo->prepare('INSERT INTO produtos (nome, tipo_id, preco) VALUES (?, ?, ?)');
$result = $stmt->execute([$nome, $tipo_id, $preco]);

if ($result) {
    session_start();
    $_SESSION['success_message'] = "Produto cadastrado com sucesso!";
} else {
    session_start();
    $_SESSION['error_message'] = "Erro ao cadastrar o produto. Por favor, tente novamente.";
}

header('Location: ../cadastro_produto.php');
exit();
?>
