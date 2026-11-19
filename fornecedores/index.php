<?php

include("../conexao.php");

$sql = "SELECT * FROM fornecedores ORDER BY razao_social";

$res = pg_query($con, $sql);

if (!$res) {
die("Erro ao consultar fornecedores: " . pg_last_error($con));
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

.alterar a, .excluir a{
    text-decoration: none;
    font-size: 18px;
}

.alterar, .excluir {
    text-align: center;
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

<h2>Cadastro de Fornecedores</h2>

<p><a class="btn" href="cadastrar.php">Novo Fornecedor</a> 
<a class="btn" href="../index.php">Voltar ao Menu</a></p><br>

<table border="1" width="100%" cellpadding="2" cellspacing="1">
<tr >
<th>ID</th>
<th>Razão Social</th>
<th>Fantasia</th>
<th>CNPJ</th>
<th>Telefone</th>
<th>Email</th>
<th>Endereço</th>
<th>Bairro</th>
<th>Cidade</th>
<th>Estado</th>
<th>Data</th>
<th>Alterar</th>
<th>Excluir</th>
</tr>

<?php
while ($linha = pg_fetch_assoc($res)) {
?>
<tr>
<td><?php echo $linha['id']; ?></td>

<td><?php echo $linha['razao_social']; ?></td>
<td><?php echo $linha['fantasia']; ?></td>
<td><?php echo $linha['cnpj']; ?></td>
<td><?php echo $linha['telefone']; ?></td>
<td><?php echo $linha['email']; ?></td>
<td><?php echo $linha['endereco']; ?></td>
<td><?php echo $linha['bairro']; ?></td>
<td><?php echo $linha['cidade']; ?></td>
<td><?php echo $linha['estado']; ?></td>
<td><?php echo date('d/m/Y', strtotime($linha['data_cadastro'])); ?></td>

<td class="alterar"><a href="alterar.php?id=<?php echo $linha['id']; ?>">✏️</a></td>

<td class="excluir"><a href="excluir.php?id=<?php echo $linha['id']; ?>" onclick="return confirm('Deseja realmente excluir este fornecedor?');">🗑️</a></td>
</tr>
<?php
}
?>
</table>
