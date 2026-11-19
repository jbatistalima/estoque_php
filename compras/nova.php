<?php include '../auth.php'; ?>

<?php

include '../conexao.php';

$sql = "SELECT * FROM fornecedores ORDER BY razao_social";

$res = pg_query($con, $sql);

?>
<style>
body{
font-family: Arial, Helvetica, sans-serif;
width: 50%;
margin: auto;
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
padding: 10px 30px;
margin: 10px 0;
text-shadow: 2px 2px 5px #000;
cursor: pointer;
}
</style>
<h2>Nova Compra</h2>

<form action="itens.php" method="post">

<label>Fornecedor</label>

<select name="fornecedor_id">

<?php while($f = pg_fetch_assoc($res)){ ?>

<option value="<?= $f['id'] ?>">
<?= $f['razao_social'] ?>
</option>

<?php } ?>

</select>

<button class="btn" type="submit">Continuar</button>
<a class="btn" href="index.php">Cancelar</a>


</form>