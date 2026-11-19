<?php

include '../conexao.php';

$nome = trim($_POST['nome']);
$login = trim($_POST['login']);
$senha = password_hash(
$_POST['senha'],
PASSWORD_DEFAULT
);
$perfil = $_POST['perfil'];

$sql = "
INSERT INTO usuarios
(
nome,
login,
senha,
perfil
)
VALUES
(
'$nome',
'$login',
'$senha',
'$perfil'
)
";

pg_query($con, $sql);

header('Location: index.php');
exit;