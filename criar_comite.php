<html>
	
	<head>
	
	    <title>PSGD Criar Comitê</title>
        
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">

        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        
        <style>

            .btn_proximo {

                position: absolute;
                top: 10px;
                right: 10px;

            }

            .data_sim{

                position: absolute;
                bottom: 439px;
                right: 0px;
                
            }

            label{
                color: black;
				
            }

            #fin{
                display: none;
            }

            #ad{
                display: none;
            }

        </style>
    

	</head>
	<body>

    
	<nav>
    	<div class="nav-wrapper green accent-3">
      		
      		<a href="home.html" class="brand-logo">PSGD</a>
      		
      		<ul id="nav-mobile" class="right hide-on-med-and-down">
        		<li><a href="#"><i class="material-icons right">account_circle</i></a></li>
      		</ul>
    	
    	</div>
  	</nav>


    <div class="container">
        
        <div class = "row">
            <h2 class="light" >Criar comite</h2>
		    <form class = "col s12" name="criar_comite" action = 'controle.php' method="post">
				<input type = 'hidden' name = 'funcao' value = 'inserir_comite'/>
                <div class = "col s6">
					<label for="orgao">Orgao:</label>
					<input type="text" id = "orgao"><br/><br/>
                </div>
                
				<div class = "col s6">
					<label for="tema">Tema:</label>
					<input type="text" id = "tema"><br/><br/><br/>
				</div>
				
				<div class = "col s6">
					<label for="desc">Descrição:</label>
					<input type="text" id = "desc"><br/><br/>
                </div>
                
				<div class = "col s6">
					<label for="blog">Link do Blog</label>  
					<input type="text" id = "blog"><br/><br/>
                </div>
				
				<div class = "col s12" >
				</div>
		    </form>
           <a href="#meu-modal" class="btn waves-effect waves-light modal-trigger">Cadastrar</a>
		</div> 
    </div>
    <div id="meu-modal" class="modal"> <!-- bottom-sheet -->
        <div class="row modal-content">
            <h4 id="title">Cadastrar diretor geral</h4>
            
            <div class=input-field col s12>
                <input type="text" name="nome" id="dir_nome">
                <label for="nome">Insira o nome do diretor</label>
            </div>

            <div class=input-field col s12>
                <input type="email" name="email" id="dir_email">
                <label for="email">Insira o email do diretor</label>
            </div>
            
            <button id="fin" class="btn" onclick="finalizar()">Finalizar</button>
            <button id="mod" class="btn" type = "button" onclick="adicionar()">Adicionar diretor</button>
            <button id="ad" class="btn" onclick="add_ass()">Adicionar diretor</button>
             
        
        </div>
        
    </div>
    
    </body>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
    <script type="text/javascript">
        const elemsModal = document.querySelectorAll(".modal");
        const instancesModal = M.Modal.init(elemsModal);
        
        var dirs_mtz = []; 
        var comite = [];
        
        
        function adicionar(){
            
            comite.push(document.getElementById("orgao").value);
            comite.push(document.getElementById("tema").value);
            comite.push(document.getElementById("desc").value);
            comite.push(document.getElementById("blog").value);


            var dirG = [];
            dirG.push(document.getElementById("dir_nome").value);
            dirG.push(document.getElementById("dir_email").value);
            dirs_mtz.push(dirG);

            document.getElementById("title").innerHTML = "<h4>Cadastrar diretor assistente</h4>";
            document.getElementById("fin").style.display = "block";
            document.getElementById("mod").style.display = "none";
            document.getElementById("ad").style.display = "block"; 
        }

        function add_ass(){
            var dirAss = [];
            dirAss.push(document.getElementById("dir_nome").value);
            dirAss.push(document.getElementById("dir_email").value);
            dirs_mtz.push(dirAss);

            document.getElementById("dir_nome").value = "";
            document.getElementById("dir_email").value = "";
        }

        function finalizar(){
            console.log(dirs_mtz);
            console.log(comite);

            <?php header("Location: controle.php?idcomite=dirs_mtz"); ?>
        }


    </script>
</html>