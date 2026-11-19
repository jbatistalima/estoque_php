<form action="salvar.php" method="post">

<p>Nome</p>
<input type="text" name="nome" required>

<p>Login</p>
<input type="text" name="login" required>

<p>Senha</p>
<input type="password" name="senha" required>

<p>Perfil</p>
<select name="perfil">
<option value="ADMIN">Administrador</option>
<option value="OPERADOR">Operador</option>
</select>

<br><br>

<button type="submit">
Salvar
</button>

</form>