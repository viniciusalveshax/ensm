<?php

require "utils.php";
require "header_html.php";

echo "<ul>";

//$sql = "SELECT * from objectives WHERE hide = 0 ORDER BY importance"; 
//SELECT * FROM objectives JOIN goals WHERE goals.objective_id = objectives.id 
$sql = "SELECT * FROM objectives JOIN goals WHERE goals.objective_id = objectives.id ORDER BY objectives.importance, goals.objective_id";
$sql = "SELECT importance, objectives.description AS objective_description, goals.description AS goal_description FROM objectives JOIN goals WHERE goals.objective_id = objectives.id ORDER BY objectives.importance, goals.objective_id";

//echo $sql;

$result = query_or_die_trying($sql);

if ($result) {

	while ($line = mysqli_fetch_assoc($result)) {
		echo "<li>Importância: " . $line["importance"] . ", Objetivo: " . $line['objective_description'] . ", Meta: " . $line['goal_description'] . "</li>";
	}

	}

else {
	echo "Deveria ter morrido";
	}

echo "</ul>";

require "footer_html.php";

?>

