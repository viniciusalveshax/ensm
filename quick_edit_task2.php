<?php

session_start();

require "utils.php";

$id = $_POST["id"];
$description = $_POST["description"];
$day = $_POST["day"];

echo $id;
echo $description;
echo $day;

if ($day != "")
	$sql = "UPDATE tasks SET description = \"$description\", day = $day WHERE id = $id";
else
	$sql = "UPDATE tasks SET description = \"$description\", day = NULL WHERE id = $id";

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
