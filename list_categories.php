<?php

require "utils.php";
require "header_html.php";

echo "<h2>Categorias</h2>";


if ($_GET["category_parent"]) {
	$category_parent = $_GET["category_parent"];
	$sql = "SELECT * from categories WHERE category_parent = " . $category_parent; 
	}
else
	$sql = "SELECT * from categories WHERE category_parent IS NULL"; 

echo $sql;

$result = query_or_die_trying($sql);

if ($result) {
//	$line = mysqli_fetch_assoc($result);

	$count = mysqli_num_rows($result);
	echo "Qtdade de resultados: " . $count;

	if ($count >= 0) {

		echo "<ul>";

		while ($line = mysqli_fetch_assoc($result)) {
			echo "<li><a href=\"list_categories.php?category_parent=" . $line['id'] . "\">" . $line['description'] . "</a></li>";
			}

		echo "</ul>";
	
		}

	}

else {
	echo "Deveria ter morrido";
	}


require "footer_html.php";

?>

