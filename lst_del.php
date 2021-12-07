<html>
<head>
	<title>Lista de delegados</title>
	<?php
		require_once "connection.php";
		
		$comite = (int)$_REQUEST['idcomite'];
		$sql = "SELECT nome, email FROM delegacao WHERE fk_comite_id=$comite;";
		
		$result = pg_query($conn,$sql);
		
		$array = pg_fetch_array($result);
		
		$tbdelegacoes = [];
		
		for($i=0; $i < count($array)-1; $i+=2){
			$nome = $array[$i];
			
			$email = $array[$i+1];
			
			$linha = new create_item($nome,$email);
			
			$tbdelegacoes[] = $linha;
		}
		$resultado = "";
		/*
		foreach($tbdelegacoes as $i){
			$resultado .= $i->html;
		}
	*/
		function create_item($nome,$email){
			$this->nome = $nome;
			$this->email = $email;
			$string = "<tr><td>".$nome."</td><td>".$email."</td><td></tr";
			$this->html = $string;
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
			<p>jorge</p>
		</tbody>
	</table>
</body>
</html>