<?php

session_start();

require "utils.php";


$obj_description = $_POST["description"];
$category_id = $_POST["category_id"];
$day = $_POST["day"];
$delays = $_POST["delays"];
$priority = $_POST["priority"];


echo $obj_description;
echo $category_id;
echo $day;

if ($day && ($day!="") )
	$sql = "INSERT INTO tasks (description, category_id, day, delays, priority) VALUES ('" . $obj_description . "','" . $category_id . "', '" . $day . "', '" . $delays . "', '" . $priority . "')"; 
else
	$sql = "INSERT INTO tasks (description, category_id, delays, priority) VALUES ('" . $obj_description . "','" . $category_id . "', '" . $delays . "', '" . $priority . "')";

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