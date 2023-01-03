<?php

require "utils.php";

require "footer_html.php";

echo "<ul>";

$sql = "SELECT * from objectives ORDER BY context_id"; 

echo $sql;

$result = query_or_die_trying($sql);

if ($result) {

	while ($line = mysqli_fetch_assoc($result)) {
		echo "<li>" . $line['description'] . " Contexto: " . context_name($line['context_id']) . "</li>";
	}

	}

else {
	echo "Deveria ter morrido";
	}

echo "</ul>";

require "footer_html.php";

?>

