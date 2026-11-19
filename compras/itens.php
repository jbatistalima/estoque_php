<?php

include '../conexao.php';

if (!isset($_POST['fornecedor_id'])) {
header('Location: nova.php');
exit;
}

$fornecedor_id = $_POST['fornecedor_id'];

$produtos = "SELECT * FROM produtos ORDER BY descricao";


$res = pg_query($con, $produtos);

?>

<style>
body{
font-family: Arial, Helvetica, sans-serif;
width: 50%;
margin-left: 25%;
background-color: #aea7a7;
}

.input[type="text"], input[type="email"], input[type="number"], input[type="date"], select {
    background-color: transparent;
    border: none;
    border-bottom: #000 solid 1px;
    font-size: 1.2em;
    color: #3e3a3a;
    width: 80%;
}

h2 {
color: #003366;
text-shadow: 2px 2px 5px #000;
}   

.btn {
background-color: #C0262C;
text-decoration: none;
background: linear-gradient(to bottom,  #6b1516 0%,#c0262c 30%,#c0262c 70%,#6b1516 100%);
border: none;
border-radius: 30px;
font-size: 1em;
color: #fff;
padding: 10px 20px;
margin: 10px 0;
text-shadow: 2px 2px 5px #000;
cursor: pointer;
}
</style>

<h2>Itens da Compra</h2>

<form action="salvar.php" method="post">

<input type="hidden" name="fornecedor_id" value="<?= $fornecedor_id ?>">

<table>

<tr>
<th>Produto</th>
<th>Qtd</th>
<th>Valor</th>
</tr>

<?php for($i=0;$i<1;$i++){ ?>

<tr>

<td>

<select name="produto_id[]">

<option value="">Selecione</option>

<?php
pg_result_seek($res, 0);

while($produto = pg_fetch_assoc($res)){
echo "<option value='{$produto['id']}'>";
echo $produto['descricao'];
echo "</option>";
}
?>
</select>

</td>

<td><input type="number" step="0.01" name="quantidade[]"></td>

<td><input type="number" step="0.01" name="valor_unitario[]"></td>

</tr>

<?php } ?>

</table>

<button class="btn" type="submit">Salvar Compra</button>
<a class="btn" href="index.php">Voltar</a>


</form>