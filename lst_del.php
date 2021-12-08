<html>
<head>
	<title>Lista de delegados</title>
	<?php
		require_once "connection.php";
		
		class create_item {
			public $nome;
			public $email;
			public $string;
			public $html;

			function __construct($nome, $email, $id){
				$this->string = "<tr><td>".$nome."</td><td>".$email."</td><td><a href='alterar.php?id=$id?funcao=alterar'>Alterar</a></td><td><a href='deletar.php?id=$id?funcao=deletar'>Deletar</a></td></tr>";
				$this->html = $this->string;
			}
		}

		$comite = (int)$_REQUEST['idcomite'];
		$sql = "SELECT nome,email,id FROM delegacao WHERE fk_comite_id=$comite;";
		
		$result = pg_query($conn,$sql);

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
			
			$linha = new create_item($nome,$email,$ids);
			
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
</html>