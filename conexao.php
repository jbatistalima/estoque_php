<?php

$con = pg_connect(
"host=localhost port=5433 dbname=estoque user=seu usuário password=senha do seu banco"
);

if (!$con) {
die("Erro ao conectar ao banco.");
}
?>
