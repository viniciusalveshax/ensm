
<?php 

require "header_html.php";
require "utils.php";

?>

<h2>Revisão diária</h2>

<ul>

<?php



$today_day = date('w'); // day of week

echo "Dia da semana: $today_day <br />";

$sql = "SELECT * from tasks WHERE day >= $today_day ORDER BY day";

$result = query_or_die_trying($sql);

if ($result) {

	$count = mysqli_num_rows($result);
	echo "Qtdade de resultados: " . $count;

	if ($count >= 0) {
	
		$tasks = array();

		echo "<ul>";

		while ($line = mysqli_fetch_assoc($result)) {
			if ($line['day'] == $today_day)
				$css_class = "today";
			else
				if ($line['day'] == ($today_day+1))
					$css_class = "tomorrow";
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

