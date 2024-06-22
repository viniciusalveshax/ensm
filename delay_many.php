<?php

session_start();

require "utils.php";

$today_day = date('w');

$sql = "UPDATE tasks SET day = \"$today_day\" WHERE day < $today_day and done=0 and hide=0";

echo $sql;

$result = query_or_die_trying($sql);

//$result = 0;

if ($result) {
	$_SESSION["msg"] = "Tarefas adiadas com sucesso";
	echo $_SESSION["msg"];
	}

else {
	echo "Deveria ter morrido";
	}
	

?>
