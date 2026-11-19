<?php

include("../conexao.php");

$codigo = trim($_POST['codigo']);
$descricao = trim($_POST['descricao']);
$categoria_id = $_POST['categoria_id'];
$fornecedor_id = $_POST['fornecedor_id'];
$unidade = trim($_POST['unidade']);
$estoque_atual = trim($_POST['estoque_atual']);
$estoque_minimo = trim($_POST['estoque_minimo']);
$preco_custo = trim($_POST['preco_custo']);
$preco_venda = trim($_POST['preco_venda']);
$ativo = isset($_POST['ativo']) ? 'true' : 'false';

$sql = "INSERT INTO produtos
(
codigo,
descricao,
categoria_id,
fornecedor_id,
unidade,
estoque_atual,
estoque_minimo,
preco_custo,
preco_venda,
ativo
)
VALUES
(
$1,$2,$3,$4,$5,$6,$7,$8,$9,$10
)";

$res = pg_query_params(
$con,
$sql,
array(
$codigo,
$descricao,
$categoria_id,
$fornecedor_id,
$unidade,
$estoque_atual,
$estoque_minimo,
$preco_custo,
$preco_venda,
$ativo
)
);

if (!$res) {
    die("Erro ao salvar produto: " . pg_last_error($con));
}

header("Location: index.php");
exit;

?>