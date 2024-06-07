<?php
session_start();

require 'conexao.php';

$nome = $_POST['nome'];
$imposto_percentual = isset($_POST['imposto_percentual']) ? str_replace(',', '.', $_POST['imposto_percentual']) : null;

$stmt = $pdo->prepare('INSERT INTO tipos_produtos (nome, imposto_percentual) VALUES (?, ?)');
$result = $stmt->execute([$nome, $imposto_percentual]);

if ($result) {
    $_SESSION['success_message'] = "Cadastro realizado com sucesso!";
} else {
    $_SESSION['error_message'] = "Erro ao cadastrar. Por favor, tente novamente.";
}

header('Location: ../cadastro_tipo_produto.php');
exit();
?>
