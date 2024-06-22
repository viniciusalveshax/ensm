
<?php 

require "header_html.php";
require "utils.php";

?>

<h2>Tarefas concluídas</h2>

<ul>

<?php

// Seleciona todas as tarefas
$sql = "SELECT * from tasks";

$result = query_or_die_trying($sql);

// Se a query deu resultado
if ($result) {

	$count = mysqli_num_rows($result);

	$done_weekly_count = array();
	$created_weekly_count = array();
	$last_week_done_tasks = array();			
	$hide_count = 0;

	$current_week_number=date("W");
	$current_year_number=date("Y");

	// Se existirem tarefas ....
	if ($count >= 0) {

		while ($line = mysqli_fetch_assoc($result)) {
			
			$create_date = $line['datetime_creation'];
			$create_date_object = new DateTime($create_date);

			// Obtem o número da semana da tarefa
			$create_week_number = $create_date_object->format('W');
			$create_week_number = (int) $create_week_number;
			
			// Obtem o ano da tarefa
			$create_year_number = $create_date_object->format('Y');
			$create_year_number = (int) $create_year_number;
			
			// Se o ano da criação da tarefa é 2024 ...
			if ($create_year_number == $current_year_number) {
				//create_weekly_count armazenada o número de tarefas criadas esse ano
				//se a chave já existe então aumenta, senão inicializa
				if ($create_weekly_count && array_key_exists($create_week_number, $create_weekly_count))
					$create_weekly_count[$create_week_number]++;
				else
					$create_weekly_count[$create_week_number] = 1;
				}

			// Verifica se tarefa já foi concluída		
			if ($line['done_date']) {
				$done_date = $line['done_date'];
				$done_date_object = new DateTime($done_date);

				//Obtem a semana em que a semana foi feita				
				$done_week_number = $done_date_object->format('W');
				$done_week_number = (int) $done_week_number;

				//Obtem o ano em que a semana foi feita
				$done_year_number = $done_date_object->format('Y');
				$done_year_number = (int) $done_year_number;	

				// Se a tarefa foi realizada esse ano
				if ($done_year_number == $current_year_number) {

					// Se a tarefa foi feita na última semana adiciona ela na lista last_week_done_tasks
					if ($current_week_number == $done_week_number)
						array_push($last_week_done_tasks, $line);
			
					// Se chave já existe então aumenta, senão inicializa
					if (array_key_exists($done_week_number, $done_weekly_count))
						$done_weekly_count[$done_week_number]++;
					else
						$done_weekly_count[$done_week_number] = 1;
					}
				}
			
			else
				// Se a tarefa foi criada esse ano verifica se ela foi escondida
				if (($create_year_number == $current_year_number) && $line['hide'])
					// Caso sim incrementa o contador de tarefas escondidas
					$hide_count++;
			

		}
	}
	
	// Mostra as tarefas feitas na última semana
	echo "<h3> Tarefas feitas na última semana (" . count($last_week_done_tasks) . "): </h3>";
	echo "<ul>";
	foreach($last_week_done_tasks as $task) {
		echo "<li>" . $task['description'] . "(" . category_name($task['category_id']) . ")</li>";
		}
	echo "</ul>";

	echo "<h3>2024</h3>";

	echo "<h4>Por semana</h4>";
	// Armazena o saldo de tarefas
	$total_diff = 0;
	$total_created = 0;
	$total_done = 0;

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
		$total_created = $total_created + $create_number;
		$total_done = $total_done + $done_number;

		$diff_number = $create_number - $done_number;
		$total_diff = $total_diff + $diff_number;
		if ($create_number != 0)
			echo "<tr><td>$i</td><td>$create_number</td><td>$done_number</td><td>$diff_number</td></tr>";
		
		}
	echo "</table>";

	$total_minus_hidden = $total_created - $hide_count;
	$average_created = $total_minus_hidden / $current_week_number;
	$average_done = $total_done / $current_week_number;

	echo "<h4>Total dif: $total_diff - Sem contar escondidas: " . ($total_diff - $hide_count) . "</h4>";
	echo "<h4>Total de tarefas criadas: $total_created - Total de tarefas feitas $total_done</h4>";
	echo "<h4>Média semana: Criadas $average_created | Feitas $average_done</h4>";

	}

else {
	echo "Deveria ter morrido";
	}

?>

</ul>

<?php

require "footer_html.php";

?>

