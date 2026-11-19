<?php

include '../conexao.php';

$sql = "
SELECT
m.id,
p.descricao,
m.tipo,
m.quantidade,
m.observacao,
m.data_movimento
FROM movimentacoes m
INNER JOIN produtos p
ON p.id = m.produto_id
ORDER BY m.data_movimento DESC
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

<h2>Movimentações</h2>

<p class="link"><a class="btn" href="../index.php">Voltar ao Menu</a></p><br>

<table border="1">

<tr>
<th>ID</th>
<th>Produto</th>
<th>Tipo</th>
<th>Quantidade</th>
<th>Data</th>
<th class="centro">Consultar</th>
</tr>

<?php while($row = pg_fetch_assoc($res)){ ?>

<tr>

<td><?= $row['id'] ?></td>

<td><?= $row['descricao'] ?></td>

<td><?= $row['tipo'] ?></td>

<td><?= number_format($row['quantidade'], 0, ',', '.') ?></td>

<td><?= date('d/m/Y H:i', strtotime($row['data_movimento'])) ?></td>

<td class="centro">
<a href="consultar.php?id=<?= $row['id'] ?>">🔍</a>

</tr>

<?php } ?>

</table>


<hr>
