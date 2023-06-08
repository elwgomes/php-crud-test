<?php
require_once 'conexao.php';
global $conn;

function saveProductInfo($conn)
{
    $nome = $_POST['nome'];
    $sku = $_POST['sku'];
    $descricao = $_POST['descricao'];

    $produtoId = null;
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
    }

    $stmt = $conn->prepare('INSERT INTO produtos (nome, sku, descricao, foto) VALUES (:nome, :sku, :descricao, :foto)');
    $stmt->bindValue(':nome', $nome);
    $stmt->bindValue(':sku', $sku);
    $stmt->bindValue(':descricao', $descricao);
    $stmt->bindValue(':foto', $fotoCaminho ?? '');

    if ($stmt->execute()) {
        $produtoId = $conn->lastInsertId();
        saveVariationsInfo($conn, $produtoId);
        redirectTo('index.php');
    } else {
        echo 'Erro ao inserir o produto no banco de dados.';
    }
}

function saveVariationsInfo($conn, $produtoId)
{
    $estoque = $_POST['estoque'];
    $preco = $_POST['preco'];
    $tipoVariacao = $_POST['tipo_variacao'];
    $descricaoVariacao = $_POST['descricao_variacao'];

    for ($i = 0; $i < count($estoque); $i++) {
        $stmt = $conn->prepare('INSERT INTO variacoes (produto_id, estoque, preco, tipo_variacao, descricao_variacao) VALUES (:produto_id, :estoque, :preco, :tipo_variacao, :descricao_variacao)');
        $stmt->bindValue(':produto_id', $produtoId);
        $stmt->bindValue(':estoque', $estoque[$i]);
        $stmt->bindValue(':preco', $preco[$i]);
        $stmt->bindValue(':tipo_variacao', $tipoVariacao[$i]);
        $stmt->bindValue(':descricao_variacao', $descricaoVariacao[$i]);
        $stmt->execute();
    }
}

function redirectTo($location)
{
    header("Location: $location");
    exit;
}

saveProductInfo($conn);
