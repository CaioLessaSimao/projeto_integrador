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
            var tbdelegacoes = [];

            var delegacoes = [];

            /* Função que adiciona as delegações no array, que em si é um array de arrays que contem o nome e a sigla*/
            function adicionar(){
                
                var delegacao = [];
                
                var nome = document.getElementById("nome").value;
                var sigla = document.getElementById("sigla").value;
                var email = document.getElementById("email").value;

                delegacao.push(sigla);
                delegacao.push(nome);
                delegacao.push(email);

                delegacoes.push(delegacao);

                document.getElementById("nome").value = "";
                document.getElementById("sigla").value = "";
                document.getElementById("email").value = "";

                console.log(nome);
                console.log(sigla);

                var linha = new create_item(nome,sigla,email);

                tbdelegacoes.push(linha);
                var resultado = "";
                
                
                for(var i of tbdelegacoes){
                    console.log(tbdelegacoes[0].nome);    
                    resultado += i.html;
                    console.log(i.html);
                }
               console.log(resultado);
               document.getElementById("corpo_tabela").innerHTML = resultado;               

            }
            
            function create_item(nome,sigla,email){
                this.nome = nome;
                this.sigla = sigla;
                this.email = email;
                var string = "<tr><td>"+sigla+"</td><td>"+nome+"</td><td>"+email+"</td></tr>";
                this.html = string;
            } 

            function finalizar(){
                window.location.href = "controle.php?delegacoes="+delegacoes+"&comite="+<?php echo $_REQUEST['idcomite'];?>+"&funcao=add_del";
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
            
        <form class="col s12">  
                  
                
            <div class="input-field col s12">
                <input id="nome" type="text" class="validate" >
				<label for="nome"> Insira o nome da delegação</label>
            </div>
                
            <div class="input-field col s12">
                <input id="sigla" type="text" class="validate">
				<label for="sigla"> Insira a sigla da delegação</label>
            </div>

            <div class="input-field col s12">
                <input id="email" type="text" class="validate">
                <label for="email"> Insira o email do delegado</label>
            </div>
            
            <button class = "btn" type = "button" onclick="adicionar()">Adicionar</button> 
            <button class = "btn" type = "button" onclick="finalizar()">Finalizar</button> 
        
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
<script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js">
    
</script>
</html>