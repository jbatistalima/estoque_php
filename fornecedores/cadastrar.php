<!DOCTYPE html>
<html lang="pt-BR">
<head>
<meta charset="utf-8">
<title>Novo Fornecedor</title>
<style>
body{
font-family: Arial, Helvetica, sans-serif;
width: 50%;
margin-left: 25%;
background-color: #aea7a7;
}

input[type="text"], input[type="email"], input[type="date"], select {
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
margin: 20px 0;
text-shadow: 2px 2px 5px #000;
cursor: pointer;
}
</style>

</head>
<body>

<h2>Novo Fornecedor</h2>

<form action="salvar.php" method="post">

<input type="text" name="razao_social" id="razao_social" placeholder="Razão Social" required>
<br><br>

<input type="text" name="fantasia" id="fantasia" placeholder="Fantasia" required>
<br><br>

<input type="text" name="cnpj" id="cnpj" placeholder="CNPJ" required>
<br><br>

<input type="text" name="telefone" id="telefone" placeholder="Telefone" required>
<br><br>

<input type="email" name="email" id="email" placeholder="Email" required>
<br><br>

<input type="text" name="endereco" id="endereco" placeholder="Endereço" required>
<br><br>

<input type="text" name="bairro" id="bairro" placeholder="Bairro" required>
<br><br>

<input type="text" name="cidade" id="cidade" placeholder="Cidade" required>
<br><br>

<select name="estado" id="estado" required>
<option value="">Selecione o estado</option>
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
</select>
<br><br>

<label>Cadastro Data:</label><br>
<input type="date" name="data_cadastro" id="data_cadastro" required>
<br>

<p>
<a class="btn" href="index.php">Voltar</a>
<input class="btn" type="submit" value="Salvar">
<input class="btn" type="reset" value="Limpar">
</p>

</form>

</body>
</html>

