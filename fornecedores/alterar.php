<?php

include("../conexao.php");

$id = $_GET['id'];

$sql = "SELECT * FROM fornecedores WHERE id = $1";

$res = pg_query_params($con, $sql, array($id));

if (!$res || pg_num_rows($res) == 0) {
die("Fornecedor não encontrado.");
}

$linha = pg_fetch_assoc($res);

?>

<!DOCTYPE html>
<html lang="pt-BR">
    <head>
        <meta charset="utf-8">
        <title>Alterar Fornecedor</title>
        <style>
            body{
            font-family: Arial, Helvetica, sans-serif;
            width: 50%;
            margin-left: 25%;
            background-color: #aea7a7;
            }

            .input{
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
    </head>
    <body>

        <h2>Alterar Fornecedor</h2>

        <form action="atualizar.php" method="post">

            <input
            type="hidden"
            name="id"
            value="<?php echo $linha['id']; ?>">

            <br>

            <input type="text" class="input" name="razao_social" value="<?php echo $linha['razao_social']; ?>" required><br><br>
            <input type="text" class="input" name="fantasia" value="<?php echo $linha['fantasia']; ?>" required><br><br>
            <input type="text" class="input" name="cnpj" value="<?php echo $linha['cnpj']; ?>" required><br><br>
            <input type="text" class="input" name="telefone" value="<?php echo $linha['telefone']; ?>" required><br><br>
            <input type="email" class="input" name="email" value="<?php echo $linha['email']; ?>" required><br><br>
            <input type="text" class="input" name="endereco" value="<?php echo $linha['endereco']; ?>" required><br><br>
            <input type="text" class="input" name="bairro" value="<?php echo $linha['bairro']; ?>" required><br><br>
            <input type="text" class="input" name="cidade" value="<?php echo $linha['cidade']; ?>" required><br><br>
            <select name="estado" class="input" required>
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
            <input type="date" class="input" name="data_cadastro" value="<?php echo $linha['data_cadastro']; ?>" required>

            <br><br>

            <p>
            <input class="btn" type="submit" value="Atualizar">
            <a class="btn" href="index.php">Voltar</a>
            </p>   

        </form>

    </body>
</html>