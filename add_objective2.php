<?php

session_start();

require "utils.php";


$obj_description = $_POST["description"];
$importance = $_POST["importance"];

$sql = "INSERT INTO objectives (description, importance) VALUES ('$obj_description', '$importance')"; 

//echo $sql;

$result = query_or_die_trying($sql);

if ($result) {
	$_SESSION["msg"] = "Objetivo adicionado com sucesso";
	echo $_SESSION["msg"];
	redirect("index.php");
	}

else {
	echo "Deveria ter morrido";
	}
	

?>
