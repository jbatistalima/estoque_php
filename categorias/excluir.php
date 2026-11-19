<?php

include("../conexao.php");

$id = $_GET['id'];

$sql = "DELETE FROM categorias
WHERE id = $1";

$res = pg_query_params(
$con,
$sql,
array($id)
);

if (!$res) {
die("Erro ao excluir categoria: " . pg_last_error($con));
}

header("Location: index.php");
exit;

?>