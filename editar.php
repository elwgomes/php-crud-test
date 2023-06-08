<!DOCTYPE html>
<html>
<head>
    <title>Editar Produto</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <link href="style/style.css" rel="stylesheet">
</head>
<body>
<nav class="navbar navbar-dark bg-dark justify-content-center">
    <h2>PHP CRUD - Test</h2>
</nav>
<div class="content-editar">
<h1>Editar Produto</h1>
<?php
require_once 'conexao.php';
global $conn;

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $stmt = $conn->prepare('SELECT * FROM produtos WHERE id = :id');
    $stmt->bindValue(':id', $id);
    $stmt->execute();
    $produto = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($produto) {
        renderizarFormulario($produto, $id);
    } else {
        echo 'Produto não encontrado.';
    }
} else {
    echo 'ID do produto não fornecido.';
}

function renderizarFormulario($produto, $id)
{
    ?>
    <form action="salvar_edicao.php?id=<?php echo $id; ?>" method="post" enctype="multipart/form-data">
        <label for="nome">Nome do Produto:</label><br>
        <input type="text" name="nome" id="nome" value="<?php echo $produto['nome']; ?>" required>
        <br><br>
        <label for="sku">SKU:</label><br>
        <input type="text" name="sku" id="sku" value="<?php echo $produto['sku']; ?>" required>
        <br><br>
        <label for="fotos">Fotos:</label><br>
        <input type="file" name="fotos[]" id="fotos" multiple>
        <br><br>
        <label for="descricao">Descrição:</label><br>
        <textarea name="descricao" id="descricao"><?php echo $produto['descricao']; ?></textarea>
        <br><br>
        <input class="btn btn-success" type="submit" value="Salvar"><br><br>
        <a class="botao btn btn-primary" href="index.php">Voltar</a>
    </form>
    <?php
}
?>
</div>
</body>
</html>
