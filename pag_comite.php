<html>
<head>
	<title>Página do comitê</title>

	<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
	
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
	
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<style type="text/css">
		div{
		    width: 100%;
		    height: 560px;
		}
		.imagem_principal {
		    background: url(teste2.jpg) no-repeat center center;
		    -webkit-background-size: cover;
		    -moz-background-size: cover;
		    -o-background-size: cover;
		    background-size: cover;
		    display: flex;
		    flex-direction: column;
			justify-content: center;
			align-items: center;		    
		}
		.imagem_del{
		    background: url(teste3.jpg) no-repeat center center;
		    -webkit-background-size: cover;
		    -moz-background-size: cover;
		    -o-background-size: cover;
		    background-size: cover;
		    display: flex;
		    flex-direction: column;
			justify-content: center;
			align-items: center;
		}

		.imagem_dpo{
		    background: url(teste4.jpg) no-repeat center center;
		    -webkit-background-size: cover;
		    -moz-background-size: cover;
		    -o-background-size: cover;
		    background-size: cover;
		    display: flex;
		    flex-direction: column;
			justify-content: center;
			align-items: center;
			
		}

		.imagem_sim{
		    background: url(teste5.jpg) no-repeat center center;
		    -webkit-background-size: cover;
		    -moz-background-size: cover;
		    -o-background-size: cover;
		    background-size: cover;
		    display: flex;
		    flex-direction: column;
			justify-content: center;
			align-items: center;
		}
		
		.imagem_principal div{
			z-index: 0;
		}

		.quadro{
		  z-index: 2;
		  background-color: red;
		}
	</style>
	<?php 
		require_once "connection.php";
		if(isset($_REQUEST['idcomite'])){
			$comite = (int)$_REQUEST['idcomite'];
			$comite2 = $_REQUEST['idcomite']; 
			$sql = "SELECT nome,tema FROM comite WHERE id=$comite";
			$query = pg_query($conn, $sql);
			$array = pg_fetch_array($query);
			$nome = $array[0];
			$tema = $array[1];	
		}
		

	?>
</head>
<body>
	<nav>
    	<div class="nav-wrapper green accent-3">
      		
      		<a href="index.php" class="brand-logo">PSGD</a>
      		
      		<ul id="nav-mobile" class="right hide-on-med-and-down">
        		<li><a class="dropdown-trigger" href="#!" data-target="dropdown1"><i class="material-icons right">account_circle</i></a></li>
      		</ul>
    	
    	</div>
  	</nav>
		<div class="imagem_principal">
			<h2><?php echo $nome; ?></h2>
			<h4><?php echo $tema; ?></h4>
		</div>

		<div class="imagem_dpo">
	  		<a href="lst_dpo.php?idcomite=<?php echo $comite2; ?>">Lista de DPOs</a>
		</div>
		
		<div class="imagem_del">
	  		<a href="lst_del.php?idcomite=<?php echo $comite2; ?>">Lista de delegações</a>
		</div>

		<div class="imagem_sim">
	  		<h2>Iniciar Simulação</h2>
		</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
</body>
</html>