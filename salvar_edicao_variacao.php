<?php
require_once 'conexao.php';
global $conn;

// Verificar se o ID da variação foi fornecido
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Consultar dados da variação
    $variacao = buscarVariacaoPorId($id);

    if ($variacao) {
        // Atualizar informações da variação
        $estoque = $_POST['estoque'] ?? $variacao['estoque'];
        $preco = $_POST['preco'] ?? $variacao['preco'];
        $tipoVariacao = $_POST['tipo_variacao'] ?? $variacao['tipo_variacao'];
        $descricaoVariacao = $_POST['descricao_variacao'] ?? $variacao['descricao_variacao'];

        // Atualizar variação no banco de dados
        if (atualizarVariacao($id, $estoque, $preco, $tipoVariacao, $descricaoVariacao)) {
            redirecionarParaVisualizar($variacao['produto_id']);
        } else {
            exibirMensagemErro('Falha ao atualizar a variação.');
        }
    } else {
        exibirMensagemErro('Variação não encontrada.');
    }
} else {
    exibirMensagemErro('ID da variação não fornecido.');
}

// Função para buscar dados da variação por ID
function buscarVariacaoPorId($id)
{
    global $conn;
    $stmt = $conn->prepare('SELECT * FROM variacoes WHERE id = :id');
    $stmt->bindValue(':id', $id);
    $stmt->execute();
    return $stmt->fetch(PDO::FETCH_ASSOC);
}

// Função para atualizar a variação no banco de dados
function atualizarVariacao($id, $estoque, $preco, $tipoVariacao, $descricaoVariacao)
{
    global $conn;
    $stmt = $conn->prepare('UPDATE variacoes SET estoque = :estoque, preco = :preco, tipo_variacao = :tipo_variacao, descricao_variacao = :descricao_variacao WHERE id = :id');
    $stmt->bindValue(':estoque', $estoque);
    $stmt->bindValue(':preco', $preco);
    $stmt->bindValue(':tipo_variacao', $tipoVariacao);
    $stmt->bindValue(':descricao_variacao', $descricaoVariacao);
    $stmt->bindValue(':id', $id);
    return $stmt->execute();
}

// Função para redirecionar para a página de visualizar
function redirecionarParaVisualizar($produtoId)
{
    header('Location: visualizar.php?id=' . $produtoId);
    exit;
}

// Função para exibir mensagem de erro
function exibirMensagemErro($mensagem)
{
    echo $mensagem;
}
