<?php include '../auth.php'; ?>

<?php

session_start();

include '../conexao.php';

$fornecedor_id = $_POST['fornecedor_id'];

$produtos = $_POST['produto_id'];
$qtds = $_POST['quantidade'];
$valores = $_POST['valor_unitario'];

$total = 0;

foreach($produtos as $i => $produto_id){

if(empty($produto_id))
continue;

$subtotal =
$qtds[$i] *
$valores[$i];

$total += $subtotal;
}

$sql = "
INSERT INTO compras
(
fornecedor_id,
usuario_id,
valor_total
)
VALUES
(
$fornecedor_id,
".$_SESSION['usuario_id'].",
$total
)
RETURNING id
";

$res = pg_query($con, $sql);

$compra_id = pg_fetch_result($res,0,'id');

foreach($produtos as $i => $produto_id){

if(empty($produto_id))
continue;

$quantidade = $qtds[$i];
$valor = $valores[$i];
$subtotal = $quantidade * $valor;

pg_query($con,"INSERT INTO compras_itens(compra_id, produto_id, quantidade, valor_unitario, subtotal)
VALUES($compra_id, $produto_id, $quantidade, $valor, $subtotal)");

pg_query($con,"UPDATE produtos SET estoque_atual = estoque_atual + $quantidade WHERE id = $produto_id");

pg_query($con, "INSERT INTO movimentacoes(produto_id, usuario_id, tipo, quantidade, observacao)
VALUES($produto_id, 'ENTRADA', $quantidade, 'Compra nº $compra_id')");}

header("Location: consultar.php?id=$compra_id");
exit;


