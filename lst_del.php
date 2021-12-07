<html>
<head>
	<title>Lista de delegados</title>
	<?php
		require_once "connection.php";
		
		class create_item($nome,$email){
			public $nome;
			public $email;
			public $string;
			public $html;

			function __construct($nome, $email){
				$this->string = "<tr><td>".$nome."</td><td>".$email."</td><td></tr";
				$this->html = $this->string;
			}
		}

		$comite = (int)$_REQUEST['idcomite'];
		$sql = "SELECT nome, email FROM delegacao WHERE fk_comite_id=$comite;";
		
		$result = pg_query($conn,$sql);
		
		$array = pg_fetch_array($result);
		
		$tbdelegacoes = [];
		
		for($i=0; $i < count($array)-2; $i+=2){
			$nome = $array[$i];
			
			$email = $array[$i+1];
			
			$linha = new create_item($nome,$email);
			
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