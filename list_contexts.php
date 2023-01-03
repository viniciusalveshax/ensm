<?php

require "utils.php";
require "header_html.php";

echo "<h2>Contextos</h2>";


if ($_GET["context_parent"]) {
	$context_parent = $_GET["context_parent"];
	$sql = "SELECT * from contexts WHERE context_parent = " . $context_parent; 
	}
else
	$sql = "SELECT * from contexts WHERE context_parent IS NULL"; 

//echo $sql;

$result = query_or_die_trying($sql);



if ($result) {
//	$line = mysqli_fetch_assoc($result);

	$count = mysqli_num_rows($result);
	echo "Qtdade de resultados: " . $count;

	echo "<ul>";

	while ($line = mysqli_fetch_assoc($result)) {
		echo "<li><a href=\"list_contexts.php?context_parent=" . $line['id'] . "\">" . $line['description'] . "</a></li>";
	}

	echo "</ul>";

	}

else {
	echo "Deveria ter morrido";
	}


require "footer_html.php";

?>

