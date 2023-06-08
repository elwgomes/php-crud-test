<?php
require_once 'conexao.php';
global $conn;

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    deleteProduct($id);
} else {
    echo 'ID do produto não fornecido.';
}

function deleteProduct($id)
{
    global $conn;

    $stmt = $conn->prepare('DELETE FROM produtos WHERE id = :id');
    $stmt->bindValue(':id', $id);

    if ($stmt->execute()) {
        redirectTo('index.php');
    } else {
        echo 'Erro ao excluir o produto.';
    }
}
function redirectTo($location)
{
    header("Location: $location");
    exit;
}
?>
