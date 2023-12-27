
<?php 

require "header_html.php";
require "utils.php";

$sql = "SELECT * FROM objectives WHERE hide=0"; 

$result = query_or_die_trying($sql);

?>

<h2>Adicionar Meta</h2>

<form action="add_goal2.php" method="post">

<p>Objetivo relacionado</p>
<select name="objective_id">
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
<input type="text" placeholder="Descreva a meta" name="description" />

<br />Data limite
<input type="text" name="limit_date" />

<p>
<input type="submit" value="Cadastrar" />
</p>

</form>



<?php

require "footer_html.php";

?>

