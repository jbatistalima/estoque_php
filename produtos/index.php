<?php include '../auth.php'; ?>

<?php

include("../conexao.php");

$sql = "
SELECT
p.id,
p.codigo,
p.descricao,
c.descricao AS categoria,
f.razao_social AS fornecedor,
p.unidade,
p.estoque_atual,
p.estoque_minimo,
p.preco_custo,
p.preco_venda,
p.ativo
FROM produtos p
LEFT JOIN categorias c
ON c.id = p.categoria_id
LEFT JOIN fornecedores f
ON f.id = p.fornecedor_id
ORDER BY p.descricao
";

$res = pg_query($con, $sql);

if (!$res) {
die("Erro ao consultar produtos: " . pg_last_error($con));
}

?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>

<meta charset="utf-8">

<title>Relatório de Estoque</title>

<style>

body{
    font-family: Arial, Helvetica, sans-serif;
    background-color:#aea7a7;
    margin:20px;
}

h2{
    color:#003366;
    text-align:center;
}

.alterar a, .excluir a{
    text-decoration: none;
    font-size: 18px;
}

.alterar, .excluir {
    text-align: center;
}

.alterar a:hover, .excluir a:hover {
    transform: scale(1.5); 
}

table{
    width:100%;
    border-collapse:collapse;
    background:#fff;
}

th{
    background:#003366;
    color:#fff;
    padding:10px;   
    text-align: left;
}

td{
    padding:8px;
}

tr:nth-child(even){
    background:#f2f2f2;
}

.baixo{
    color:red;
    font-weight:bold;
}

.btn{
    display:inline-block;
    margin-top:20px;
    padding:10px 20px;
    background:#0066cc;
    color:white;
    text-decoration:none;
    border-radius:20px;
}

</style>

</head>

<h2>Cadastro de Produtos</h2>

<p >
<a class="btn" href="cadastrar.php">Novo Produto</a>
<a class="btn" href="../index.php">Voltar ao Menu</a> 
<a class="btn" href="../produtos/estoque.php">Ver Estoque</a> 
</p>

<table border="2" width="100%" cellpadding="5" cellspacing="0">

<tr>
<th>ID</th>
<th>Código</th>
<th>Descrição</th>
<th>Categoria</th>
<th>Fornecedor</th>
<th>Unidade</th>
<th>Estoque</th>
<th>Nível</th>
<th>Custo</th>
<th>Venda</th>
<th>Ativo</th>
<th>Alterar</th>
<th>Excluir</th>
</tr>

<?php while ($linha = pg_fetch_assoc($res)) { ?>

<tr>

<td><?php echo $linha['id']; ?></td>

<td><?php echo $linha['codigo']; ?></td>

<td><?php echo $linha['descricao']; ?></td>

<td><?php echo $linha['categoria']; ?></td>

<td><?php echo $linha['fornecedor']; ?></td>

<td><?php echo $linha['unidade']; ?></td>

<td><?php echo $linha['estoque_atual']; ?></td>

<td><?php echo $linha['estoque_minimo']; ?></td>

<td>R$<?php echo number_format($linha['preco_custo'], 2, ',', '.'); ?></td>

<td>R$<?php echo number_format($linha['preco_venda'], 2, ',', '.'); ?></td>

<td>
<?php
echo ($linha['ativo'] == 't') ? 'Sim' : 'Não';
?>
</td>

<td class="alterar"><a href="alterar.php?id=<?php echo $linha['id']; ?>">✏️</a></td>

<td class="excluir">
<a href="excluir.php?id=<?php echo $linha['id']; ?>" onclick="return confirm('Deseja realmente excluir este produto?');">🗑️</a></td>

</tr>

<?php } ?>

</table>
