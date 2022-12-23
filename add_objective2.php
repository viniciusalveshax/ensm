<?php

session_start();

require "utils.php";

$obj_description = $_POST["description"];

echo $obj_description;

$sql = "INSERT INTO objectives (description) VALUES ('" . $obj_description . "')"; 

echo $sql;

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
