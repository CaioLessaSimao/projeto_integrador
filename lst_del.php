<html>
<head>
	<title>Lista de delegados</title>

	<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">

    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">

	<?php
		require_once "connection.php";
		
		class create_item {
			public $nome;
			public $email;
			public $string;
			public $html;

			function __construct($nome, $email, $id, $comite){
				$this->string = "<tr><td>".$nome."</td><td>".$email."</td><td><a href='alterar.php?id=$id?idcomite=$comite'>Alterar</a></td><td><a href='deletar.php?id=$id?funcao=deletar'>Deletar</a></td></tr>";
				$this->html = $this->string;
			}
		}

		$comite = (int)$_REQUEST['idcomite'];
		$sql = "SELECT nome,email,id FROM delegacao WHERE fk_comite_id=$comite;";
		
		$result = pg_query($conn,$sql);

		$comites = strval($comite);

		$nomes = [];
		$emails = [];
		$ids = [];
		
		while ($row = pg_fetch_assoc($result)) {
		    $nomes[] = $row['nome'];
		    $emails[] =  $row['email'];
		    $ids[] = strval($row['id']); 
		}
		
		$tbdelegacoes = [];
		
		for($i=0; $i < count($nomes); $i++){
			$nome = $nomes[$i];
			
			$email = $emails[$i];

			$id = $ids[$i];
			
			$linha = new create_item($nome,$email,$id,$comites);
			
			$tbdelegacoes[] = $linha;
		}
		$resultado = "";
	
		foreach($tbdelegacoes as $i){
			$resultado .= $i->html;
		}
		
	?>
</head>
<body>
	<table>
		<thead>
			<tr>
				<th>Nome da Delegação</th>
				<th>Email do delegado</th>
			</tr>
		</thead>
		<tbody>
			<?php echo $resultado; ?>
		</tbody>
	</table>
</body>
<script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
</html>