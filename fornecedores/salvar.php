<?php

include("../conexao.php");

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

$sql = "INSERT INTO fornecedores(razao_social, fantasia, cnpj, telefone, email, endereco, bairro, cidade, estado, data_cadastro)
VALUES($1, $2, $3, $4, $5, $6, $7, $8, $9, $10)";

$res = pg_query_params(
    $con,
    $sql,
    array(
        $razao_social,
        $fantasia,
        $cnpj,
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

header("Location:index.php");
exit;