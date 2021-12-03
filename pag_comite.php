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
		.imagem_principal{
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
		
		h1{
			color: white;
		}

		h4{
			color: white;
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
        		<li><a href="#"><i class="material-icons right">account_circle</i></a></li>
      		</ul>
    	
    	</div>
  	</nav>
	<div class="imagem_principal">
			<h2><?php echo $nome; ?></h2>
			<h4><?php echo $tema; ?></h4>
	</div>

	<div class="" id="imagem_dpo">
  		<h2>Lista de DPOs</h2>
	</div>
	
	<div class="imagem_del">
  		<h2>Iniciar Simulação</h2>
	</div>

	<div class="imagem_sim">
  		<h2>Iniciar Simulação</h2>
	</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
</body>
</html>