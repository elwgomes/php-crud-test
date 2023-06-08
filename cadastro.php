<!DOCTYPE html>
<html>
<head>
    <title>Cadastro de Produto</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <link href="style/style.css" rel="stylesheet">
</head>
<body>

<nav class="navbar navbar-dark bg-dark justify-content-center">
    <h2>PHP CRUD - Test</h2>
</nav>
<div class="content-cadastro">
<h1>Cadastro de Produto</h1>
<form action="salvar.php" method="post" enctype="multipart/form-data" style="width: 15vw; min-width: 300px">
    <label for="nome">Nome do Produto:</label>
    <input type="text" id="nome" name="nome" required>
    <br><br>
    <label for="sku">SKU:</label>
    <input type="text" id="sku" name="sku" required>
    <br><br>
    <label for="fotos">Fotos:</label>
    <input type="file" id="fotos" name="fotos[]" multiple>
    <br><br>
    <label for="descricao">Descrição:</label>
    <textarea id="descricao" name="descricao"></textarea>
    <br><br>
    <h2>Variação de produto</h2>
    <div id="variacoes">
        <div class="variacao">
            <label for="estoque">Estoque:</label>
            <input type="number" id="estoque" name="estoque[]" required>
            <br><br>
            <label for="preco">Preço:</label>
            <input type="text" id="preco" name="preco[]" required>
            <br><br>
            <label for="tipo_variacao">Tipo de Variação:</label>
            <input type="text" id="tipo_variacao" name="tipo_variacao[]" required>
            <br><br>
            <label for="descricao_variacao">Descrição da Variação:</label>
            <textarea id="descricao_variacao" name="descricao_variacao[]"></textarea>
            <br><br>
        </div>
    </div>
    <button class="btn btn-secondary" type="button" onclick="adicionarVariacao()">Adicionar Variação</button>
    <br><br>
    <input class="btn btn-success" type="submit" value="Salvar"><br><br>
    <a class="botao btn btn-primary" href="index.php">Voltar</a>
</form>
</div>
<script>
    function adicionarVariacao() {
        var variacaoDiv = document.createElement('div');
        variacaoDiv.className = 'variacao';
        variacaoDiv.innerHTML = `
                <h2>Variação de produto</h2>
                <label for="estoque">Estoque:</label><br>
                <input type="number" id="estoque" name="estoque[]" required>
                <br><br>
                <label for="preco">Preço:</label><br>
                <input type="text" id="preco" name="preco[]" required>
                <br><br>
                <label for="tipo_variacao">Tipo de Variação:</label><br>
                <input type="text" id="tipo_variacao" name="tipo_variacao[]" required>
                <br><br>
                <label for="descricao_variacao">Descrição da Variação:</label><br>
                <textarea id="descricao_variacao" name="descricao_variacao[]"></textarea>
                <br><br>
            `;
        document.getElementById('variacoes').appendChild(variacaoDiv);
    }
</script>
</body>
</html>