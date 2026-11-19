<?php

// Inicia a sessão apenas se ainda não existir
if (session_status() !== PHP_SESSION_ACTIVE) {
session_start();
}

// Verifica se o usuário está logado
if (!isset($_SESSION['usuario_id'])) {

header('Location: /estoque_php/login.php');
exit;
}

// Dados úteis da sessão
$usuario_id = $_SESSION['usuario_id'];
$usuario_nome = $_SESSION['usuario_nome'] ?? '';
$perfil = $_SESSION['perfil'] ?? 'OPERADOR';

?>