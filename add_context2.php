<?php

session_start();

require "utils.php";

$description = $_POST["description"];

echo "Descrição: " . $description . "<br />";



//$sql = "INSERT INTO objectives (description) VALUES ('" . $obj_description . "')"; 

$sql = "INSERT INTO contexts (description) VALUES ('" . $description . "')"; 

echo "SQL: " . $sql . "<br/>";

$result = query_or_die_trying($sql);

if ($result) {
	$_SESSION["msg"] = "Contexto adicionado com sucesso";
	echo $_SESSION["msg"];
	redirect("index.php");
	}

else {
	echo $result;
	echo "Deveria ter morrido";
	}
	

?>
