<?php

    session_start();

    if ( !isset($_SESSION["nome"]))
    {
        header("location: login.php");
    }
?>
<?php
// Incluindo o arquivo de conexão com o banco de dados
include "conexao.php"; // Verifique se o arquivo 'conexao.php' está configurado corretamente

// Verificando se o formulário foi enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Coletando os dados do formulário
    $descricao = $_POST["descricao"];
    $preco = $_POST["preco"];
    $categoria = $_POST["categoria"];
    $fornecedor = $_POST["fornecedor"];

    // Validando se os campos não estão vazios (recomendado)
    if (empty($descricao) || empty($preco) || empty($categoria) || empty($fornecedor)) {
        echo "Todos os campos são obrigatórios!";
        exit;
    }

    // Exibindo os dados para conferência (opcional)
    echo "Descrição: $descricao <br>";
    echo "Preço: $preco <br>";
    echo "Categoria: $categoria <br>";
    echo "Fornecedor: $fornecedor <br>";

    // Preparando a consulta SQL para inserir os dados na tabela 'produto'
    $sql = "INSERT INTO produto (descricao, preco, categoria, fornecedor)
            VALUES (:descricao, :preco, :categoria, :fornecedor)";

    // Preparando a execução da query
    $stmt = $conexao->prepare($sql);

    // Vinculando os valores aos parâmetros da consulta SQL
    $stmt->bindValue(':descricao', $descricao);
    $stmt->bindValue(':preco', $preco);
    $stmt->bindValue(':categoria', $categoria);
    $stmt->bindValue(':fornecedor', $fornecedor);

    // Executando a consulta e verificando se o produto foi cadastrado com sucesso
    if ($stmt->execute()) {
        echo "<p>O produto foi cadastrado com sucesso!</p>";
    } else {
        echo "<p>Erro ao cadastrar o produto. Tente novamente.</p>";
    }
}

?>

