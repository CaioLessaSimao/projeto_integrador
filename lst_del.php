<html>
<head>
	<title>Lista de delegados</title>
</head>
<body>
	<table>
		<?php 
			require_once "connection.php";
			
			if(isset($_REQUEST['idcomite'])){
				$comite = (int)$_REQUEST['idcomite'];
				$sql = "SELECT nome,email FROM delegacao WHERE fk_comite_id=$comite";
				$result = pg_query($conn,$sql);
				$aux = pg_fetch_array($result);
				echo count($aux)."<br>";
				while ($dados = pg_fetch_array($result)):
		?>
		<tr>
			<td><?php echo $dados['nome']; ?></td>
			<td><?php echo $dados['dpo'];?></td>
		</tr>
		<?php 
			endwhile;
			}
		?>
	</table>
</body>
</html>