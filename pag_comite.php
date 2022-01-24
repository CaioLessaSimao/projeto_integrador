<html>
<head>
	<title>Página do comitê</title>

	<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
	
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
	
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<style type="text/css">
		.container {
			width: 100vw;
			height: 80vh;
			display: flex;
			flex-direction: column;
			justify-content: center;
			align-items: center;
			line-height: 0px;
		}
		.titulo{
			color: white;	 
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

			$sql2 = "SELECT nome FROM diretor WHERE fk_comite_id = $comite;";
			$query2 = pg_query($conn, $sql2);
			$array2 = pg_fetch_array($query2);
			$nome2 = $array2[0];	
		}
		

	?>
</head>
<body>
	
    <div class="navbar-fixed">
        <nav>
            <div class="nav-wrapper green accent-3">
                <!-- Logo -->
                <a href="index.php" class="brand-logo">PSGD</a>
>

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


		
    	<div class="container">
			<div class='center-align'>
				
				<h1><?php echo $nome; ?></h1>
				<h4>(<?php echo $tema; ?>)</h4>
				
				<div class="row">
					<div class="col s12">
						<button type="button" class="btn" onclick="window.location.href='lst_del.php?idcomite=<?php echo $comite2; ?>'">Lista de delegações</button>
						<button type="button" class="btn" onclick="iniciar()">Iniciar simulação</button>						
					</div>		
				</div>
				
				
			</div>
		</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
<script type="text/javascript">
	const elemsDropdown = document.querySelectorAll(".dropdown-trigger");
	const instancesDropdown = M.Dropdown.init(elemsDropdown, {
    	coverTrigger: false
	});

	function iniciar(){
		var data = {action: "iniciar", idcomite: "<?php Print($comite2); ?>"};
	    
	    let ajax = new XMLHttpRequest();

            ajax.open('post', 'msg.php');

            var aux = JSON.stringify(data);

            ajax.send(aux);

			window.location.href='simu_dir.php?idcomite=<?php echo $comite2; ?>';
	}
</script>
</body>
</html>