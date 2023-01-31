<?php

session_start();

require "utils.php";


$obj_description = $_POST["description"];
$category_id = $_POST["category_id"];
$delays = $_POST["delays"];
$priority = $_POST["priority"];
$objective_id = nullify($_POST["objective_id"]);
$day = nullify($_POST["day"]);
$due_date = nullify($_POST["due_date"]);


echo $obj_description;
echo $category_id;
echo $day;

$sql = "INSERT INTO tasks (description, category_id, delays, priority, due_date, objective_id, day) VALUES ('$obj_description',$category_id, $delays,$priority, $due_date, $objective_id, $day)";

echo $sql;

$result = query_or_die_trying($sql);

if ($result) {
	$_SESSION["msg"] = "Tarefa adicionada com sucesso";
	echo $_SESSION["msg"];
	redirect("index.php");
	}

else {
	echo "Deveria ter morrido";
	}
	

?>
