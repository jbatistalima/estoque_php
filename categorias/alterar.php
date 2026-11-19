<?php

include("../conexao.php");

$id = $_GET['id'];

$sql = "SELECT * FROM categorias WHERE id = $1";

$res = pg_query_params($con, $sql, array($id));

if (!$res || pg_num_rows($res) == 0) {
die("Categoria não encontrada.");
}

$linha = pg_fetch_assoc($res);

?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
<meta charset="utf-8">
<title>Alterar Categoria</title>
</head>
<body>
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


input[type="text"]{
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
<h2>Alterar Categoria</h2>

<form action="atualizar.php" method="post">

<input type="hidden" name="id" value="<?php echo $linha['id']; ?>">

<input type="text" name="descricao" value="<?php echo $linha['descricao']; ?>" required>

<br><br>

<p>
    <input class="btn" type="submit" value="Atualizar">
    <a class="btn" href="index.php">Voltar</a>
</p>

</form>

</body>
</html>