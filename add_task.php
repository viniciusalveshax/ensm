
<?php 

require "header_html.php";
require "utils.php";

$sql = "SELECT * FROM categories"; 

$result = query_or_die_trying($sql);

echo "Chegou aqui";

?>

<h2>Adicionar objetivo</h2>

<form action="add_objective2.php" method="post">

<p>Descrição</p>
<input type="text" placeholder="Descreva o objetivo" name="description" />

<p>Categoria</p>
<?php

if ($result) {

	//echo "Resultados...";
	
	$count = mysqli_num_rows($result);
	
	echo "Qtdade de categorias: " . $count;

	echo "<select name=\"category_id\">";

	//$line = mysqli_fetch_assoc($result);

	while ($line = mysqli_fetch_assoc($result)) {
		echo "<option value=" . $line['id'] . ">" . $line['description'] . "</option>";
		//echo "oi";
	}

}

echo "</select>";

$sql = "SELECT * FROM objectives"; 

$result = query_or_die_trying($sql);

if ($result) {

	$count = mysqli_num_rows($result);
	
	echo "<br />Qtdade de objetivos: " . $count;

	//$line = mysqli_fetch_assoc($result);
	
	echo "<select name=\"objective_id\">";

	while ($line = mysqli_fetch_assoc($result)) {
		echo "<option value=" . $line['id'] . ">" . $line['description'] . "</option>";
		//echo "oi";
	}
	
	echo "</select>";

}

?>

<p>
<input type="submit" value="Cadastrar" />
</p>

</form>



<?php

require "footer_html.php";

?>

