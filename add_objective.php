
<?php 

require "header_html.php";
require "utils.php";

?>

<h2>Adicionar objetivo</h2>

<form action="add_objective2.php" method="post">

<p>Descrição</p>
<input type="text" placeholder="Descreva o objetivo" name="description" />

<p>Importância</p>
<select name="importance">
	<option value="high">Alta</option>
	<option value="medium">Média</option>
	<option value="low">Baixa</option>
</select>

<p>
<input type="submit" value="Cadastrar" />
</p>

</form>



<?php

require "footer_html.php";

?>

