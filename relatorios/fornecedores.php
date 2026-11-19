<?php

include '../conexao.php';

$sql = "
SELECT *
FROM fornecedores
ORDER BY razao_social
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
    text-align: left;
    padding:10px;
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
<h2>Relatório de Fornecedores</h2><br><br>

<a class="btn" href="../index.php">Início</a><br><br><br>

<table border="1">

<tr>
<th>Fornecedor</th>
<th>Telefone</th>
<th>Email</th>
<th>Cidade</th>
</tr>

<?php while($row = pg_fetch_assoc($res)){ ?>

<tr>

<td><?= $row['razao_social'] ?></td>

<td><?= $row['telefone'] ?></td>

<td><?= $row['email'] ?></td>

<td><?= $row['cidade'] ?></td>

</tr>

<?php } ?>

</table>
