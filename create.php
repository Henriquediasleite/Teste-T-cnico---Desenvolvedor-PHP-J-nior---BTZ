<?php
require 'config.php';

$erro = '';

if ($_SERVER[REQUEST_METHOD] === 'POST') {
    $nome = trim($_POST['name'] ?? '');
    $descricao = trim($_POST['descricao'] ?? '');
    $preco = $_POST['preco'] ?? '';
    $quantidade = $_POST['quantidade'] ?? '';

    if(!$nome || !$preco || !$quantidade){
        $erro = 'Preencha os campos obrigatórios';
    } else {
        $stmt = $pdo->prepare("INSERT INTO produtos (nome, descricao, preco, quantidade) VALUES (?, ?, ?, ?)");
        $stmt->execute([$nome, $descricao, $preco, $quantidade]);
        header('Location: index.php?msg=criado');
        exit;
    }
}
?>
