<?php

require "utils.php";

require "footer_html.php";

echo "<ul>";

if ($_GET["context_parent"]) {
	$context_parent = $_GET["context_parent"];
	$sql = "SELECT * from contexts WHERE context_parent = " . $context_parent; 
	}
else
	$sql = "SELECT * from contexts WHERE context_parent IS NULL"; 

echo $sql;

$result = query_or_die_trying($sql);



if ($result) {
//	$line = mysqli_fetch_assoc($result);

	$count = mysqli_num_rows($result);
	echo "Qtdade de resultados: " . $count;

	while ($line = mysqli_fetch_assoc($result)) {
		echo "<li>" . $line['description'] . "</li>";
	}

	}

else {
	echo "Deveria ter morrido";
	}

echo "</ul>";

require "footer_html.php";

?>

