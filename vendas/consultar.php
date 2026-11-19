<?php

include '../conexao.php';

if (!isset($_GET['id'])) {
die('Venda não informada.');
}

$id = (int) $_GET['id'];

$sql = "
SELECT
v.*,
c.nome
FROM vendas v
LEFT JOIN clientes c
ON c.id = v.cliente_id
WHERE v.id = $id
";

$resVenda = pg_query($con, $sql);

if (!$resVenda) {
die(pg_last_error($con));
}

$venda = pg_fetch_assoc($resVenda);

if (!$venda) {
die('Venda não encontrada.');
}

$sqlItens = "
SELECT
p.descricao,
vi.quantidade,
vi.valor_unitario,
vi.subtotal
FROM vendas_itens vi
INNER JOIN produtos p
ON p.id = vi.produto_id
WHERE vi.venda_id = $id
";

$itens = pg_query($con, $sqlItens);

if (!$itens) {
die(pg_last_error($con));
}

?>

<style>

body{
font-family: Arial, Helvetica, sans-serif;
background-color: #aea7a7;
}

#conteudo{
font-family: Arial, Helvetica, sans-serif;
width: 70%;
margin: auto;
background-color: #aea7a7;
}

table{
border-collapse: collapse;
width: 95%;
margin: 25px;
}

th{
text-align: left;
background-color: rgba(131,129,126,.85);
color: #003366;
padding: 8px;
}

td{
padding: 8px;
background-color: #ffffff;
}

h2{
color: #003366;
text-shadow: 2px 2px 5px #000;
text-align: center;
}

.texto{
margin-left: 2%;
color: #003366;
text-shadow: 2px 2px 5px #000;
font-size: 1.2em;
font-weight: bold;
}

.btn{
background: linear-gradient(
to bottom,
#6b1516 0%,
#c0262c 30%,
#c0262c 70%,
#6b1516 100%
);

border: none;
border-radius: 30px;
font-size: 1em;
color: #fff;
padding: 10px 30px;
margin-left: 2%;
text-decoration: none;
text-shadow: 2px 2px 5px #000;
}

</style>

<h2>Venda Número <?= $venda['id'] ?></h2>

<div id="conteudo">

<p>
<span class="texto">Cliente:</span>
<?= $venda['nome'] ?>
</p>

<p>
<span class="texto">Total:</span>
R$ <?= number_format($venda['valor_total'], 2, ',', '.') ?>
</p>

<table border="1">

<tr>
<th>Produto</th>
<th>Qtd</th>
<th>Valor</th>
<th>Subtotal</th>
</tr>

<?php while($item = pg_fetch_assoc($itens)) { ?>

<tr>
<td><?= $item['descricao'] ?></td>

<td><?= $item['quantidade'] ?></td>

<td>
R$ <?= number_format($item['valor_unitario'], 2, ',', '.') ?>
</td>

<td>
R$ <?= number_format($item['subtotal'], 2, ',', '.') ?>
</td>
</tr>

<?php } ?>

</table>

<a class="btn" href="index.php">
Voltar
</a>

</div>