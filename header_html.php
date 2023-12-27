<?php

if (!session_id() )
	$session_id = session_start();

?>


<html>

<style>

table td {
	border: 1px solid black;
}

.emphasis_high {
	color: red;
}

.emphasis_medium {
	color: orange;
}

.emphasis_low {
	color: blue;
}

h3 {
	color: red;
}

ul.footer li { 
	display: inline;
}

.odd {
	background-color: rgb(240,240,240);
}

</style>


<body>


<h1>Eu não suporto mais: outro software de todolist</h1>


<?php

// Gerado com ajuda de https://manytools.org/hacker-tools/convert-images-to-ascii-art/go/
include "ascii_art.php";

?>

<hr />
<ul class="footer">
<li>Adicionar</li>
<li><a href="add_category.php">Categoria</a></li>
<li><a href="add_context.php">Contexto</a></li>
<li><a href="add_objective.php">Objetivo</a></li>
<li><a href="add_task.php">Tarefa</a></li>

<li>Listar</li>
<li><a href="list_categories.php">Categorias</a></li>
<li><a href="list_contexts.php">Contextos</a></li>
<li><a href="list_objectives.php">Objetivos</a></li>
<li><a href="list_tasks.php">Tarefas (todas)</a></li>
<?php 
	$day = date('w');
	echo "<li><a href=\"list_tasks.php?day=" . $day . "\">Tarefas (hoje)</a></li>";
?>

<li>Outras</li>
<li><a href="review_daily.php">Revisão diária</a></li>
<li><a href="review.php">Revisão semanal</a></li>
<li><a href="review_past.php">Semanas anteriores</a></li>

</ul>

<?php

if (isset($_SESSION["msg"])) {
	echo "<h3>Sessão: " . $_SESSION["msg"] . "</h3>";
	unset($_SESSION["msg"]);
	}
	

?>

