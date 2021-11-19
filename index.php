<html>
<head>
	<title>PSGD</title>
	
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
		.row{
			display: none;
			background-color: #00897b;
			position: absolute;
			width: 500px;
			padding-bottom: 25px;
			border: 4px solid gray;
			transition: top 0ms ease-in-out 200ms
						opacity 200ms ease-in-out 0ms
						transform 200ms ease-in-out 0ms;
		}
		.titulo{
			color: white;	 
		}

	</style>

	<script type="text/javascript">
		/*função que abre a div baseado no id*/
		function openDiv(login){
  			document.getElementById(login).style.display = "block";
  			document.body.style.backgroundColor = "rgba(0,0,0,0.4)";
		}
		/*função que fecha a div*/
		function closeDiv(login){
			document.getElementById(login).style.display = "none";
			document.body.style.backgroundColor = "white";
		}

		function validar_dir(){
			<?php 
				if(isset($_REQUEST['dir_usuario']) && isset($_REQUEST['dir_senha'])){
            		$login = $_REQUEST['dir_usuario'];
            
            		$senha = $_REQUEST['dir_senha'];
            
		            $sql8 = "SELECT login,senha FROM diretor"; 

		            $result8 = pg_query($conn,$sql8);

		            $array = pg_fetch_array($result8);

		            echo $array[0];

		            for($i=0;$i<count($array)-1;$i+=2){
		                $loginbd = $array[$i];

		                $senhabd = $array[$i+1];

		                if($login == $loginbd && $senha == $senhabd){
		                    header("Location: pag_comite.php");
		                }
		            }
		        }
		    ?>
		}





	</script>
	<?php 
	$final = $_REQUEST['final'];
	if($final == "1"){
		echo  "<script>alert('Os campos não podem ficar em branco!');</script>";
	}

	?>

</head>
<body>
	<div class="container">
		<div class='center-align'>
				<h1>PSGD</h1>
				<h4>(Plataforma de Simulação de Geopolítica Digital)</h4>
				<form  action = "controle.php" method = "POST">
					<input type = 'hidden' name = 'funcao' value = 'criar_comite'/>
					<input type = 'submit' name="btn_criar_comite" class="btn" value = 'Criar Comitê'></input>
				</form>
				<button type = 'button' id="btn_options" class="btn" onclick = "openDiv('login_delegado')">Entrar como delegado</button>
				<button type = 'button' id="btn_options" class="btn" onclick = "openDiv('login_diretor')">Entrar como diretor</button>
			</div>
			
			<div id="login_delegado" class="row">
				<form class="col s12">	
					<h4 class="titulo">Logar como delegado</h4>
				
				<div class="input-field col s12">
          			<input id="del_usuario" type="text" class="validate">
          			<label for="del_usuario">Usuário</label>
          		</div>
          		
          		<div class="input-field col s12">
          			<input id="del_senha" type="password" class="validate">
          			<label for="del_senha">Senha</label>
        		</div>
        		
        		<button id="botao" class="btn waves-effect waves-light col s3 right green accent-3" type="submit">Entrar</button>
        		<button id="botao" class="btn waves-effect waves-light col s3 top-right green accent-3" onclick="closeDiv('login_delegado')">Cancelar</button>
        	</form>
			</div>
			
			<div id="login_diretor" class="row">
				<form class="col s12">	
					<h4 class="titulo">Logar como diretor</h4>
				
				
				<div class="input-field col s12">
          			<input name="dir_usuario" type="text" class="validate">
          			<label for="dir_usuario">Usuário</label>
          		</div>
          		
          		<div class="input-field col s12">
          			<input name="dir_senha" type="password" class="validate">
          			<label for="dir_senha">Senha</label>
        		</div>
        		
        		<input type = "hidden" name = "funcao" value = "logar_dir">
        		<button id = "botao" class = "btn waves-effect waves-light col s3 right green accent-3" onclick="validar_dir()">Entrar</button>
        		<button id = "butn" class = "btn waves-effect waves-light col s3 top-right green accent-3" onclick = "closeDiv('login_diretor')">Cancelar</button>
        	</form>
        		
        	</div>

        	
	</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
</body>
</html>
