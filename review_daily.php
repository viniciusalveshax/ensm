
<?php 

require "header_html.php";
require "utils.php";

?>

<h2>Revisão diária</h2>

<ul>

<?php



$today_day = date('w'); // day of week

echo "Dia da semana: $today_day <br />";

$sql = "SELECT * from tasks WHERE (day IS NOT NULL OR due_date IS NOT NULL OR followup_date IS NOT NULL) AND (done=FALSE OR followup=TRUE) ORDER BY day,due_date,followup_date";

$result = query_or_die_trying($sql);

if ($result) {

	$count = mysqli_num_rows($result);
	echo "Qtdade de resultados: " . $count;

	if ($count >= 0) {
	
		$tasks = array();
		
		while ($line = mysqli_fetch_assoc($result)) {
			array_push($tasks, $line);
		}

		echo "<p>Tarefas da semana</p>";
		echo "<table><tr><th>Descrição</th><th>Categoria</th><th>Links</th></tr>";

		foreach($tasks as $line) {
			if($line['done'] == 1)
				continue;
			if ($line['day']) {
				if ($line['day'] < $today_day)
					$css_class = "emphasis_high";
				else
					if ($line['day'] == $today_day)
						$css_class = "emphasis_medium";
					else	if ($line['day'] == ($today_day+1))
							$css_class = "emphasis_low";
						else
							$css_class = "";
				if ($today_day == 0)
					$css_class = "emphasis_high";
				echo "<tr class=\"$css_class\">";		
				echo "<td>" . $line['description'] . "(" . day2name($line['day']) . ")</td>";
				echo "<td>" . category_name($line['category_id']) . "</td>";
				echo "<td>";
				show_task_quick_edit_link($line['id']);
				echo " - ";
				show_task_edit_link($line['id']);
				echo " - ";
				show_task_delay_link($line['id']);
				echo " - ";
				show_task_done_link($line['id']);
				echo " - ";
				show_task_followup_link($line['id']);
				echo "</td>";
				echo "</tr>";
				}
			}

		echo "</table>";
		
		echo "<p>Tarefas com data limite</p>";
		
		echo "<ul>";
		foreach($tasks as $line) {
			if ($line['due_date'] || $line['followup_date']) {
				$today = date_create(date());
				//var_dump($today);
				//var_dump($tmp_due_date);
				
				if ($line['followup_date']){
					$suffix = " - Acompanhar em: " . $line['followup_date'];
					$tmp_due_date = date_create($line['followup_date']);	
					}
				else
					{
					$tmp_due_date = date_create($line['due_date']);
					$suffix = " - Fazer até: " . $line['due_date'];
					}
				
				
				$diff_date = date_diff($today, $tmp_due_date);
				//var_dump($diff_date); //->format('%R%a dias');
				$left_days = $diff_date->format('%a');
				$signal_left_days = $diff_date->format('%R');
				
				//echo "<hr />" . $signal_left_days . $left_days;
				
				$css_class="";
				if ($left_days == 0 || $signal_left_days == '-')
					$css_class = "emphasis_high";
				else
					if ($left_days == 1)
						$css_class = "emphasis_medium";
					else
						if ($left_days <= 7)
							$css_class = "emphasis_low";
				
				if ($css_class != "") {		
					echo "<li class=$css_class>";
					echo $line['description'] . $suffix;
					echo "</li>";
					}
				}
			}
			
		echo "</ul>";
	
		}

	}

else {
	echo "SQL: $sql";
	echo "Deveria ter morrido";
	}

?>

</ul>

<?php

require "footer_html.php";

?>

