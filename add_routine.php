
<?php 

require "header_html.php";
require "utils.php";

$sql = "SELECT * FROM goals"; 

$result = query_or_die_trying($sql);

?>

<h2>Adicionar Rotina</h2>

<form action="add_routine2.php" method="post">

<p>Meta relacionada</p>
<select name="goal_id">
<option></option>
<?php

if ($result) {

	while ($line = mysqli_fetch_assoc($result)) {
		echo "<option value=" . $line['id'] . ">" . $line['description'] . "</option>";
		//echo "oi";
	}

}


?>
</select>

<br />Descrição
<input type="text" placeholder="Descreva a rotina" name="description" />

<br>Tipo
<select name="kind">
	<option>Diária</option>
	<option>Semanal</option>
	<option>Mensal</option>
	<option>Trimestral</option>
	<option>Semestral</option>
</select>

<br />Quantidade de vezes
<input type="text" name="repetitions" />


<p>
<input type="submit" value="Cadastrar" />
</p>


</form>



<?php

require "footer_html.php";

?>

