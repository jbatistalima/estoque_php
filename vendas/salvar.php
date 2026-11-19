<?php

include '../conexao.php';

$cliente_id = $_POST['cliente_id'];

$produto_id = $_POST['produto_id'];
$quantidade = $_POST['quantidade'];
$valor_unitario = $_POST['valor_unitario'];

$total = 0;

foreach($produto_id as $i => $produto){

if(empty($produto)){
continue;
}

$subtotal =
$quantidade[$i] *
$valor_unitario[$i];

$total += $subtotal;
}

$sql = "
INSERT INTO vendas
(
cliente_id,
valor_total
)
VALUES
(
$cliente_id,
$total
)
RETURNING id
";

$res = pg_query($con, $sql);

$venda_id = pg_fetch_result($res, 0, 'id');

foreach($produto_id as $i => $produto){

if(empty($produto)){
continue;
}

$qtd = $quantidade[$i];
$valor = $valor_unitario[$i];

$subtotal = $qtd * $valor;

$estoque_sql = "
SELECT estoque_atual
FROM produtos
WHERE id = $produto
";

$estoque_res =
pg_query($con,$estoque_sql);

$estoque =
pg_fetch_result(
$estoque_res,
0,
'estoque_atual'
);

if($qtd > $estoque){
die(
"Estoque insuficiente para o produto ".
$produto
);
}

pg_query($con,"
INSERT INTO vendas_itens
(
venda_id,
produto_id,
quantidade,
valor_unitario,
subtotal
)
VALUES
(
$venda_id,
$produto,
$qtd,
$valor,
$subtotal
)
");

pg_query($con,"
UPDATE produtos
SET estoque_atual =
estoque_atual - $qtd
WHERE id = $produto
");

pg_query($con,"
INSERT INTO movimentacoes
(
produto_id,
tipo,
quantidade,
observacao
)
VALUES
(
$produto,
'SAIDA',
$qtd,
'Venda Nº $venda_id'
)
");
}

header(
"Location: consultar.php?id=$venda_id"
);
exit;
