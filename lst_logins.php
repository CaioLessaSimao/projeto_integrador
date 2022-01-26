<html>
<head>
	<title>Lista de logins</title>
	<?php 
	require_once "connection.php";	

	class create_item {
		public $nome;
		public $email;
		public $string;
		public $html;

		function __construct($nome,$login,$senha){
			$this->string = "<tr><td>".$nome."</td><td>".$login."</td><td>".$senha."</td>";
				$this->html = $this->string;
		}
	}

	$comite = (int)$_REQUEST['idcomite'];
	$comite2 = $_REQUEST['idcomite'];

	$sql = "SELECT nome,login,senha FROM diretor WHERE fk_comite_id=$comite;";
	
	$result = pg_query($conn,$sql);

	$nomes = [];
	$logins = [];
	$senhas = [];
		
	while ($row = pg_fetch_assoc($result)) {
	    $nomes[] = $row['nome'];
	    $logins[] = $row['login'];
	    $senhas[] = $row['senha']; 
	}
		
	$tbdiretores = [];
		
	for($i=0; $i < count($nomes); $i++){
		$nome = $nomes[$i];
		
		$login = $logins[$i];

		$senha = $senhas[$i];
			
		$linha = new create_item($nome,$login,$senha);
			
		$tbdiretores[] = $linha;
	}
	$resultado = "";
	
	foreach($tbdiretores as $i){
		$resultado .= $i->html;
	}
	?>
</head>
<body>
	<nav>
    	<div class="nav-wrapper green accent-3">
      		
      		<a href="index.php" class="brand-logo">PSGD</a>
      		
      		<ul id="nav-mobile" class="right hide-on-med-and-down">
        		
      		</ul>
    	
    	</div>
  	</nav>
  	<h2>Veja aqui os logins dos diretores</h2>
  	<table>
		<thead>
			<tr>
				<th>Nome do diretor</th>
				<th>Login da diretor</th>
				<th>Senha do diretor</th>
			</tr>
		</thead>
		<tbody>
			<?php echo $resultado; ?>
		</tbody>
	</table>

	<button type="button" onclick="window.location.href='index.php?aux=final'">Finalizar</button>

</body>
</html>