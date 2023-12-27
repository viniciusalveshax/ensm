<?php

session_start();

require "utils.php";

$obj_description = $_POST["description"];
$category_id = $_POST["category_id"];
$delays = $_POST["delays"];
$priority = $_POST["priority"];
$goal_id = nullify($_POST["goal_id"]);
$day = nullify($_POST["day"]);
$due_date = nullify($_POST["due_date"]);
$followup = $_POST['followup'];
$followup_date = nullify($_POST['followup_date']);

if ($followup)
	$done = 1;
else
	$done = 0;

echo $obj_description;
echo $category_id;
echo $day;

$sql = "INSERT INTO tasks (description, category_id, delays, priority, due_date, goal_id, day, followup, followup_date, done) VALUES ('$obj_description',$category_id, $delays,$priority, $due_date, $goal_id, $day, $followup, $followup_date, $done)";

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
