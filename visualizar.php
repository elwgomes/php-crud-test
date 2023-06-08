<?php
require_once 'conexao.php';

global $conn;

function obterProduto($id, $conn) {
    $stmt = $conn->prepare('SELECT * FROM produtos WHERE id = :id');
    $stmt->bindValue(':id', $id);
    $stmt->execute();
    return $stmt->fetch(PDO::FETCH_ASSOC);
}

function obterVariacoesDoProduto($id, $conn) {
    $stmt = $conn->prepare('SELECT * FROM variacoes WHERE produto_id = :produto_id');
    $stmt->bindValue(':produto_id', $id);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function exibirProduto($produto, $variacoes) {
    if ($produto) {
        echo '<h2>Informações do Produto</h2>';
        echo '<p><strong>Nome:</strong> ' . $produto['nome'] . '</p>';
        echo '<p><strong>SKU:</strong> ' . $produto['sku'] . '</p>';
        echo '<p><strong>Descrição:</strong> ' . $produto['descricao'] . '</p>';
        echo '<h2>Variações</h2>';
        echo '<table class="table table-dark">';
        echo '<tr>';
        echo '<th>Estoque</th>';
        echo '<th>Preço</th>';
        echo '<th>Tipo de Variação</th>';
        echo '<th>Descrição da Variação</th>';
        echo '<th>Ações</th>';
        echo '</tr>';

        foreach ($variacoes as $variacao) {
            echo '<tr>';
            echo '<td>' . $variacao['estoque'] . '</td>';
            echo '<td>' . $variacao['preco'] . '</td>';
            echo '<td>' . $variacao['tipo_variacao'] . '</td>';
            echo '<td>' . $variacao['descricao_variacao'] . '</td>';
            echo '<td><a class="btn btn-warning" href="editar_variacao.php?id=' . $variacao['id'] . '">Editar</a></td>';
            echo '</tr>';
        }

        echo '</table>';
    } else {
        echo 'Produto não encontrado.';
    }
}

function exibirMensagemErro($mensagem) {
    echo $mensagem;
}

// Verificar se o ID do produto foi fornecido
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $produto = obterProduto($id, $conn);
    $variacoes = obterVariacoesDoProduto($id, $conn);
    ?>

    <!DOCTYPE html>
    <html>
    <head>
        <title>Visualizar Produto</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
        <link href="style/style.css" rel="stylesheet">
    </head>
    <body>

    <nav class="navbar navbar-dark bg-dark justify-content-center">
        <h2>PHP CRUD - Test</h2>
    </nav>
    <div class="content-visualizar">
    <h1>Visualizar Produto</h1>
    <?php
    exibirProduto($produto, $variacoes);
    ?>
    <br>
    <a class="btn btn-primary" href="index.php">Voltar</a>
    </div>
    </body>
    </html>

    <?php
} else {
    exibirMensagemErro('ID do produto não fornecido.');
}
?>
