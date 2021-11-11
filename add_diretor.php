<html>
	
	<head>
	
	    <title>Adicionar delegacoes</title>
        
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">

        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">

        <style>

            .salvar{

                position: absolute;
                right: 10px;

            }
            
           input::placeholder{
                color: grey;
            }

        </style>
    
        <script>

            /* Armazenando as delegaçoes e os nomes pra exibir */
            var delegacoes = [];

            /* Função que adiciona as delegações no array, que em si é um array de arrays que contem o nome e a sigla*/
            function adicionar(){
                
                
                var nome = document.getElementById("nome").value;
                var sigla = document.getElementById("sigla").value;

                document.getElementById("nome").value = "";
                document.getElementById("sigla").value = "";

                console.log(nome);
                console.log(sigla);

                var linha = new create_item(nome,sigla);

                delegacoes.push(linha);
                var resultado = "";
                
                
                for(var i of delegacoes){
                    console.log(delegacoes[0].nome);    
                    resultado += i.html;
                    console.log(i.html);
                }
               console.log(resultado);
               document.getElementById("corpo_tabela").innerHTML = resultado;               

            }
            
            function create_item(nome,sigla){
                this.nome = nome;
                this.sigla = sigla;
                var string = "<tr><td>"+sigla+"</td><td>"+nome+"</td></tr>";
                this.html = string;
        }           

        </script>
        
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


        <div class="row">
            
        <form action="controle.php?id_diretor=<?php echo $_REQUEST['idcomite'];?>" class="col s12" method="POST">  
                  
                
            <div class="input-field col s4">
                <input id="nome1" type="text">
				<label for="nome1"> Insira o nome do diretor geral</label>
            </div>
                
            <div class="input-field col s4">
                <input id="email" type="text">
                <label for="email"> Insira o email do diretor geral</label>	
            </div>
            <input type = 'hidden' name = 'funcao' value = 'inserir_diretor'/>
            <div class="input-field col 24">
                <input type = 'submit' name="btn_inserir_diretor" class="btn" value = 'Cadastrar'></input>
            </div>
                
            
        </form>
        </div>   
            
            <div class="col s12">
                <h6>Delegações:</h6>
                <table>
                    <thead>
                        <tr>
                            <th>Sigla</th>
                            <th>Nome da delegação</th>
                        </tr>
                        <tbody id="corpo_tabela"> 
                            
                        </tbody>
                    </thead>
                </table>
            </div>

	</body>
<script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
        
</html>