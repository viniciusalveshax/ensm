
<?php 

require "header_html.php";
require "utils.php";

$id = $_GET["id"];

$sql = "SELECT * FROM tasks WHERE id = " . $id; 

echo $sql;

$result = query_or_die_trying($sql);

echo "Chegou aqui";

$task = mysqli_fetch_assoc($result);

?>

<h2>Edição rápida de tarefa</h2>

<form action="quick_edit_task2.php" method="post">

<input type="hidden" value="<?php echo $task['id'] ?>" name="id" />

<p>Descrição</p>
<input type="text" value="<?php echo $task['description'] ?>" name="description" />

<br />Dia da semana
<select name="day">
	<option></option>

	<?php 
		echo $task['day'];
		for($i = 1; $i<=7; $i++) {
			if ($task['day'] == $i)
				$selected = "selected";
			else
				$selected = "";
			echo "<option value=$i $selected>" . day2name($i) . "</option>";
		}
	?>
</select>

<p>
<input type="submit" value="Atualizar" />
</p>

</form>

<?php

require "footer_html.php";

?>

