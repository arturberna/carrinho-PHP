<?php
require 'banco.php';

// Recuperar produtos do banco de dados
$pdo = Banco::conectar();
$stmt = $pdo->query("SELECT * FROM produto");
$produto = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta nome="viewport" content="width=device-width, initial-scale=1.0">
    <title>Galeria de Produtos</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f9;
            color: #333;
        }
        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
        }
        h1 {
            text-align: center;
            margin-bottom: 20px;
        }
        .grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
            gap: 20px;
        }
        .card {
            background: #fff;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            padding: 15px;
            display: flex;
            flex-direction: column;
            align-items: center;
        }
        .card img {
            max-width: 100%;
            border-radius: 8px;
            margin-bottom: 10px;
        }
        .card h2 {
            font-size: 18px;
            margin-bottom: 10px;
        }
        .card p {
            font-size: 16px;
            margin-bottom: 15px;
        }
        .card .preco {
            font-weight: bold;
            color: #27ae60;
            margin-bottom: 15px;
        }
        .card button {
            background-color: #007bff;
            color: #fff;
            border: none;
            padding: 10px 15px;
            border-radius: 5px;
            cursor: pointer;
            font-size: 14px;
            display: flex;
            align-items: center;
            gap: 5px;
        }
        .card button:hover {
            background-color: #0056b3;
        }
        .card button i {
            font-size: 16px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Galeria de Produtos</h1>
        <div class="grid">
            <?php foreach ($produto as $product): ?>
            <div class="card">
                <img width="200" src="<?= $product['imagem']; ?>" alt="<?= $product['nome']; ?>">
                <h2><?= $product['nome']; ?></h2>
                <p class="preco">R$ <?= number_format($product['preco'], 2, ',', '.'); ?></p>
                <form action="processamento.php" method="post">
                    <input type="hidden" name="id_produto" value="<?= $product['id']; ?>">
                    <input type="hidden" name="quantidade" value="1">
                    <button type="submit">
                        <i>🛒</i> Adicionar ao Carrinho
                    </button>
                </form>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</body>
</html>
