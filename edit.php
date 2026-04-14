<?php
require 'config.php';

$id = $_GET['id'] ?? null;
if (!$id) { header('Location: index.php'); exit; }

$stmt = $pdo->prepare("SELECT * FROM produtos WHERE id = ?");
$stmt->execute([$id]);
$produto = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$produto) { header('Location: index.php'); exit; }

$erro = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome       = trim($_POST['nome'] ?? '');
    $descricao  = trim($_POST['descricao'] ?? '');
    $preco      = $_POST['preco'] ?? '';
    $quantidade = $_POST['quantidade'] ?? '';

    if (!$nome || !$preco || !$quantidade) {
        $erro = 'Preencha todos os campos obrigatórios.';
    } else {
        $stmt = $pdo->prepare("UPDATE produtos SET nome=?, descricao=?, preco=?, quantidade=? WHERE id=?");
        $stmt->execute([$nome, $descricao, $preco, $quantidade, $id]);
        header('Location: index.php?msg=editado');
        exit;
    }

    // Mantém os valores digitados se der erro
    $produto = array_merge($produto, $_POST);
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Produto</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 p-8">
    <div class="max-w-lg mx-auto bg-white rounded shadow p-6">
        <h1 class="text-xl font-bold mb-4 text-gray-800">Editar Produto</h1>

        <?php if ($erro): ?>
            <div class="bg-red-100 text-red-700 p-3 rounded mb-4"><?= $erro ?></div>
        <?php endif; ?>

        <form method="POST">
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700 mb-1">Nome *</label>
                <input type="text" name="nome" required
                       class="w-full border rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-400"
                       value="<?= htmlspecialchars($produto['nome']) ?>">
            </div>
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700 mb-1">Descrição</label>
                <textarea name="descricao" rows="3"
                          class="w-full border rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-400"><?= htmlspecialchars($produto['descricao']) ?></textarea>
            </div>
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700 mb-1">Preço *</label>
                <input type="number" name="preco" step="0.01" min="0" required
                       class="w-full border rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-400"
                       value="<?= htmlspecialchars($produto['preco']) ?>">
            </div>
            <div class="mb-6">
                <label class="block text-sm font-medium text-gray-700 mb-1">Quantidade *</label>
                <input type="number" name="quantidade" min="0" required
                       class="w-full border rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-400"
                       value="<?= htmlspecialchars($produto['quantidade']) ?>">
            </div>
            <div class="flex gap-3">
                <button type="submit"
                        class="bg-yellow-500 text-white px-5 py-2 rounded hover:bg-yellow-600">
                    Atualizar
                </button>
                <a href="index.php" class="text-gray-500 px-5 py-2 rounded border hover:bg-gray-100">
                    Cancelar
                </a>
            </div>
        </form>
    </div>
</body>
</html>