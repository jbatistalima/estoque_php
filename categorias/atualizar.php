<?php

include("../conexao.php");

$id = $_POST['id'];
$descricao = trim($_POST['descricao']);

$sql = "UPDATE categorias
SET descricao = $1
WHERE id = $2";

$res = pg_query_params(
$con,
$sql,
array($descricao, $id)
);

if (!$res) {
die("Erro ao atualizar categoria: " . pg_last_error($con));
}

header("Location: index.php");
exit;

?>