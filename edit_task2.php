<?php

session_start();

require "utils.php";

$id = $_POST["id"];
$description = $_POST["description"];
$goal_id = $_POST["goal_id"];
$delays = $_POST["delays"];
$priority = $_POST["priority"];
$followup = $_POST["followup"];
$due_date = nullify($_POST['due_date']);
$day = nullify($_POST['day']);
$followup_date = nullify($_POST['followup_date']);

echo "Objetivo id depois:$objective_id";
echo $id;
echo $description;
echo $day;
echo "<br />Prioridade:$priority;";

$sql = "UPDATE tasks SET description=\"$description\", day=$day, goal_id=$goal_id, delays=$delays, priority=$priority, due_date=$due_date,followup=$followup,followup_date=$followup_date, done=FALSE WHERE id = $id";

$result = query_or_die_trying($sql);

if ($result) {
	$_SESSION["msg"] = "Tarefa atualizada com sucesso";
	echo $_SESSION["msg"];
	redirect("review.php");
	}

else {
	echo "Deveria ter morrido";
	}
	

?>
