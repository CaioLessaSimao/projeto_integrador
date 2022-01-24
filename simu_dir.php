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
			float: left;
			z-index: 2;
			width: 350px;
			height: 100%;
			margin-left: 50px;
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
		<p>Lista de oradores</p><br>
		<div class="fixed-action-btn">
	  		<a data-target="meu-modal" class="btn-floating btn-large red modal-trigger" onclick="sel_del()">
	    		<i class="large material-icons">mode_edit</i>
	  		</a>
		</div>
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

	 <div id="meu-modal" class="modal">
        <div class="row modal-content">
            <h4 id="title">Selecione uma delegação</h4>
            
            <table>
		<thead>
			<tr>
				
				<th>Nome da Delegação</th>
				
			</tr>
		</thead>
		<tbody id="corpo">
			
		</tbody>
	</table>
                        
        
        </div>
        
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

	const elemsModal = document.querySelectorAll(".modal");
    const instancesModal = M.Modal.init(elemsModal);

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
    }

	function para(){
		clearInterval(interval);
	}

	function zera(){
		clearInterval(interval);
		segundos = 0;
		document.getElementById("counter").innerHTML = formatatempo(segundos);
	}

	function sel_del(){
		var data = {action: "sel_del", idcomite: "<?php Print($comite2); ?>"};
	    
	    let ajax = new XMLHttpRequest();

            ajax.open('post', 'msg.php');

            ajax.onreadystatechange = function(){
                if (
                    ajax.readyState == 4
                    && ajax.status >= 200
                    && ajax.status <= 400
                ) {
                    let respostaAjax = JSON.parse(ajax.responseText);

                    // Aqui os dados já foram tratados.
                    // Faça o que quiser com eles:
                    exb_del(respostaAjax);
                }
            }
            var aux = JSON.stringify(data);

            ajax.send(aux);

	}

	function create_item(nome){
		console.log(nome);
		return "<tr><td onclick='add_del("+nome+")'>"+nome+"</td></tr>";
	}


	function add_del(nome){
		document.getElementById("lst").innerHTML += "<p>"+nome+"</p><br>";
	}


	function exb_del(dels){
		

        var c = 0;
        var linha = [];
        var line = "";
        
        while(c<dels.length){
        	line = create_item(dels[c]);
        	console.log(line);
        	linha.push(line);
        	c++;
        }

        var resultado = "";
        var i = 0;
     	while(i<linha.length){
     		resultado += linha[i];
     		i++;
     	}

        document.getElementById('corpo').innerHTML = resultado;
	}

</script>
</html>