<?php include '../auth.php'; ?>

<?php

include '../conexao.php';

$sql = "
SELECT
id,
nome,
login,
perfil,
data_cadastro
FROM usuarios
ORDER BY nome
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

.alterar a, .excluir a{
    text-decoration: none;
    font-size: 18px;
    margin-left: 10px;
}

.alterar a:hover, .excluir a:hover {
    transform: scale(1.5); 
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


<h2>Usuários</h2>
<p>
<a class="btn" href="cadastrar.php">Novo Usuário</a>
<a class="btn" href="../index.php">Voltar ao Menu</a>
</p>

<table border="1">

<tr>
<th>ID</th>
<th>Nome</th>
<th>Login</th>
<th>Perfil</th>
<th>Cadastro</th>
</tr>

<?php while($row = pg_fetch_assoc($res)){ ?>

<tr>

<td><?= $row['id'] ?></td>

<td><?= $row['nome'] ?></td>

<td><?= $row['login'] ?></td>

<td><?= $row['perfil'] ?></td>

<td>
<?= date('d/m/Y', strtotime($row['data_cadastro'])) ?>
</td>

</tr>

<?php } ?>

</table>