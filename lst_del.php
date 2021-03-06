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

			function __construct($nome, $email, $id, $comite,$login,$senha){
				$this->string = "<tr><td>".$nome."</td><td>".$email."</td><td>".$login."</td><td>".$senha."</td><td><a href='alterar.php?id=$id'>Alterar</a></td><td><a href='controle.php?id=$id&funcao=deletar_delegacao&idcomite=$comite'>Deletar</a></td></tr>";
				$this->html = $this->string;
			}
		}

		$comite = (int)$_REQUEST['idcomite'];
		$comite2 = $_REQUEST['idcomite'];

		$sql = "SELECT nome,email,id,login,senha FROM delegacao WHERE fk_comite_id=$comite;";
		
		$result = pg_query($conn,$sql);

		$comites = strval($comite);

		$nomes = [];
		$emails = [];
		$ids = [];
		$logins = [];
		$senhas = [];
		
		while ($row = pg_fetch_assoc($result)) {
		    $nomes[] = $row['nome'];
		    $emails[] =  $row['email'];
		    $ids[] = strval($row['id']);
		    $logins[] = $row['login'];
		    $senhas[] = $row['senha']; 
		}
		
		$tbdelegacoes = [];
		
		for($i=0; $i < count($nomes); $i++){
			$nome = $nomes[$i];
			
			$email = $emails[$i];

			$id = $ids[$i];

			$login = $logins[$i];

			$senha = $senhas[$i];
			
			$linha = new create_item($nome,$email,$id,$comites,$login,$senha);
			
			$tbdelegacoes[] = $linha;
		}
		$resultado = "";
	
		foreach($tbdelegacoes as $i){
			$resultado .= $i->html;
		}
		
	?>
</head>
<body>

	<div class="navbar-fixed">
        <nav>
            <div class="nav-wrapper green accent-3">
                <!-- Logo -->
                <a href="pag_comite.php?idcomite=<?php echo $comite2;?>" >Voltar</a>

                <ul id="navbar-items" class="right hide-on-med-and-down">
                    <li>
                        <a class="dropdown-trigger" data-target="dropdown-menu" href="#">
                    		<?php echo $nome2;?> <i class="material-icons right">account_circle</i>
                        </a>
                    </li>
                </ul>

                <!-- Dropdown -->
                <ul id="dropdown-menu" class="dropdown-content">
                    <li><a href="index.php">Sair</a></li>
                </ul>
            </div>
        </nav>
    </div>

	<table>
		<thead>
			<tr>
				<th>Nome da Delega????o</th>
				<th>Email do delegado</th>
				<th>Login da Delega????o</th>
				<th>Senha do delegado</th>
			</tr>
		</thead>
		<tbody>
			<?php echo $resultado; ?>
		</tbody>
	</table>
</body>
<script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
</html>