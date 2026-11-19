<?php

include '../conexao.php';

$id = $_GET['id'];

$sql = "
SELECT
c.id,
c.data_compra,
c.valor_total,
f.razao_social
FROM compras c
INNER JOIN fornecedores f
ON f.id = c.fornecedor_id
WHERE c.id = $id
";

$compra = pg_fetch_assoc(
pg_query($con,$sql)
);

$sqlItens = "
SELECT
p.descricao,
i.quantidade,
i.valor_unitario,
i.subtotal
FROM compras_itens i
INNER JOIN produtos p
ON p.id = i.produto_id
WHERE i.compra_id = $id
";

$itens = pg_query($con,$sqlItens);
?>

<style>
body{
font-family: Arial, Helvetica, sans-serif;
background-color: #aea7a7;
}
    
table{
border-collapse: collapse;
margin: 2%;
width: 95%;
}

th {
text-align: left;    
}

#conteudo {
font-family: Arial, Helvetica, sans-serif;
width: 70%;
height: 90%;
margin-top: 5%;
margin: auto;
background-color: #aea7a7;
}

.consultar {
text-decoration: none;
}


h2, p.fornecedor {
color: #003366;
text-shadow: 2px 2px 5px #000;
margin-left: 2%;
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
margin: 2%;
text-shadow: 2px 2px 5px #000;
cursor: pointer;
}

</style>
<div id="conteudo">
    
    <h2>Compra <?= $compra['id'] ?></h2>
    
<p class="fornecedor">
Fornecedor:
<?= $compra['razao_social'] ?>
</p>

<table border="1" width="100%" cellpadding="5" cellspacing="0">

<tr>
<th>Produto</th>
<th>Qtd</th>
<th>Valor</th>
<th>Subtotal</th>
</tr>

<?php while($item = pg_fetch_assoc($itens)){ ?>

<tr>
<td><?= $item['descricao'] ?></td>
<td><?= number_format($item['quantidade'], 0, ',', '.') ?></td>
<td>R$<?= $item['valor_unitario'] ?></td>
<td>R$<?= $item['subtotal'] ?></td>
</tr>

<?php } ?>

</table><br>
<a class="btn" href="index.php">Voltar</a>

</div>


