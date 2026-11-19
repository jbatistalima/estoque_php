<?php
// Inicia a sessão no topo do arquivo principal
session_start();

include 'auth.php';
include 'conexao.php';

// Consultas do Banco de Dados (PostgreSQL)

// Total de itens em estoque
$sql = "SELECT SUM(estoque_atual) AS total_itens FROM produtos";
$res = pg_query($con, $sql);
$total_itens = pg_fetch_assoc($res)['total_itens'] ?? 0;

// Produtos com estoque crítico (atual menor ou igual ao mínimo)
$sql = "
SELECT COUNT(*) AS total_critico
FROM produtos
WHERE estoque_atual <= estoque_minimo AND ativo = true
";

$res = pg_query($con, $sql);
$total_critico = pg_fetch_assoc($res)['total_critico'] ?? 0;


// Valor de custo do estoque
$sql = "SELECT SUM(estoque_atual * preco_custo) AS valor_custo FROM produtos";
$res = pg_query($con, $sql);
$valor_custo = pg_fetch_assoc($res)['valor_custo'] ?? 0;

// Valor de venda do estoque
$sql = "SELECT SUM(estoque_atual * preco_venda) AS valor_venda FROM produtos";
$res = pg_query($con, $sql);
$valor_venda = pg_fetch_assoc($res)['valor_venda'] ?? 0;

// Lucro potencial
$lucro = $valor_venda - $valor_custo;

// Total de produtos
$sql = "SELECT COUNT(*) AS total_produtos FROM produtos";
$res = pg_query($con, $sql);
$total_produtos = pg_fetch_assoc($res)['total_produtos'] ?? 0;

// Total de clientes
$sql = "SELECT COUNT(*) AS total_clientes FROM clientes";
$res = pg_query($con, $sql);
$total_clientes = pg_fetch_assoc($res)['total_clientes'] ?? 0;

// Total de fornecedores
$sql = "SELECT COUNT(*) AS total_fornecedores FROM fornecedores";
$res = pg_query($con, $sql);
$total_fornecedores = pg_fetch_assoc($res)['total_fornecedores'] ?? 0;
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="utf-8">
    <title>Sistema de Controle de Estoque</title>
    <style>
        body {
            font-family: Arial, Helvetica, sans-serif;
            background-color: #aea7a7;
            margin: 20px;
            width: 80%;
            margin-left: 10%;
        }

        .cards {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
            margin-top: 20px;
        }

        .card {
            background: #999;
            width: 220px;
            padding: 20px;
            border: solid thin #fff;
            border-radius: 15px;
            box-shadow: 0 0 10px rgba(0,0,0,.2);
            text-align: center;
        }

        .card h3 {
            margin-top: 0;
            color: #003366;
            font-size: 20px;
        }

        .card p {
            font-size: 24px;
            font-weight: bold;
            color: #C0262C;
            margin-bottom: 0;
        }
        
        .welcome-msg {
            color: #003366;
        }
    </style>
</head>
<body>

    <?php 
    // O menu injetará o H1 estruturado e os links aqui
    require_once 'menu.php'; 
    ?>

    <h2 class="welcome-msg">Painel</h2>
    
    <div class="cards">
        <div class="card">
            <h3>Total de Produtos</h3>
            <p><?= number_format($total_produtos, 0, ',', '.') ?></p>
        </div>

        <div class="card">
            <h3>Total de Clientes</h3>
            <p><?= number_format($total_clientes, 0, ',', '.') ?></p>
        </div>

        <div class="card">
            <h3>Total de Fornecedores</h3>
            <p><?= number_format($total_fornecedores, 0, ',', '.') ?></p>
        </div>

        <div class="card">
            <h3>Itens em Estoque</h3>
            <p><?= number_format($total_itens, 0, ',', '.') ?></p>
        </div>

        <div class="card">
            <h3>Itens Abaixo do Nível</h3>
            <p><?= number_format($total_critico, 0, ',', '.') ?></p>
        </div>

        <div class="card">
            <h3>Custo do Estoque</h3>
            <p>R$ <?= number_format($valor_custo, 2, ',', '.') ?></p>
        </div>

        <div class="card">
            <h3>Valor de Venda</h3>
            <p>R$ <?= number_format($valor_venda, 2, ',', '.') ?></p>
        </div>

        <div class="card">
            <h3>Lucro Potencial</h3>
            <p>R$ <?= number_format($lucro, 2, ',', '.') ?></p>
        </div>
    </div>

    <br>

    <hr>

</body>
</html>
