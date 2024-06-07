<?php
require 'conexao.php';

$vendaRegistrada = false;

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit'])) {
    $produtos_quantidades = $_POST['produtos_quantidades'];
    foreach ($produtos_quantidades as $produto_id => $quantidade) {
        if ($quantidade > 0) {
            try {
                $stmt = $pdo->prepare('SELECT p.preco, t.imposto_percentual FROM produtos p JOIN tipos_produtos t ON p.tipo_id = t.id WHERE p.id = ?');
                $stmt->execute([$produto_id]);
                $produto = $stmt->fetch();

                if ($produto) {
                    $preco = $produto['preco'];
                    $imposto_percentual = $produto['imposto_percentual'];

                    $valor_total = $preco * $quantidade;
                    $valor_imposto = ($valor_total * $imposto_percentual) / 100;

                    $stmt = $pdo->prepare('INSERT INTO vendas (produto_id, quantidade, valor_total, valor_imposto) VALUES (?, ?, ?, ?)');
                    $stmt->execute([$produto_id, $quantidade, $valor_total, $valor_imposto]);

                    $vendaRegistrada = true;
                }
            } catch (PDOException $e) {
                echo 'Erro ao processar a venda: ' . $e->getMessage();
            }
        }
    }
    echo '<script>';
    if ($vendaRegistrada) {
        echo 'alert("Venda registrada com sucesso!");';
    } else {
        echo 'alert("Falha ao registrar a venda!");';
    }
    echo 'window.location.href = "../registrar_venda.php";';
    echo '</script>';
    exit();
}
?>
