
<?php 

require "header_html.php";
require "utils.php";

$sql = "SELECT * FROM categories"; 

$result = query_or_die_trying($sql);

?>

<h2>Adicionar Categoria</h2>

<form action="add_category2.php" method="post">

<input type="text" placeholder="Descreva a categoria" name="description" />

<p>Categoria pai (opcional)</p>
<select name="category_parent">
<option></option>
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

