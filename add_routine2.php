<?php

session_start();

require "utils.php";

print_r($_POST);

$description = $_POST["description"];
$goal_id = $_POST["goal_id"];
$repetitions = $_POST["repetitions"];
$kind = $_POST["kind"];

if ($goal_id && ($goal_id != ""))
	$sql = "INSERT INTO routines (description, goal_id, repetitions, kind) VALUES ('$description','$goal_id', '$repetitions', '$kind')";
else
	$sql = "INSERT INTO routines (description, repetitions, kind) VALUES ('$description','$repetitions', '$kind')";

$result = query_or_die_trying($sql);

if ($result) {
	$_SESSION["msg"] = "Rotina adicionada com sucesso";
	echo $_SESSION["msg"];
	redirect("index.php");
	}

else {
	echo $result;
	echo "Deveria ter morrido";
	}
	

?>
