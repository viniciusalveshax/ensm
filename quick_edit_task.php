
<?php 

require "header_html.php";
require "utils.php";

$id = $_GET["id"];


$sql = "SELECT * FROM tasks WHERE id = " . $id; 

$result = query_or_die_trying($sql);

echo "Chegou aqui";

?>

<h2>Editar rápida de tarefas</h2>

<form action="quick_edit_task2.php" method="post">

<p>Descrição</p>
<input type="text" placeholder="Descreva a tarefa" name="description" />

<br />Dia da semana
<select name="day">
	<option></option>
	<option value="1">Segunda</option>
	<option value="2">Terça</option>
	<option value="3">Quarta</option>
	<option value="4">Quinta</option>
	<option value="5">Sexta</option>
	<option value="6">Sábado</option>
	<option value="7">Domingo</option>
</select>

<p>
<input type="submit" value="Atualizar" />
</p>

</form>

<?php

require "footer_html.php";

?>

