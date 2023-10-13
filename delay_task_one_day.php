<?php

session_start();

require "utils.php";

$id = $_GET["id"];


$sql = "SELECT * FROM tasks WHERE id = " . $id; 
$result = query_or_die_trying($sql);
$task = mysqli_fetch_assoc($result);

$day = $task['day'];
$updated_day = $day + 1;

$sql = "UPDATE tasks SET day = \"$updated_day\" WHERE id = $id";

$result = query_or_die_trying($sql);

if ($result) {
	$_SESSION["msg"] = "Tarefa adiada com sucesso";
	echo $_SESSION["msg"];
	}

else {
	echo "Deveria ter morrido";
	}
	

?>
