
<?php 

require "header_html.php";
require "utils.php";

?>

<h2>Tarefas concluídas</h2>

<ul>

<?php

$sql = "SELECT * from tasks WHERE (done=true AND followup=false) ORDER BY done_date DESC";

$result = query_or_die_trying($sql);

if ($result) {

	$count = mysqli_num_rows($result);
	echo "Qtdade de resultados (total): " . $count;

	$weekly_count = array();

	if ($count >= 0) {

		while ($line = mysqli_fetch_assoc($result)) {
			$done_date = $line['done_date'];
			$date_object = new DateTime($done_date);
			$week_number = $date_object->format('W');
			//echo "<p>$done_date : $week_number</p>";
			// Se chave já existe então aumenta, senão inicializa
			if (array_key_exists($week_number, $weekly_count))
				$weekly_count[$week_number]++;
			else
				$weekly_count[$week_number] = 1;
			}

		}

	ksort($weekly_count);

	//print_r($weekly_count);
	
	echo "<h3>Por semana</h3>";
	
	foreach($weekly_count as $week => $val)
		echo "<li>Semana $week: $val</li>";

	}

else {
	echo "Deveria ter morrido";
	}

?>

</ul>

<?php

require "footer_html.php";

?>

