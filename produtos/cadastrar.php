<?php include '../auth.php'; ?>

<?php

include("../conexao.php");

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
<title>Novo Produto</title>
</head>
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

input[type="text"], input[type="email"], input[type="date"], input[type="number"], select {
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
margin: 20px 0;
text-shadow: 2px 2px 5px #000;
cursor: pointer;
}
</style>

<body>

<h2>Novo Produto</h2>

<form action="salvar.php" method="post">

<input type="text" name="codigo" placeholder="Código" required>
<br><br>

<input type="text" name="descricao" placeholder="Descrição" required>
<br><br>

<select name="categoria_id" required>
<option value="">Selecione a categoria</option>

<?php
while ($cat = pg_fetch_assoc($resCat)) {
?>
<option value="<?php echo $cat['id']; ?>">
<?php echo $cat['descricao']; ?>
</option>
<?php
}
?>

</select>
<br><br>

<select name="fornecedor_id" required>
<option value="">Selecione o fornecedor</option>

<?php
while ($for = pg_fetch_assoc($resFor)) {
?>
<option value="<?php echo $for['id']; ?>">
<?php echo $for['razao_social']; ?>
</option>
<?php
}
?>
</select>
<br><br>

<input type="text" name="unidade" placeholder="Localização" required>
<br><br>

<input type="number" step="0.01" name="estoque_atual" placeholder="Estoque Atual" >
<br><br>

<input type="number" step="0.01" name="estoque_minimo" placeholder="Estoque Mínimo">
<br><br>

<input type="number" step="0.01" name="preco_custo" placeholder="Preço de Custo">
<br><br>

<input type="number" step="0.01" name="preco_venda" placeholder="Preço de Venda">
<br><br>

<label><input type="checkbox" name="ativo" value="true" checked>Ativo</label>

<br>

<p>
    <input class="btn" type="submit" value="Salvar">
    <input class="btn" type="reset" value="Limpar">
    <a class="btn" href="index.php">Voltar</a>
</p>

</form>

<hr>

</body>
</html>