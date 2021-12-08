<html>
<head>
	<title>Alterar delegação</title>
	
	<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">

    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">

    <?php

    	require_once "connection.php";

    	$id = (int)$_REQUEST['id'];

    	$nome = $_REQUEST['nome'];

    	$email = $_REQUEST['email'];

    	$sql = "UPDATE delegacao SET nome='$nome', email='$email' WHERE id=$id;";

    	$result = pg_query($conn,$sql);

    ?>
</head>
<body>
	<form action="alterar.php" method="POST">
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
			<label for="email">Escreva a sigla da delegação</label>
		</div>
	</form>
</body>
<script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
</html>