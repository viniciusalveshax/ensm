<?php

session_start();

require "utils.php";

$description = $_POST["description"];
$objective_id = $_POST["objective_id"];
$limit_date = $_POST["limit_date"];

$sql = "INSERT INTO goals (description, objective_id, date_limit) VALUES ('$description','$objective_id', '$limit_date')";

$result = query_or_die_trying($sql);

if ($result) {
	$_SESSION["msg"] = "Meta adicionada com sucesso";
	echo $_SESSION["msg"];
	redirect("index.php");
	}

else {
	echo $result;
	echo "Deveria ter morrido";
	}
	

?>
