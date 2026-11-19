<?php

$con = pg_connect(
"host=localhost port=5433 dbname=estoque user=postgres password=postgres"
);

if (!$con) {
die("Erro ao conectar ao banco.");
}
?>
