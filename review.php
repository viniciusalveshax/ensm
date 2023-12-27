
<?php 

require "header_html.php";
require "utils.php";

?>

<h2>Revisão</h2>

<ul>

<?php

$sql = "select id, description from objectives where objectives.id not in (select objective_id from goals) and hide=0 and importance='high'";

//$sql = "SELECT objective_id FROM tasks WHERE objective_id IS NOT NULL AND day IS NOT NULL AND done = 0 GROUP BY objective_id";

$result = query_or_die_trying($sql);

$count = mysqli_num_rows($result);

$objectives = array();

if ($count == 0)
	echo "<p>Objetivos importantes contemplados com metas: ok</p>";
else
	echo '<h3>Objetivos importantes sem metas</h3>';	
	echo '<ul>';
	while ($line = mysqli_fetch_assoc($result)) {
			$objective_description = $line["description"];
			echo "<li>$objective_description</li>";
		}
	echo '</ul>';

//print_r($objectives);

$sql = "SELECT id, description, month_begin FROM objectives WHERE hide = 0";

$result = query_or_die_trying($sql);

echo "<p>Objetivos não contemplados</p>";

echo "<ul>";

//	echo date('n');

while ($line = mysqli_fetch_assoc($result)) {
		//print_r($line);
		$tmp_id = $line['id'];
		$description = $line['description'];
		$month_begin = $line['month_begin'];
		if (!array_key_exists($tmp_id, $objectives) && (date('n')>=$month_begin))
			echo "<li>Objetivo $description não contemplado </li>";
	}

echo "</ul>";
	
?>

</ul>

<ul>

<?php

$sql = "SELECT * from tasks WHERE (done=false OR followup=true) AND hide=false ORDER BY category_id, priority, delays DESC";

$result = query_or_die_trying($sql);

if ($result) {

	$count = mysqli_num_rows($result);
	echo "Qtdade de resultados: " . $count;

	$line_count = 0;
	if ($count >= 0) {

		echo "<p>Tarefas</p>";

		echo "<p>Tarefas possíveis</p>";
		echo "<table><tr><th>Descrição</th><th>Data limite/Acomp.</th><th>Qtdade adiament.</th><th>Categoria</th><th>Links</th></tr>";


		while ($line = mysqli_fetch_assoc($result)) {
			if ($line["day"])
				continue;
			$line_count++;
			$css_class = ''; // Reseta classe css em cada linha
			// Se já adiou muitas vezes então apresenta um maior destaque 
			if ($line['delays'] >= 10)
				$css_class = "emphasis_high";
			// Deixa as linhas pares com uma cor diferente
			if (($line_count % 2) == 0)
				$css_class = $css_class . " odd";
			echo "<tr class='$css_class'><td>" . $line['description'] . "</td>";
			echo "<td>D." . $line["due_date"] . "/A." . $line["followup_date"] . "</td>";
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

