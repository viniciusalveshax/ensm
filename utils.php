
<?php

require "connection.php";

function query_or_die_trying($sql) {
	//TODO Test agains SQL Injection!
	$connection = connect();

	if (!$connection)
		die("<br />Não encontrou a conexão. Erro fatal. Encerrando ...");
	else	{
		$result = mysqli_query($connection, $sql);
		return $result;
		}
}

?>
