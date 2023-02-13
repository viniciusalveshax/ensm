
<?php 

require "header_html.php";
require "utils.php";

$id = $_GET["id"];

$sql = "SELECT * FROM tasks WHERE id = " . $id; 

//echo $sql;

$result = query_or_die_trying($sql);

//echo "Chegou aqui";

$task = mysqli_fetch_assoc($result);

?>

<h2>Acompanhar tarefa</h2>

<form action="followup_task2.php" method="post">

<input type="hidden" value="<?php echo $task['id'] ?>" name="id" />

<p>Data de acompanhamento</p>
<input type="text" value="<?php echo $task['followup_date'] ?>" name="followup_date" />

<p>Descrição</p>
<input type="text" value="<?php echo $task['description'] ?>" name="description" />

<p>
<input type="submit" value="Atualizar" />
</p>

</form>

<?php

require "footer_html.php";

?>

