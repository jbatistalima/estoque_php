<?php

include("../conexao.php");

$id = $_GET['id'];

$sql = "SELECT * FROM clientes WHERE id = $1";

$res = pg_query_params($con, $sql, array($id));

if (!$res || pg_num_rows($res) == 0) {
die("Cliente não encontrado.");
}

$linha = pg_fetch_assoc($res);

?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
<meta charset="utf-8">
<title>Alterar Cliente</title>

<style>
body {
font-family: Arial, Helvetica, sans-serif;
width: 40%;
margin-left: 30%;
background-color: #aea7a7;
}    

h2 {
color: #003366;
text-shadow: 2px 2px 5px #000;
}

input[type="text"], input[type="email"], input[type="date"], select {
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

</head>
<body>

<h2>Alterar Cliente</h2>

<form action="atualizar.php" method="post">

<input
type="hidden"
name="id"
value="<?php echo $linha['id']; ?>">

<input type="text"name="nome" value="<?php echo $linha['nome']; ?>" required><br><br>
<input type="text"name="cpf_cnpj" value="<?php echo $linha['cpf_cnpj']; ?>" required><br><br>
<input type="text"name="telefone" value="<?php echo $linha['telefone']; ?>" required><br><br>
<input type="email"name="email" value="<?php echo $linha['email']; ?>" required><br><br>
<input type="text"name="endereco" value="<?php echo $linha['endereco']; ?>" required><br><br>
<input type="text"name="bairro" value="<?php echo $linha['bairro']; ?>" required><br><br>
<input type="text"name="cidade" value="<?php echo $linha['cidade']; ?>" required><br><br>
<select name="estado" id="estado" required>
<option value="">Selecione o Estado</option>
<option value="">Selecione</option>
<option value="AC">AC</option>
<option value="AL">AL</option>
<option value="AP">AP</option>
<option value="AM">AM</option>
<option value="BA">BA</option>
<option value="CE">CE</option>
<option value="DF">DF</option>
<option value="ES">ES</option>
<option value="GO">GO</option>
<option value="MA">MA</option>
<option value="MT">MT</option>
<option value="MS">MS</option>
<option value="MG">MG</option>
<option value="PA">PA</option>
<option value="PB">PB</option>
<option value="PR">PR</option>
<option value="PE">PE</option>
<option value="PI">PI</option>
<option value="RJ">RJ</option>
<option value="RN">RN</option>
<option value="RS">RS</option>
<option value="RO">RO</option>
<option value="RR">RR</option>
<option value="SC">SC</option>
<option value="SP">SP</option>
<option value="SE">SE</option>
<option value="TO">TO</option>
</select><br><br>
</select><input type="date"name="data_cadastro" value="<?php echo $linha['data_cadastro']; ?>" required>

<br><br>

<p><input class="btn" type="submit" value="Atualizar">  <a class="btn" href="index.php">Voltar</a></p>

</form>

</body>
</html>