
<?php 

require "header_html.php";
require "utils.php";

?>

<h2>Tarefas concluídas</h2>

<ul>

<?php

$sql = "SELECT * from tasks";

$result = query_or_die_trying($sql);

if ($result) {

	$count = mysqli_num_rows($result);
	echo "Qtdade de resultados (total): " . $count;

	$done_weekly_count = array();
	$created_weekly_count = array();
	$last_week_done_tasks = array();			
	$hide_count = 0;

	$current_week_number=date("W");

	if ($count >= 0) {

		while ($line = mysqli_fetch_assoc($result)) {
			
			$create_date = $line['datetime_creation'];
			$create_date_object = new DateTime($create_date);
			//echo $create_date_object;
			//$create_date_object = DateTime::createFromFormat('Y-m-d H:i:s', $create_date);
			
			$create_week_number = $create_date_object->format('W');
			//echo "$create_week_number . <br/>";
			
			$create_week_number = (int) $create_week_number;
			
			// Se chave já existe então aumenta, senão inicializa
			if (array_key_exists($create_week_number, $create_weekly_count))
				$create_weekly_count[$create_week_number]++;
			else
				$create_weekly_count[$create_week_number] = 1;
			
			
			// Verifica se tarefa já foi concluída		
			if ($line['done_date']) {
				$done_date = $line['done_date'];
				$done_date_object = new DateTime($done_date);
				$done_week_number = $done_date_object->format('W');
				$done_week_number = (int) $done_week_number;
	
				if ($current_week_number == $done_week_number)
					array_push($last_week_done_tasks, $line);
		
				// Se chave já existe então aumenta, senão inicializa
				if (array_key_exists($done_week_number, $done_weekly_count))
					$done_weekly_count[$done_week_number]++;
				else
					$done_weekly_count[$done_week_number] = 1;
				}
			
			else
				// Se a tarefa não foi concluída verifica se ela foi escondida
				if ($line['hide'])
					// Caso sim incrementa o contador de tarefas escondidas
					$hide_count++;
			

		}
	}
	
	echo "<h3>Por semana</h3>";
	
	// Armazena o saldo de tarefas
	$total_diff = 0;
	echo "<table>";
	echo "<tr><td>Semana</td><td>Criadas</td><td>Feitas</td><td>Dif</td></tr>";
	for($j = 0; $j<=52; $j++){
		$i = $j;
		if (array_key_exists($i, $done_weekly_count)) {
			$done_number = $done_weekly_count[$i];
			}
		else
			$done_number = 0;
		if (array_key_exists($i, $create_weekly_count))
			$create_number = $create_weekly_count[$i];
		else
			$create_number = 0;
		$diff_number = $create_number - $done_number;
		$total_diff = $total_diff + $diff_number;
		if ($create_number != 0)
			echo "<tr><td>$i</td><td>$create_number</td><td>$done_number</td><td>$diff_number</td></tr>";
		
		}
	echo "</table>";

	echo "<h3> Tarefas feitas na última semana (" . count($last_week_done_tasks) . "): </h3>";
	echo "<ul>";
	foreach($last_week_done_tasks as $task) {
		echo "<li>" . $task['description'] . "</li>";
		}
	echo "</ul>";

	echo "<h3>Total dif: $total_diff</h3>";

	echo "<h3>Total (sem contar escondidas): " . ($total_diff - $hide_count) . "</h3>";

	}

else {
	echo "Deveria ter morrido";
	}

?>

</ul>

<?php

require "footer_html.php";

?>

