<?php

session_start();

require "utils.php";

$id = $_POST["id"];
$description = $_POST["description"];
$category_id = $_POST["category_id"];
$delays = $_POST["delays"];
$priority = $_POST["priority"];
$followup = $_POST["followup"];
$objective_id = nullify($_POST['objective_id']);
$due_date = nullify($_POST['due_date']);
$day = nullify($_POST['day']);
$followup_date = nullify($_POST['followup_date']);

echo "Objetivo id depois:$objective_id";
echo $id;
echo $description;
echo $day;
echo "<br />Prioridade:$priority;";

$sql = "UPDATE tasks SET description=\"$description\", day=$day, category_id=$category_id, delays=$delays, priority=$priority, objective_id=$objective_id, due_date=$due_date,followup=$followup,followup_date=$followup_date, done=FALSE WHERE id = $id";

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
