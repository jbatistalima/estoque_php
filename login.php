<?php

session_start();

include 'conexao.php';

$erro = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

$login = trim($_POST['login']);
$senha = $_POST['senha'];

$sql = "
SELECT
id,
nome,
login,
senha,
perfil
FROM usuarios
WHERE login = '$login'
LIMIT 1
";

$res = pg_query($con, $sql);

if ($res) {

$usuario = pg_fetch_assoc($res);

if (
$usuario &&
password_verify(
$senha,
$usuario['senha']
)
) {

session_regenerate_id(true);

$_SESSION['usuario_id'] = $usuario['id'];
$_SESSION['usuario_nome'] = $usuario['nome'];
$_SESSION['perfil'] = $usuario['perfil'];

header('Location: index.php');
exit;
}
}

$erro = 'Usuário ou senha inválidos.';
}

?>

<!DOCTYPE html>

<html lang="pt-BR">

<head>

<meta charset="utf-8">

<title>Login</title>

<style>

body{
font-family: Arial, Helvetica, sans-serif;
background:#e0e0e0;
}

.login{
width:350px;
margin:80px auto;
padding:20px;
background: #999;
border-radius:10px;
box-shadow:0 0 10px #999;
}

h2{
text-align:center;
color:#fff;
}

input {
background-color: transparent;  
width:100%;
padding:10px;
margin:5px 0 15px 0;
box-sizing:border-box;
font-size: 20px;
}

input::placeholder {
    color: #ffffff; 
    /*opacity: 1;     /* Garante que o Firefox não aplique transparência padrão */
}

button{
width:100%;
padding:10px;
background:#0066cc;
color:#fff;
border:none;
border-radius: 5px;
cursor:pointer;
}

button:hover{
background:#004c99;
}

.erro{
color:red;
text-align:center;
}

</style>

</head>

<body>

<div class="login">

<h2>Entrar</h2>

<form method="post">

<input type="text" name="login" placeholder="Digite o usuário" required>

<input type="password" name="senha" placeholder="Informe a senha" required>

<button type="submit">Entrar</button>

</form>

<?php if($erro != ''){ ?><p class="erro"><?= $erro ?></p><?php } ?>

</div>

</body>

</html>