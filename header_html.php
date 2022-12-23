<html>
<body>


<h1>Eu não aguento mais: outro software de todolist</h1>


<?php

if ($_SESSION['msg']) {
	echo "<h2>" . $_SESSION['msg'] . "</h2>";
	$_SESSION['msg'] = '';
	}

?>

