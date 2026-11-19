<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

include("../conexao.php");

$sql = "
SELECT
p.id,
p.codigo,
p.descricao,
p.unidade,
p.estoque_atual,
p.estoque_minimo,
p.preco_custo,
p.preco_venda
FROM produtos p
ORDER BY p.descricao
";

$res = pg_query($con, $sql);

if (!$res) {
die("Erro ao consultar estoque: " . pg_last_error($con));
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


<h2>Consulta de Estoque</h2>

<p><a class="btn" href="index.php">Voltar Produtos</a>  <a class="btn" href="../index.php">Voltar Menu</a></p>

<table border="1" cellpadding="2" cellspacing="0">

<tr>
<th>Código</th>
<th>Descrição</th>
<th>Unidade</th>
<th>Estoque Atual</th>
<th>Estoque Mínimo</th>
<th>Preço Custo</th>
<th>Preço Venda</th>
<th>Situação</th>
</tr>

<?php

while ($linha = pg_fetch_assoc($res)) {

$situacao =
($linha['estoque_atual'] <= $linha['estoque_minimo'])
? 'Abaixo do mínimo'
: 'Normal';

$classe =
($linha['estoque_atual'] <= $linha['estoque_minimo'])
? 'abaixo'
: 'normal';

?>

<tr>

<td><?php echo $linha['codigo']; ?></td>

<td><?php echo $linha['descricao']; ?></td>

<td><?php echo $linha['unidade']; ?></td>

<td><?php echo number_format($linha['estoque_atual'], 0, ',', '.') ?></td>

<td><?php echo number_format($linha['estoque_minimo'], 0, ',', '.') ?></td>

<td>
R$
<?php echo number_format($linha['preco_custo'], 2, ',', '.'); ?>
</td>

<td>
R$
<?php echo number_format($linha['preco_venda'], 2, ',', '.'); ?>
</td>

<td class="<?php echo $classe; ?>"><?php echo $situacao; ?></td>

</tr>

<?php } ?>

</table>
