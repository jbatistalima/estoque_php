<?php

include '../conexao.php';

$id = (int) $_GET['id'];

$sql = "
SELECT
m.*,
p.descricao
FROM movimentacoes m
INNER JOIN produtos p
ON p.id = m.produto_id
WHERE m.id = $id
";

$res = pg_query($con, $sql);

$mov = pg_fetch_assoc($res);

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


<h2>Movimentação <?= $mov['id'] ?></h2>
<table border="1">
    <tr>
        <th>Poduto</th>
        <th>Tipo</th>
        <th>Quantidade</th>
        <th>Observação</th>
        <th>Data</th>

    </tr>
        <tr>
        <td><?= $mov['descricao'] ?></td>

        <td><?= $mov['tipo'] ?></td>

        <td><?= number_format($mov['quantidade'], 0, ',', '.') ?></td>

        <td><?= $mov['observacao'] ?></td>

        <td><?= date('d/m/Y H:i', strtotime($mov['data_movimento'])) ?></td>
    </tr>
</table>
<p class="link"><a class="btn" href="index.php">Voltar</a></p>
