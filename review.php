
<?php 

require "header_html.php";
require "utils.php";

?>

<h2>Revisão</h2>

<ul>

<?php

$sql = "SELECT objective_id FROM tasks WHERE objective_id IS NOT NULL AND day IS NOT NULL GROUP BY objective_id";

$result = query_or_die_trying($sql);

$count = mysqli_num_rows($result);

if ($count == 0)
	echo "<p>Nenhum objetivo contemplado</p>";
	
else
	{
	$objectives = array();
	while ($line = mysqli_fetch_assoc($result)) {
			$tmp_objective_id = $line['objective_id'];
			$objectives[$tmp_objective_id] = true;
		}
	
	
//	print_r($objectives);
	
	$sql = "SELECT id, description, month_begin FROM objectives";

	$result = query_or_die_trying($sql);
	
	echo "<p>Objetivos não contemplados</p>";
	
	echo "<ul>";

//	echo date('n');
	
	while ($line = mysqli_fetch_assoc($result)) {
			$tmp_id = $line['id'];
			$description = $line['description'];
			$month_begin = $line['month_begin'];
			if (!array_key_exists($tmp_id, $objectives) && (date('n')>=$month_begin))
				echo "<li>Objetivo $description não contemplado </li>";
		}
	
	echo "</ul>";
	
	}

?>

</ul>

<ul>

<?php

$sql = "SELECT * from tasks WHERE done=false ORDER BY category_id, priority, delays DESC";

$result = query_or_die_trying($sql);

if ($result) {

	$count = mysqli_num_rows($result);
	echo "Qtdade de resultados: " . $count;

	if ($count >= 0) {

		echo "<p>Tarefas</p>";

		echo "<p>Tarefas possíveis</p>";
		echo "<table><tr><th>Descrição</th><th>Data limite</th><th>Qtdade adiament.</th><th>Categoria</th><th>Links</th></tr>";

		
		while ($line = mysqli_fetch_assoc($result)) {
			if ($line["day"])
				continue;
			echo "<tr><td>" . $line['description'] . "</td>";
			echo "<td>" . $line["due_date"] . "</td>";
			echo "<td>" . $line["delays"] . "</td>";
			echo "<td>" . category_name($line['category_id']) . "</td>";
			echo "<td>";
			show_task_quick_edit_link($line['id']);
			echo " - ";
			show_task_edit_link($line['id']);
			echo " - ";
			show_task_delay_link($line['id']);
			echo "</td></tr>";
			}

		echo "</table>";
	
		}

	}

else {
	echo "Deveria ter morrido";
	}

?>

</ul>

<?php

require "footer_html.php";

?>

