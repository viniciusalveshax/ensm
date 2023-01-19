<hr />
<h4>Adicionar</h4>
<ul class="footer">
<li><a href="add_category.php">Categoria</a></li>
<li><a href="add_context.php">Contexto</a></li>
<li><a href="add_objective.php">Objetivo</a></li>
<li><a href="add_task.php">Tarefa</a></li>
</ul>

<h4>Listar</h4>
<ul class="footer">
<li><a href="list_categories.php">Categorias</a></li>
<li><a href="list_contexts.php">Contextos</a></li>
<li><a href="list_objectives.php">Objetivos</a></li>
<li><a href="list_tasks.php">Tarefas (todas)</a></li>
<?php 
	$day = date('w');
	echo "<li><a href=\"list_tasks.php?day=" . $day . "\">Tarefas (hoje)</a></li>";
?>
</ul>

</body>
</html>
