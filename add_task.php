
<?php 

require "header_html.php";
require "utils.php";

$sql = "SELECT * FROM categories"; 

$result = query_or_die_trying($sql);

echo "Chegou aqui";

?>

<h2>Adicionar tarefa</h2>

<form action="add_task2.php" method="post">

<p>Descrição</p>
<input type="text" placeholder="Descreva a tarefa" name="description" />

<p>Categoria</p>
<?php

if ($result) {

	//echo "Resultados...";
	
	$count = mysqli_num_rows($result);
	
	echo "Qtdade de categorias: " . $count;

	echo "<select name=\"category_id\">";

	//$line = mysqli_fetch_assoc($result);

	while ($line = mysqli_fetch_assoc($result)) {
		echo "<option value=" . $line['id'] . ">" . $line['description'] . "</option>";
		//echo "oi";
	}

}

echo "</select>";

$sql = "SELECT * FROM objectives"; 

$result = query_or_die_trying($sql);

if ($result) {

	$count = mysqli_num_rows($result);
	
	echo "<br />Qtdade de objetivos: " . $count;

	//$line = mysqli_fetch_assoc($result);
	
	echo "<select name=\"objective_id\"> <option></option>";

	while ($line = mysqli_fetch_assoc($result)) {
		echo "<option value=" . $line['id'] . ">" . $line['description'] . "</option>";
		//echo "oi";
	}
	
	echo "</select>";

}

?>

<br />Data limite
<input type="text" name="due_date" />

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

<br />

Atrasos
<input type="text" name="delays" value="0" />

<br />

Prioridade
<input type="text" name="priority" value="1" />

<br />

Acompanhar
<input type="text" name="followup" value="0" />

<br />

Data de acompanhamento
<input type="text" name="followup_date" />

<br />

<p>
<input type="submit" value="Cadastrar" />
</p>

</form>



<?php

require "footer_html.php";

?>

