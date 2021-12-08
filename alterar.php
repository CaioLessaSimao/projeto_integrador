<html>
<head>
	<title>Alterar delegação</title>
	
	<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">

    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">

    <?php

    	$id = $_REQUEST['id'];
    	$comite = $_REQUEST['idcomite'];

    ?>
</head>
<body>
	<form action="controle.php?funcao=alterar?idDelegacao=<?php echo $id;?>?idcomite=<?php echo $comite; ?>" method="POST">
		<div class="input-field">
			<input type="text" name="nome">
			<label for="nome">Escreva o nome da delegação</label>
		</div>

		<div class="input-field">
			<input type="text" name="sigla">
			<label for="sigla">Escreva a sigla da delegação</label>
		</div>

		<div class="input-field">
			<input type="text" name="email">
			<label for="email">Escreva o email da delegação</label>
		</div>
		<input type="submit" name="submit" value="Alterar">
	</form>
</body>
<script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
</html>