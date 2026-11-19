<?php include '../auth.php'; ?>

<?php

include '../conexao.php';

$sql = "
SELECT
c.id,
c.data_compra,
f.razao_social,
c.valor_total
FROM compras c
INNER JOIN fornecedores f
ON f.id = c.fornecedor_id
ORDER BY c.id DESC
";

$res = pg_query($con, $sql);
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

a {
    text-decoration: none;
    font-size: 18px;
}

.centro {
  display: flex;
  justify-content: center;
  align-items: center;
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

<h2>Compras</h2>

<p>
    <a class="btn" href="nova.php">Comprar</a>
    <a class="btn" href="../index.php">Menu</a>
</p>


<table border="1" cellpadding="5" cellspacing="0">
<tr>
<th>Código</th>
<th>Fornecedor</th>
<th>Data</th>
<th>Total</th>
<th class="centro">Consultar</th>
</tr>

<?php while($row = pg_fetch_assoc($res)){ ?>

<tr>
<td><?= $row['id'] ?></td>
<td><?= $row['razao_social'] ?></td>
<td><?= date('d/m/Y', strtotime($row['data_compra'])) ?></td>
<td>R$<?= number_format($row['valor_total'], 2, ',', '.') ?></td>
<td class="centro">
<a href="consultar.php?id=<?= $row['id'] ?>">🔍</a>
</td>
</tr>

<?php } ?>

</table>
