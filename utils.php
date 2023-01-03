
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
			mysqli_error($connection);
			return false;
			}
		}
}

function redirect($url) {
	header("Location: http://localhost:2001/" . $url);
	die();
}

?>
