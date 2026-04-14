<?php require 'config.php'; ?> 

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRUD de Produtos</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100 p-8">
    <div class="max-w-4xl mx-auto">

        <div class="flex justify-between items-center mb-6">
            <h1 class="text-2xl font-bold text-gray-800">CRUD de Produtos</h1>
            <a href="create.php" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                + Novo Produto
            </a>
        </div>

        <?php if (isset($_GET['msg'])): ?>
            <div class="bg-green-100 text-green-800 p-3 rounded mb-4>"</div>
                <?php
                    if ($_GET['msg'] == 'criado') echo 'Produto cadastrado com sucesso!';
                    if ($_GET['msg'] == 'editado') echo 'Produto atualizado com sucesso!';
                    if ($_GET['msg'] == 'excluido') echo 'Produto excluído com sucesso!';
                ?>
            </div>
        <?php endif; ?>

        <div class="bg-white rounded shadow overflow-hidden">
            <table class="w-full text-sm">
                <thead class="bg-gray-200 text-gray-700">
                    <tr>
                        <th class="p-4 text-left">#</th>
                        <th class="p-4 text-left">Nome</th>
                        <th class="p-4 text-left">Descrição</th>
                        <th class="p-4 text-left">Preço</th>
                        <th class="p-4 text-left">Qtd</th>
                        <th class="p-4 text-left">Ações</th>
                    </tr>
                </thead>

                <tbody>
                    <?php
                    $stmt = $pdo->query("SELECT * FROM produtos");
                    $produtos = $stmt->fetchAll(PDO::FETCH_ASSOC);
                    ?>
                </tbody>
            </table>
        </div>