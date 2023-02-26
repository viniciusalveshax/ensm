<?php

session_start();

require "utils.php";

$id = $_GET["id"];

//$today = date_create(date());

$today = date("Y-m-d");

$sql = "UPDATE tasks SET hide=TRUE WHERE id = $id"; 
$result = query_or_die_trying($sql);

if ($result) {
	$_SESSION["msg"] = "Tarefa escondida com sucesso";
	echo $_SESSION["msg"];
	}

else {
	echo "Deveria ter morrido";
	}
	

?>
