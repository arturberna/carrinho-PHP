<?php
include 'banco.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id_produto = $_POST['id_produto'];
    $quantidade = $_POST['quantidade'];
    $pdo = Banco::conectar();
    // Verificar se o produto existe e se há estoque suficiente
    $stmt = $pdo->prepare("SELECT * FROM produto WHERE id = ?");
    $stmt->execute([$id_produto]);
    $product = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($product && $product['estoque'] >= $quantidade) {
        // Adicionar ao carrinho
        $stmt = $pdo->prepare("INSERT INTO carrinho (id_produto, quantidade) VALUES (?, ?)");
        $stmt->execute([$id_produto, $quantidade]);

        // Atualizar o estoque
        $stmt = $pdo->prepare("UPDATE produto SET estoque = estoque - ? WHERE id = ?");
        $stmt->execute([$quantidade, $id_produto]);

        header('Location: carrinho.php');
    } else {
        echo "Estoque insuficiente ou produto inexistente.";
    }
}
?>
