<?php

if (!session_id() )
	$session_id = session_start();

?>


<html>

<style>

.today {
	color: red;
}

.tomorrow {
	color: orange;
}

h3 {
	color: red;
}

ul.footer li { 
	display: inline;
}
</style>


<body>


<h1>Eu não aguento mais: outro software de todolist</h1>


<?php

// Gerado com ajuda de https://manytools.org/hacker-tools/convert-images-to-ascii-art/go/
include "ascii_art.php";

if (isset($_SESSION["msg"])) {
	echo "<h3>Sessão: " . $_SESSION["msg"] . "</h3>";
	unset($_SESSION["msg"]);
	}
	

?>

