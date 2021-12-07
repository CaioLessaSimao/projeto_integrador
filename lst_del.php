<html>
<head>
	<title>Lista de delegados</title>
	<?php
		require_once "connection.php";
		
		function create_item($nome,$email){
			$string = "<tr><td>".$nome."</td><td>".$email."</td><td></tr";
			$html = $string;
		}

		$comite = (int)$_REQUEST['idcomite'];
		$sql = "SELECT nome, email FROM delegacao WHERE fk_comite_id=$comite;";
		
		$result = pg_query($conn,$sql);
		
		$array = pg_fetch_array($result);
		
		$tbdelegacoes = [];
		
		for($i=0; $i < count($array)-1; $i+=2){
			$nome = $array[$i];
			
			$email = $array[$i+1];
			
			$linha = create_item($nome,$email);
			
			$tbdelegacoes[] = $linha;
		}
		$resultado = "";
		/*
		foreach($tbdelegacoes as $i){
			$resultado .= $i->html;
		}
	*/
		
	
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