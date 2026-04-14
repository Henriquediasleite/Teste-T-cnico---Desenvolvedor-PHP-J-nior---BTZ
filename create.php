<?php
require 'config.php';

$erro = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
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

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Novo Produto</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100 p-8">
    <div class="max-w-lg mx-auto bg-white rounded shadow p-6">
        <h1 class="text-2xl font-bold mb-4">Novo Produto</h1>

        <?php if($erro): ?>
            <div class="bg-red-100 text-red-700 p-2 mb-4 rounded">
                <?= $erro ?>
            </div>
        <?php endif; ?>

        <form action="POST">
            <div class="mb-4">
                <label class="block mb-1 font-semibold">Nome *</label>
                <input type="text" name="name" class="w-full border rounded px-3 py-2" required value="<?= htmlspecialchars($_POST['name'] ?? '') ?>">
            </div>

            <div class="mb-4">
                <label class="block mb-1 font-semibold">Descrição</label>
                <textarea name="descricao" class="w-full border rounded px-3 py-2"><?= htmlspecialchars($_POST['descricao'] ?? '') ?></textarea>
            </div>

            <div class="mb-4">
                <label class="block mb-1 font-semibold">Preço *</label>
                <input type="number" step="0.01" name="preco" class="w-full border rounded px-3 py-2" required value="<?= htmlspecialchars($_POST['preco'] ?? '') ?>">
            </div>

            <div class="mb-4">
                <label class="block mb-1 font-semibold">Quantidade *</label>
                <input type="number" name="quantidade" class="w-full border rounded px-3 py-2" required value="<?= htmlspecialchars($_POST['quantidade'] ?? '') ?>">
            </div>
        </form>
    </div>
    
</body>