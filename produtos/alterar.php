<?php

include("../conexao.php");

$id = $_GET['id'];

$sql = "SELECT * FROM produtos
WHERE id = $1";

$res = pg_query_params(
$con,
$sql,
array($id)
);

if (!$res || pg_num_rows($res) == 0) {
die("Produto não encontrado.");
}

$linha = pg_fetch_assoc($res);

$sqlCat = "SELECT id, descricao
FROM categorias
ORDER BY descricao";

$resCat = pg_query($con, $sqlCat);

$sqlFor = "SELECT id, razao_social
FROM fornecedores
ORDER BY razao_social";

$resFor = pg_query($con, $sqlFor);

?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
<meta charset="utf-8">
<title>Alterar Produto</title>
<style>
body{
font-family: Arial, Helvetica, sans-serif;
width: 50%;
margin-left: 25%;
background-color: #aea7a7;
}

h2 {
color: #003366;
text-shadow: 2px 2px 5px #000;
}

input[type="text"], input[type="email"], input[type="number"], input[type="date"], select {
background-color: transparent;
border: none;
border-bottom: #000 solid 1px;
font-size: 1.2em;
color: #3e3a3a;
width: 80%;
}


.btn {
background-color: #C0262C;
text-decoration: none;
background: linear-gradient(to bottom,  #6b1516 0%,#c0262c 30%,#c0262c 70%,#6b1516 100%);
border: none;
border-radius: 30px;
font-size: 1em;
color: #fff;
padding: 10px 30px;
margin: 10px 0;
text-shadow: 2px 2px 5px #000;
cursor: pointer;
}
</style>
</head>
<body>

<h2>Alterar Produto</h2>

<form action="atualizar.php" method="post">

<input type="hidden"
name="id"
value="<?php echo $linha['id']; ?>"><br>
    
<label>Código:</label><br>
<input type="text"
name="codigo"
value="<?php echo $linha['codigo']; ?>"
required>

<br><br>

<label>Descrição:</label><br>

<input type="text"
name="descricao"
value="<?php echo $linha['descricao']; ?>"
required>

<br><br>

<label>Categoria:</label><br>

<select name="categoria_id" required>

<option value="">Selecione...</option>

<?php
while ($cat = pg_fetch_assoc($resCat)) {
?>
<option
value="<?php echo $cat['id']; ?>"
<?php
if ($cat['id'] == $linha['categoria_id']) {
echo "selected";
}
?>
>
<?php echo $cat['descricao']; ?>
</option>
<?php
}
?>

</select>

<br><br>

<label>Fornecedor:</label><br>

<select name="fornecedor_id" required>

<option value="">Selecione...</option>

<?php
while ($for = pg_fetch_assoc($resFor)) {
?>
<option
value="<?php echo $for['id']; ?>"
<?php
if ($for['id'] == $linha['fornecedor_id']) {
echo "selected";
}
?>
>
<?php echo $for['razao_social']; ?>
</option>
<?php
}
?>

</select>

<br><br>

<label>Unidade:</label><br>

<input type="text"
name="unidade"
value="<?php echo $linha['unidade']; ?>"
required>

<br><br>

<label>Estoque Atual:</label><br>

<input type="number"
name="estoque_atual"
value="<?php echo $linha['estoque_atual']; ?>"
required>

<br><br>

<label>Estoque Mínimo:</label><br>

<input type="number"
name="estoque_minimo"
value="<?php echo $linha['estoque_minimo']; ?>"
required>

<br><br>

<label>Preço de Custo:</label><br>
<input type="number" name="preco_custo" value="<?php echo $linha['preco_custo']; ?>" required>
<br><br>

<label>Preço de Venda:</label><br>
<input type="number"  name="preco_venda" value="<?php echo $linha['preco_venda']; ?>" required>
<br><br>

<label><input type="checkbox" name="ativo" value="true" <?php echo $linha['ativo'] ? 'checked' : ''; ?>>Ativo</label>

<br>

<p>
<input class="btn" type="submit" value="Alterar">
<a class="btn" href="index.php">Voltar</a>
</p>