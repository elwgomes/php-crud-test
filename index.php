<?php
require_once 'conexao.php';

global $conn;

// Consulta de produtos
$query = $conn->query('SELECT * FROM produtos');
$produtos = $query->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html>
    <title>Cadastro de Produtos</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <link href="style/style.css" rel="stylesheet"/>

</head>
<body>

<nav class="navbar navbar-dark bg-dark justify-content-center">
    <h2>PHP CRUD - Test</h2>
</nav>
<div class="content-index">
<h1>Cadastro de Produtos</h1>
<a class="btn btn-success" href="cadastro.php">Novo Produto</a>
<br><br>
<table class="table table-dark">
    <tr>
        <th>Nome</th>
        <th>SKU</th>
        <th>Ações</th>
    </tr>
    <?php foreach ($produtos as $produto): ?>
        <tr>
            <td><?= $produto['nome'] ?></td>
            <td><?= $produto['sku'] ?></td>
            <td>
                <a class="btn btn-primary" href="visualizar.php?id=<?= $produto['id'] ?>">Visualizar</a>
                <a class="btn btn-warning" href="editar.php?id=<?= $produto['id'] ?>">Editar</a>
                <a class="btn btn-danger" href="excluir.php?id=<?= $produto['id'] ?>" onclick="return confirm('Tem certeza que deseja excluir?')">Excluir</a>
            </td>
        </tr>
    <?php endforeach; ?>
</table>
</div>
</body>
</html>
