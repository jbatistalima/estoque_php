<?php

include("../conexao.php");

$id = $_POST['id'];
$razao_social = trim($_POST['razao_social']);
$fantasia = trim($_POST['fantasia']);
$cnpj = trim($_POST['cnpj']);
$telefone = trim($_POST['telefone']);
$email = trim($_POST['email']);
$endereco = trim($_POST['endereco']);
$bairro = trim($_POST['bairro']);
$cidade = trim($_POST['cidade']);
$estado = trim($_POST['estado']);
$data_cadastro = trim($_POST['data_cadastro']);

$sql = "UPDATE fornecedores
SET razao_social = $1, fantasia = $2, cnpj = $3, telefone = $4, email = $5, endereco = $6, bairro = $7, cidade = $8, estado = $9, data_cadastro = $10
WHERE id = $11";

$res = pg_query_params(
$con,
$sql,
array($razao_social, $fantasia, $cnpj, $telefone, $email, $endereco, $bairro, $cidade, $estado, $data_cadastro, $id)
);

if (!$res) {
die("Erro ao atualizar fornecedor: " . pg_last_error($con));
}

header("Location: index.php");
exit;

?>