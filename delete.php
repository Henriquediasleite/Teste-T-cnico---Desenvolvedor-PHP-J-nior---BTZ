<?php require 'config.php';

$id = $_GET['id'] ?? null;

if ($id) {
    $stmt = $pdo->prepare('DELETE FROM produtos WHERE id = ?');
    $stmt->execute([$id]);
}

header('Location: index.php?msg=Produto deletado com sucesso!');
exit;
?>