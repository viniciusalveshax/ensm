
<?php 

require "header_html.php";
require "utils.php";

$sql = "SELECT * FROM contexts"; 

$result = query_or_die_trying($sql);

echo "Chegou aqui";



?>

<h2>Adicionar objetivo</h2>

<form action="add_objective2.php" method="post">

<p>Descrição</p>
<input type="text" placeholder="Descreva o objetivo" name="description" />

<p>Contexto</p>
<select name="context_id">
<?php

if ($result) {

	echo "Resultados...";
	
	$count = mysqli_num_rows($result);
	
	echo $count;

	//$line = mysqli_fetch_assoc($result);

	while ($line = mysqli_fetch_assoc($result)) {
		echo "<option value=" . $line['id'] . ">" . $line['description'] . "</option>";
		//echo "oi";
	}

	}


?>
</select>

<p>
<input type="submit" value="Cadastrar" />
</p>

</form>



<?php

require "footer_html.php";

?>

