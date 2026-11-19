<?php include '../auth.php'; ?>

<?php

include("../conexao.php");

$nome = trim($_POST['nome']);
$cpf_cnpj = trim($_POST['cpf_cnpj']);
$telefone = trim($_POST['telefone']);
$email = trim($_POST['email']);
$endereco = trim($_POST['endereco']);
$bairro = trim($_POST['bairro']);
$cidade = trim($_POST['cidade']);
$estado = trim($_POST['estado']);
$data_cadastro = trim($_POST['data_cadastro']);

$sql = "INSERT INTO clientes(nome, cpf_cnpj, telefone, email, endereco, bairro, cidade, estado, data_cadastro)
VALUES($1, $2, $3, $4, $5, $6, $7, $8, $9)";

$res = pg_query_params(
$con,
$sql,
array(
$nome,
$cpf_cnpj,
$telefone,
$email,
$endereco,
$bairro,
$cidade,
$estado,
$data_cadastro
)
);

if (!$res) {
die("Erro: " . pg_last_error($con));
}

echo "Cliente salvo com sucesso!";

header("Location:index.php");
exit;