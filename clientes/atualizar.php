<?php

include("../conexao.php");

$id = $_POST['id'];
$nome = trim($_POST['nome']);
$cpf_cnpj = trim($_POST['cpf_cnpj']);
$telefone = trim($_POST['telefone']);
$email = trim($_POST['email']);
$endereco = trim($_POST['endereco']);
$bairro = trim($_POST['bairro']);
$cidade = trim($_POST['cidade']);
$estado = trim($_POST['estado']);
$data_cadastro = trim($_POST['data_cadastro']);

$sql = "UPDATE clientes
SET nome = $1, cpf_cnpj  = $2, telefone = $3, email = $4, endereco = $5, bairro = $6, cidade = $7, estado = $8, data_cadastro = $9
WHERE id = $10";

$res = pg_query_params(
$con,
$sql,
array($nome, $cpf_cnpj, $telefone, $email, $endereco, $bairro, $cidade, $estado, $data_cadastro, $id)
);

if (!$res) {
die("Erro ao atualizar cliente: " . pg_last_error($con));
}

header("Location: index.php");
exit;

?>