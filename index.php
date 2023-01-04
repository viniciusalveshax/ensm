
<?php 

require "header_html.php";
require "utils.php";

?>

<h2>Tarefas</h2>

<ul>

<?php

$sql = "SELECT * from tasks";

$result = query_or_die_trying($sql);

if ($result) {

	$count = mysqli_num_rows($result);
	echo "Qtdade de resultados: " . $count;

	if ($count >= 0) {

		echo "<ul>";

		while ($line = mysqli_fetch_assoc($result)) {
			echo "<li>" . $line['description'] . "</li>";
			}

		echo "</ul>";
	
		}

	}

else {
	echo "Deveria ter morrido";
	}

?>

</ul>

<?php

require "footer_html.php";

?>

