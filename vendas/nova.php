<?php include '../auth.php'; ?>

<?php

include '../conexao.php';

$sql = "
SELECT *
FROM clientes
ORDER BY nome
";

$res = pg_query($con, $sql);

?>

<style>
body{
font-family: Arial, Helvetica, sans-serif; 
background-color: #aea7a7;
}


table{
border-collapse: collapse;
margin: 25px;
width: 95%;
}    

.conteudo {
font-family: Arial, Helvetica, sans-serif;
width: 50%;
height: 90%;
margin-left: 25%;
margin-top: 5%;
background-color: #aea7a7;
}

h2 {
color: #003366;
text-shadow: 2px 2px 5px #000;
text-align: center;
margin-top: 5%;
}

label {
color: #003366;
text-shadow: 2px 2px 5px #000;
font-size: 1.5em;
}

select {
background-color: transparent;
border: none;
border-bottom: #000 solid 1px;
font-size: 1.2em;
color: #3e3a3a;
width: 50%;
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
margin-left: 2%;
text-shadow: 2px 2px 5px #000;
cursor: pointer;
}

</style>

<h2>Nova Venda</h2>

<div class="conteudo">

<form action="itens.php" method="post">

<label>Cliente</label>

<select name="cliente_id">

<?php while($c = pg_fetch_assoc($res)){ ?>

<option value="<?= $c['id'] ?>">
<?= $c['nome'] ?>
</option>

<?php } ?>

</select>

<p>
<button class="btn" type="submit">Continuar</button>
<a class="btn" href="index.php">Voltar</a>
</p>

</form>

<br>

<hr>

</div>
