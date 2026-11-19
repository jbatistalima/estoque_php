<?php

include '../conexao.php';

if(!isset($_POST['cliente_id'])){
header('Location: nova.php');
exit;
}

$cliente_id = $_POST['cliente_id'];

$sql = "
SELECT *
FROM produtos
WHERE ativo = true
ORDER BY descricao
";

$res = pg_query($con, $sql);

?>

<style>
body{
font-family: Arial, Helvetica, sans-serif; 
background-color: #aea7a7;
}

form {
font-family: Arial, Helvetica, sans-serif;
width: 50%;
height: 90%;
margin-left: 25%;
background-color: #aea7a7;
}

h2 {
color: #003366;
text-shadow: 2px 2px 5px #000;
text-align: center;
margin-top: 5%;
}

input[type="number"], select {
background-color: transparent;
border: none;
border-bottom: #000 solid 1px;
font-size: 1.2em;
color: #3e3a3a;
width: 90%;
margin-top: 3%;
}

.btn {
background-color: #C0262C;
text-decoration: none;
background: linear-gradient(to bottom,  #921c1c 20%, #c0262c 30%, #c0262c 70%, #6b1516 90%);
border: none;
border-radius: 30px;
font-size: 1em;
color: #fff;
padding: 10px 30px;
margin-left: 2%;
text-shadow: 2px 2px 5px #000;
cursor: pointer;
}

</style>

<h2>Itens da Venda</h2>
<div id="conteudo">

<form action="salvar.php" method="post">

<input type="hidden" name="cliente_id" value="<?= $cliente_id ?>">

<table>

<?php for($i=0;$i<1;$i++){ ?>

<select name="produto_id[]"><option value="">Selecione o produto</option>

<?php
pg_result_seek($res,0);

while($produto = pg_fetch_assoc($res)){
?>

<option value="<?= $produto['id'] ?>">
<?= $produto['descricao'] ?>
</option>

<?php } ?>

</select>

<input type="number" min="0" placeholder="Quantidade" name="quantidade[]">

<input type="number" min="0" placeholder="Valor unitário" name="valor_unitario[]"><br><br>

<?php } ?>

<p>
<button class="btn" type="submit">Salvar</button>
<a class="btn" href="index.php">Voltar</a>
</p>

</form>
</div>