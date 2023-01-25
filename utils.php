
<?php

require "connection.php";

function query_or_die_trying($sql) {
	//TODO Test agains SQL Injection!
	$connection = connect();

	if (!$connection)
		die("<br />Não encontrou a conexão. Erro fatal. Encerrando ...");
	else	{
		$result = mysqli_query($connection, $sql);
		if ($result)
			return $result;
		else	{
			echo mysqli_error($connection);
			echo "SQL: " . $sql; 
			return false;
			}
		}
}

function redirect($url) {
	header("Location: http://localhost:2001/" . $url);
	die();
}

function search_table_by_id($table_name, $id) {

	$sql = "SELECT description FROM " . $table_name . " WHERE id = '" . $id . "'";

//	echo $sql;

	$result = query_or_die_trying($sql);

	$line = mysqli_fetch_assoc($result);

	if ($line)
		$name = $line["description"];
	else
		$name = "ERROR";

	
	
	return $name;
}

function context_name($id) {

	$name = search_table_by_id("contexts", $id);

	return $name;
	
}


function category_name($id) {

	$name = search_table_by_id("categories", $id);

	return $name;
	
}

function show_task_edit_form($id){
	echo "<a href=\"edit_task.php?id=" . $id . "\">Editar</a>"; 
}

?>
