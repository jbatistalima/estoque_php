<?php

include '../conexao.php';

$sql = "
SELECT
v.id,
v.data_venda,
c.nome,
v.valor_total
FROM vendas v
LEFT JOIN clientes c
ON c.id = v.cliente_id
ORDER BY v.id DESC
";

$res = pg_query($con,$sql);

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

<h2>Relatório de Vendas</h2>

<a class="btn" href="../index.php">Início</a><br><br>

<table border="1">

<tr>
<th>Venda</th>
<th>Cliente</th>
<th>Data</th>
<th>Total</th>
</tr>

<?php while($row = pg_fetch_assoc($res)){ ?>

<tr>

<td><?= $row['id'] ?></td>

<td><?= $row['nome'] ?></td>

<td>
<?= date('d/m/Y', strtotime($row['data_venda'])) ?>
</td>

<td>
R$ <?= number_format($row['valor_total'],2,',','.') ?>
</td>

</tr>

<?php } ?>

</table>