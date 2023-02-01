
<?php 

require "header_html.php";
require "utils.php";

?>

<h2>Revisão diária</h2>

<ul>

<?php



$today_day = date('w'); // day of week

echo "Dia da semana: $today_day <br />";

$sql = "SELECT * from tasks WHERE (day IS NOT NULL OR due_date IS NOT NULL) AND done=FALSE ORDER BY day, due_date";

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
		echo "<ul>";

		foreach($tasks as $line) {
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
				echo "<li class=\"$css_class\">";		
				echo $line['description'];
				echo " Categoria: " . category_name($line['category_id']) . " ";
				show_task_quick_edit_link($line['id']);
				echo " - ";
				show_task_edit_link($line['id']);
				echo " - ";
				show_task_delay_link($line['id']);
				echo "</li>";
				}
			}

		echo "</ul>";
		
		echo "<p>Tarefas com date limite (</p>";
		
		echo "<ul>";
		foreach($tasks as $line) {
			if ($line['due_date']) {
				$today = date_create(date());
				//var_dump($today);
				$tmp_due_date = date_create($line['due_date']);
				//var_dump($tmp_due_date);
				$diff_date = date_diff($today, $tmp_due_date);
				//var_dump($diff_date); //->format('%R%a dias');
				$left_days = $diff_date->format('%a');
				
				$css_class="";
				if ($left_days < 0)
					$css_class = "emphasis_high";
				else
					if ($left_days == 0 || $left_days == 1)
						$css_class = "emphasis_medium";
					else
						if ($left_days <= 7)
							$css_class = "emphasis_low";
						
				echo "<li class=$css_class>" . $line['description'];
				echo "</li>";
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

