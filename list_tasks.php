<?php

require "utils.php";
require "header_html.php";

echo "<ul>";

if ($_GET["day"] && ($_GET["day"]!="")){
	$day = $_GET["day"];
	$sql = "SELECT * from tasks WHERE day <= " . $day . " ORDER BY day"; 
	}
else {
	$sql = "SELECT * from tasks ORDER BY category_id"; 
	}

echo $sql;

$result = query_or_die_trying($sql);

if ($result) {

	while ($line = mysqli_fetch_assoc($result)) {
		echo "<li>" . $line['description'] . ", Categoria: " . category_name($line['category_id']) . ", Data: " . $line['day'] . "</li>";
	}

	}

else {
	echo "Deveria ter morrido";
	}

echo "</ul>";

require "footer_html.php";

?>

