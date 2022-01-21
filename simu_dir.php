<html>
<head>
	<title>Simulação</title>

	<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
	
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
	
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">

	<style type="text/css">
		/*
		.container {
			width: 100vw;
			height: 80vh;
			display: flex;
			flex-direction: column;
			justify-content: center;
			align-items: center;
			line-height: 0px;
		}
		
		*/
		#lst{
			border: solid green;
			background-color: black;
			float: left;
			z-index: 2;
			width: 350px;
			height: 100%;
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

                <ul id="navbar-items" class="right hide-on-med-and-down">
                    <li>
                        <a class="dropdown-trigger" data-target="dropdown-menu" href="#">
                    		<?php echo $nome2;?> <i class="material-icons right">account_circle</i>
                        </a>
                    </li>
                </ul>

                <!-- Dropdown -->
                <ul id="dropdown-menu" class="dropdown-content">
                    <li><a href="pag_comite.php?idcomite=<?php echo $comite2;?>">Sair da simulação</a></li>
                </ul>
            </div>
        </nav>
    </div>

    <div class="col s6" id="lst">
		<p>Lista de oradores</p>
	</div>

	<div class="container">
		<div class="center-align">
			<h2><?php echo $nome; ?></h2>
			<h4>(<?php echo $tema; ?>)</h4>

			<p>Discursando agora: </p>
			<span id="counter">00:00:00</span><br>
			<input type="button" class="btn" value="Parar" onclick="para();"> <input type="button" class="btn" value="Iniciar" onclick="inicia();"> <input type="button" class="btn" value="Zerar" onclick="zera();">

		</div>
	</div>

	

	<div class="fixed-action-btn">
  		<a class="btn-floating btn-large red">
    		<i class="large material-icons">mode_edit</i>
  		</a>
  		
  		<ul>
		    <li><a class="btn-floating red"><i class="material-icons">insert_chart</i></a></li>
		    <li><a class="btn-floating yellow darken-1"><i class="material-icons">format_quote</i></a></li>
		    <li><a class="btn-floating green"><i class="material-icons">publish</i>asasas</a></li>
		    <li><a class="btn-floating blue"><i class="material-icons">attach_file</i></a></li>
  		</ul>
	</div>
</body>
<script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
<script type="text/javascript">
	document.addEventListener('DOMContentLoaded', function() {
    const elems = document.querySelectorAll('.fixed-action-btn');
    const instances = M.FloatingActionButton.init(elems, {
      direction: 'left'
    });
  });

	const elemsDropdown = document.querySelectorAll(".dropdown-trigger");
	const instancesDropdown = M.Dropdown.init(elemsDropdown, {
    	coverTrigger: false
	});

	function formatatempo(segs) {
		min = 0;
		hr = 0;
		/*
		if hr < 10 then hr = "0"&hr
		if min < 10 then min = "0"&min
		if segs < 10 then segs = "0"&segs
		*/
		while(segs>=60) {
		if (segs >=60) {
		segs = segs-60;
		min = min+1;
		}
		}

		while(min>=60) {
		if (min >=60) {
		min = min-60;
		hr = hr+1;
		}
		}

		if (hr < 10) {hr = "0"+hr}
		if (min < 10) {min = "0"+min}
		if (segs < 10) {segs = "0"+segs}
		fin = hr+":"+min+":"+segs
		return fin;
	}
	var segundos = 0; //inicio do cronometro
	function conta() {
		segundos++;
		document.getElementById("counter").innerHTML = formatatempo(segundos);
	}

	function inicia(){
		interval = setInterval("conta();",1000);
		let ajax = new XMLHttpRequest();
		ajax.open("post", "controle.php");
	}

	function para(){
		clearInterval(interval);
	}

	function zera(){
		clearInterval(interval);
		segundos = 0;
		document.getElementById("counter").innerHTML = formatatempo(segundos);
	}
</script>
</html>