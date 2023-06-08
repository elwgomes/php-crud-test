<?php
require_once 'conexao.php';
global $conn;

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $stmt = $conn->prepare('SELECT * FROM variacoes WHERE id = :id');
    $stmt->bindValue(':id', $id);
    $stmt->execute();
    $variacao = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($variacao) {
        renderizarFormularioEdicao($variacao, $id);
    } else {
        echo 'Variação não encontrada.';
    }
} else {
    echo 'ID da variação não fornecido.';
}

function renderizarFormularioEdicao($variacao, $id)
{
    ?>
    <!DOCTYPE html>
    <html>
    <head>
        <title>Editar Variação</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
        <link href="style/style.css" rel="stylesheet">

    </head>
    <body>

    <nav class="navbar navbar-dark bg-dark justify-content-center">
        <h2>PHP CRUD - Test</h2>
    </nav>
    <div class="content-editar-variacao">
    <h1>Editar Variação</h1>
    <form action="salvar_edicao_variacao.php?id=<?php echo $id; ?>" method="post">
        <label>Estoque:</label><br>
        <input type="number" name="estoque" value="<?php echo $variacao['estoque']; ?>" required>
        <br><br>
        <label>Preço:</label><br>
        <input type="text" name="preco" value="<?php echo $variacao['preco']; ?>" required>
        <br><br>
        <label>Tipo de Variação:</label><br>
        <input type="text" name="tipo_variacao" value="<?php echo $variacao['tipo_variacao']; ?>" required>
        <br><br>
        <label>Descrição da Variação:</label><br>
        <textarea name="descricao_variacao"><?php echo $variacao['descricao_variacao']; ?></textarea>
        <br><br>
        <input class="btn btn-success" type="submit" value="Salvar"><br><br>
        <a class="botao btn btn-primary" href="index.php">Voltar</a>
    </form>
    </div>
    </body>
    </html>
    <?php
}
?>
