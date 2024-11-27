<?php
include 'banco.php';
$pdo = Banco::conectar();
$stmt = $pdo->query("SELECT carrinho.*, produto.nome, produto.preco 
                     FROM carrinho 
                     JOIN produto ON carrinho.id_produto = produto.id");
$carrinho = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Carrinho</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            padding: 10px;
            text-align: left;
            border: 1px solid #ddd;
        }
        th {
            background-color: #f4f4f4;
        }
        .actions button {
            background-color: #007bff;
            color: white;
            padding: 5px 10px;
            border: none;
            cursor: pointer;
        }
        .actions button:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <h1>Carrinho</h1>
    <table border="1">
        <tr>
            <th>Produto</th>
            <th>Quantidade</th>
            <th>Preço Unitário</th>
            <th>Subtotal</th>
        </tr>
        <?php $total = 0; ?>
        <?php foreach ($carrinho as $item): ?>
        <tr>
            <td><?= $item['nome']; ?></td>
            <td><?= $item['quantidade']; ?></td>
            <td>R$ <?= number_format($item['preco'], 2, ',', '.'); ?></td>
            <td>R$ <?= number_format($item['preco'] * $item['quantidade'], 2, ',', '.'); ?></td>
        </tr>
        <?php $total += $item['preco'] * $item['quantidade']; ?>
        <?php endforeach; ?>
        <tr>
            <td colspan="3"><strong>Total:</strong></td>
            <td><strong>R$ <?= number_format($total, 2, ',', '.'); ?></strong></td>
        </tr>
    </table>
    <p><a href="index.php">Continuar Comprando</a></p>
</body>
</html>
