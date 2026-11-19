<?php

include("../conexao.php");

$id = $_POST['id'];

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

$sql = "UPDATE produtos
SET codigo = $1,
descricao = $2,
categoria_id = $3,
fornecedor_id = $4,
unidade = $5,
estoque_atual = $6,
estoque_minimo = $7,
preco_custo = $8,
preco_venda = $9,
ativo = $10
WHERE id = $11";

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
$ativo,
$id
)
);

if (!$res) {
    die("Erro ao atualizar produto: " . pg_last_error($con));
}

header("Location: index.php");
exit;

?>