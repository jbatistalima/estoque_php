<?php

include("../conexao.php");

$descricao = trim($_POST['descricao']);

$sql = "INSERT INTO categorias(descricao)
VALUES($1)";

pg_query_params(
$con,
$sql,
array($descricao)
);

header("Location:index.php");
exit;