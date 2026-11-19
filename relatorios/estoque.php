<?php

include '../conexao.php';

$sql = "
SELECT
    codigo,
    descricao,
    estoque_atual,
    estoque_minimo,
    preco_custo,
    preco_venda
FROM produtos
ORDER BY descricao
";

$res = pg_query($con, $sql);

if (!$res) {
    die('Erro na consulta: ' . pg_last_error($con));
}

?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>

<meta charset="utf-8">

<title>Relatório de Estoque</title>

<style>

body{
    font-family: Arial, Helvetica, sans-serif;
    background-color:#aea7a7;
    margin:20px;
}

h2{
    color:#003366;
    text-align:center;
}

table{
    width:100%;
    border-collapse:collapse;
    background:#fff;
}

th{
    background:#003366;
    color:#fff;
    padding:10px;
    text-align: left;
}

td{
    padding:8px;
}

tr:nth-child(even){
    background:#f2f2f2;
}

.baixo{
    color:red;
    font-weight:bold;
}

.btn{
    display:inline-block;
    margin-top:20px;
    padding:10px 20px;
    background:#0066cc;
    color:white;
    text-decoration:none;
    border-radius:20px;
}

</style>

</head>

<body>

<h2>Relatório de Estoque</h2>
<a class="btn" href="../index.php">Início</a><br><br>

<table border="1">

<tr>
    <th>Código</th>
    <th>Produto</th>
    <th>Estoque Atual</th>
    <th>Estoque Mínimo</th>
    <th>Preço Custo</th>
    <th>Preço Venda</th>
</tr>

<?php

while ($row = pg_fetch_assoc($res)) {

    $classe = '';

    if ($row['estoque_atual'] <= $row['estoque_minimo']) {
        $classe = 'baixo';
    }

?>

<tr>

    <td><?= htmlspecialchars($row['codigo']) ?></td>

    <td><?= htmlspecialchars($row['descricao']) ?></td>

    <td class="<?= $classe ?>">
        <?= number_format($row['estoque_atual'], 0, ',', '.') ?>
    </td>

    <td>
        <?= number_format($row['estoque_minimo'], 0, ',', '.') ?>
    </td>

    <td>
        R$ <?= number_format($row['preco_custo'], 2, ',', '.') ?>
    </td>

    <td>
        R$ <?= number_format($row['preco_venda'], 2, ',', '.') ?>
    </td>

</tr>

<?php } ?>

</table>
