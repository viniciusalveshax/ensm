
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


function show_task_quick_edit_link($id){
	echo "<a href=\"quick_edit_task.php?id=" . $id . "\">Ed. ráp.</a>"; 
}


function show_task_edit_link($id){
	echo "<a href=\"edit_task.php?id=" . $id . "\">Edição completa</a>"; 
}


function show_task_delay_link($id){
	echo "<a href=\"delay_task.php?id=" . $id . "\">Adia 7</a>"; 
}


function show_task_delay_one_day_link($id){
	echo "<a href=\"delay_task_one_day.php?id=" . $id . "\">Adia 1</a>"; 
}



function show_task_done_link($id){
	echo "<a href=\"done_task.php?id=" . $id . "\">Concluir</a>"; 
}

function show_task_followup_link($id){
	echo "<a href=\"followup_task1.php?id=" . $id . "\">Acompanhar</a>"; 
}


function show_task_hide_link($id){
	echo "<a href=\"hide_task.php?id=" . $id . "\">Esconder</a>"; 
}


function show_selected_option($selected_id, $options) {
	$tags = "";
	if ($selected_id == "")
		$option = "selected";
	else
		$option = "";
	$tags = "<option $option></option>";
	foreach($options as $key => $value) {
		if ($key == $selected_id)
			$option = "selected";
		else
			$option = "";
		$tags = $tags . "<option value=\"$key\" $option>$value</option>";
	}
	echo $tags;
}

function array_day_names() {

	$day_names = array(1 => "Segunda", 2 => "Terça", 3 => "Quarta", 4 => "Quinta", 5 => "Sexta", 6 => "Sábado", 7 => "Domingo");
	
	return $day_names;

}

function day2name($day_number){

	$map = array_day_names();
	
	if (array_key_exists($day_number, $map))
		$day_name = $map[$day_number];
	else
		$day_name = "";

	return $day_name;

}

function nullify($value) {
	
	if ($value == "")
		$ret_val = "NULL";
	else
		$ret_val = "\"$value\"";
		
	return $ret_val;
}

?>
