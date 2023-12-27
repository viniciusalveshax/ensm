
<?php 

require "header_html.php";
require "utils.php";

$id = $_GET["id"];

$sql = "SELECT * FROM tasks WHERE id = $id"; 

$result = query_or_die_trying($sql);

if (mysqli_num_rows($result) == 0)
	die("ID inválido");
else
	$task = mysqli_fetch_assoc($result);

echo "Chegou aqui";

?>

<h2>Editar tarefa</h2>


<form action="edit_task2.php" method="post">

<input type="hidden" value="<?php echo $task['id'] ?>" name="id" />

<p>Descrição</p>
<input type="text" placeholder="Descreva a tarefa" name="description" value="<?php echo $task['description']; ?>" />

<p>Meta</p>
<?php

$sql = "SELECT * FROM goals"; 

$result = query_or_die_trying($sql);

if ($result) {

	//echo "Resultados...";
	
	$count = mysqli_num_rows($result);
	
	echo "Qtdade de metas: $count <br />";

	echo "Meta <select name=\"goal_id\">";

	$goals = array();
	while ($line = mysqli_fetch_assoc($result)) {
		$tmp_id = $line['id'];
		$tmp_description = $line['description'];
		$goals[$tmp_id] = $tmp_description;
	}

	show_selected_option($task['goal_id'], $goals);

	echo "</select>";

}

/*
$sql = "SELECT * FROM objectives"; 

$result = query_or_die_trying($sql);

if ($result) {

	$count = mysqli_num_rows($result);
	
	echo "<br />Qtdade de objetivos:  $count <br/>";

	//$line = mysqli_fetch_assoc($result);
	
	echo "Objetivo <select name=\"objective_id\">";

	$objectives = array();
	while ($line = mysqli_fetch_assoc($result)) {
		$tmp_id = $line['id'];
		$tmp_description = $line['description'];
		$objectives[$tmp_id] = $tmp_description;

	}

	show_selected_option($task['objective_id'], $objectives);

	
	echo "</select>";

}*/

?>

<br />Data limite
<input type="text" name="due_date" value="<?php echo $task['due_date']; ?>"/>

<br />Dia da semana
<select name="day">

	<?php
	
		$day_names = array_day_names();
		show_selected_option($task['day'], $day_names);
	
	?>
</select>

<br />

Atrasos
<input type="text" name="delays" value="<?php echo $task['delays']; ?>" />

<br />

Prioridade
<input type="text" name="priority" value="<?php echo $task['priority']; ?>" /><br />

Acompanhar
<input type="text" name="followup" value="<?php echo $task['followup']; ?>" /><br />

Data para acompanhar
<input type="text" name="followup_date" value="<?php echo $task['followup_date']; ?>" /><br />

<p>
<input type="submit" value="Cadastrar" />
</p>

</form>



<?php

require "footer_html.php";

?>

