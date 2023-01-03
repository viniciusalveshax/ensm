<?php

session_start();

require "utils.php";

$description = $_POST["description"];
$category_parent = $_POST["category_parent"];

echo "Categoria pai: " . $category_parent . "<br />";
echo "Descrição: " . $description . "<br />";

//$sql = "INSERT INTO objectives (description) VALUES ('" . $obj_description . "')"; 

if ($category_parent && $category_parent != "")
	$sql = "INSERT INTO categories (description, category_parent) VALUES ('" . $description . "','" . $category_parent . "')";
else
	$sql = "INSERT INTO categories (description) VALUES ('" . $description . "')"; 

echo "SQL: " . $sql . "<br/>";

$result = query_or_die_trying($sql);

if ($result) {
	$_SESSION["msg"] = "Categoria adicionada com sucesso";
	echo $_SESSION["msg"];
	redirect("index.php");
	}

else {
	echo $result;
	echo "Deveria ter morrido";
	}
	

?>
