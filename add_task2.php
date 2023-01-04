<?php

session_start();

require "utils.php";


$obj_description = $_POST["description"];
$context_id = $_POST["context_id"];



echo $obj_description;
echo $context_id;

$sql = "INSERT INTO objectives (description, context_id) VALUES ('" . $obj_description . "','" . $context_id . "')"; 

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
