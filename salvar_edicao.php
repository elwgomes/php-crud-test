<?php
require_once 'conexao.php';
global $conn;


function updateProduct($conn)
{
    if (isset($_GET['id'])) {
        $id = $_GET['id'];
        $produto = getProductById($conn, $id);

        if ($produto) {
            $nome = $_POST['nome'];
            $sku = $_POST['sku'];
            $descricao = $_POST['descricao'];

            if (!empty($_FILES['fotos']['name'][0])) {
                $fotoDir = 'E:/www/produto/';
                $produtoDir = $fotoDir . $sku . '/';
                if (!file_exists($produtoDir)) {
                    mkdir($produtoDir, 0777, true);
                }
                for ($i = 0; $i < count($_FILES['fotos']['name']); $i++) {
                    $fotoNome = $_FILES['fotos']['name'][$i];
                    $fotoCaminho = $produtoDir . $fotoNome;
                    move_uploaded_file($_FILES['fotos']['tmp_name'][$i], $fotoCaminho);
                }
                $fotoCaminhoBanco = $fotoCaminho;
            } else {
                $fotoCaminhoBanco = $produto['foto'];
            }

            $stmt = $conn->prepare('UPDATE produtos SET nome = :nome, sku = :sku, descricao = :descricao, foto = :foto WHERE id = :id');
            $stmt->bindValue(':nome', $nome);
            $stmt->bindValue(':sku', $sku);
            $stmt->bindValue(':descricao', $descricao);
            $stmt->bindValue(':foto', $fotoCaminhoBanco);
            $stmt->bindValue(':id', $id);

            if ($stmt->execute()) {
                redirectTo('index.php');
            } else {
                echo 'Erro ao atualizar o produto no banco de dados.';
            }
        } else {
            echo 'Produto não encontrado.';
        }
    } else {
        echo 'ID do produto não fornecido.';
    }
}

function getProductById($conn, $id)
{
    $stmt = $conn->prepare('SELECT * FROM produtos WHERE id = :id');
    $stmt->bindValue(':id', $id);
    $stmt->execute();
    return $stmt->fetch(PDO::FETCH_ASSOC);
}

function redirectTo($location)
{
    header("Location: $location");
    exit;
}

updateProduct($conn);
?>
