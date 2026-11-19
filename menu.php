<?php
// Sempre a primeira linha se precisar validar sessão por aqui
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Se o auth.php já faz a proteção de login, a validação abaixo pode até ser redundante,
// mas vamos mantê-la corrigida caso use de forma isolada:
if (!isset($_SESSION['usuario_id'])) {
    header('Location: /estoque_php/login.php');
    exit;
}
?>

<style>
.menu-container {
    font-family: Arial, Helvetica, sans-serif;
    margin-top: 20px;
    margin-bottom: 20px;
}

.menu-title {
    color: #003366;
    text-shadow: 2px 2px 5px rgba(0,0,0,0.3);
}

.menu {
    margin-top: 20px;
}

.menu a {
    display: inline-block;
    padding: 10px 15px;
    margin: 5px;
    text-decoration: none;
    text-align: center;
    background-color: #0066cc;
    color: white;
    border-radius: 30px;
    width: 135px;
}

.menu a:hover {
    background-color: #004c99;
}
</style>

<div class="menu-container">
    <h1 class="menu-title">Sistema de Controle de Estoque Menu</h1>
    <hr>
    <div class="menu">
        <a href="/estoque_php/index.php">Início</a>
        <a href="/estoque_php/usuarios/index.php">Usuários</a>
        <a href="/estoque_php/clientes/index.php">Clientes</a>
        <a href="/estoque_php/fornecedores/index.php">Fornecedores</a>
        <a href="/estoque_php/categorias/index.php">Categorias</a>
        <a href="/estoque_php/produtos/index.php">Produtos</a>
        <a href="/estoque_php/compras/index.php">Compras</a>
        <a href="/estoque_php/vendas/index.php">Vendas</a>
        <a href="/estoque_php/movimentacoes/index.php">Movimentações</a>
        <a href="/estoque_php/relatorios/clientes.php">Rel. Clientes</a>
        <a href="/estoque_php/relatorios/fornecedores.php">Rel. Fornecedores</a>
        <a href="/estoque_php/relatorios/estoque.php">Rel. Estoque</a>
        <a href="/estoque_php/relatorios/compras.php">Rel. Compras</a>
        <a href="/estoque_php/relatorios/vendas.php">Rel. Vendas</a>
        <a href="/estoque_php/logout.php">Sair</a>
    </div>

    </br>

    <hr>
</div>
