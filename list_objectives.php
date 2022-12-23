<?php

require "utils.php";

require "footer_html.php";

echo "<ul>";

$sql = "SELECT * from objectives"; 

echo $sql;

$result = query_or_die_trying($sql);

if ($result) {
	$line = mysqli_fetch_assoc($result);

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

