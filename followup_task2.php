<?php

session_start();

require "utils.php";

$id = $_POST["id"];
$description = $_POST["description"];
$followup_date = nullify($_POST["followup_date"]);
$today = date("Y-m-d");

$sql = "UPDATE tasks SET description=\"$description\",followup_date = $followup_date,done_date='$today',done=TRUE,followup=TRUE WHERE id = $id";

//echo $sql;

$result = query_or_die_trying($sql);

if ($result) {
	$_SESSION["msg"] = "Tarefa atualizada com sucesso";
	echo $_SESSION["msg"];
	}

else {
	echo "Deveria ter morrido";
	}
	

?>
