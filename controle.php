<?php
	require_once  "connection.php";
    
    $oper = $_REQUEST['funcao'];

    if($oper == "criar_comite"){
        header("Location: criar_comite.html");
    }

    if($oper == 'inserir_comite'){
        $orgao = "a";
        $tema = "a";
        $desc = "a";
        $blog = "a";
        $logo = "test";
        $arrayComite;
        $arrayDiretores;

        if (isset($_REQUEST['comite']) && isset($_REQUEST['diretores'])){
            $arrayComite = explode(",",$_REQUEST['comite']);
            
            $orgao =$arrayComite[0];
            $tema = $arrayComite[1];
            $desc = $arrayComite[2];
            $blog = $arrayComite[3];


            $arrayDiretores = explode($_REQUEST['diretores']);

            
            if(empty($orgao) || empty($tema) || empty($desc) || empty($blog)){
                echo  "<script>alert('Existem campos vazios!');</script>";
                header("Location: criar_comite.html");
            
            }
            else if(ctype_space($orgao) || ctype_space($tema) || ctype_space($desc) || ctype_space($blog)){
                echo  "<script>alert('Os campos não podem ficar em branco!');</script>";
                header("Location: criar_comite.html");
            }
           
            $sql = "INSERT INTO comite (nome, tema, descricao, link_blog, logo) VALUES ('$orgao', '$tema', '$desc', '$blog', '$logo');";
            
            $result = pg_query($conn, $sql);
            
            $sql2 = "SELECT id, nome FROM comite WHERE tema = '$tema';";

            $result2 = pg_query($conn, $sql2);
            
            $comite = pg_fetch_array($result2);

            $id_comite = (int)$comite[0];
            $nome_comite = $comit[1];
            
            $arrayDiretores = explode($_REQUEST['diretores']);
            echo $arrayDiretores[0];
            
            /**for($i = 0; $i <count($arrayDiretores) - 2; $i += 2){
                $nome_dir = $arrayDiretores[$i];
                $email_dir = $arrayDiretores[$i + 1];
                $cargo="";
                echo $nome_dir . ", " . $email_dir ." - "; 
                if($i == 0){
                    $cargo = "geral";
                    $sql3 = "INSERT INTO diretor (nome, email, login, senha,cargo, fk_comite_id) values ('$nome_dir', '$email_dir', 'to_be_defined', 'to_be_defined', '$cargo', $id_comite);";
                    $result3 = pg_query($conn, $sql1);
                    
                    $sql4 = "SELECT id FROM diretor ORDER BY id DESC limit 1";
                    $result4 = pg_query($conn, $sql4);
                    
                    $dir = pg_fetch_array($result4);
                    $id_dir = $dir[0];
                    
                    $login = $nome_comite.".dir.".$id_dir;
                    
                    $senha = $nome_comite ."." .strval(rand(0, 9)) .strval(rand(0, 9)) .strval(rand(0, 9));

                    $sql5 = "UPDATE TABLE diretor SET login = '$login', senha = '$senha' WHERE id = $id_dir;";
                    $result5 = pg_query($conn, $sql5);

                }

                else{
                    $cargo = "assistente";
                    $sql3 = "INSERT INTO diretor (nome, email, login, senha,cargo, fk_comite_id) values ('$nome_dir', '$email_dir', 'to_be_defined', 'to_be_defined', '$cargo', $id_comite);";
                    $result3 = pg_query($conn, $sql3);
                    
                    $sql4 = "SELECT id FROM diretor ORDER BY id DESC limit 1";
                    $result4 = pg_query($conn, $sql4);
                    
                    $dir = pg_fetch_array($result4);
                    $id_dir = $dir[0];
                    
                    $login = $nome_comite.".dir.".$id_dir;
                    
                    $senha = $nome_comite ."." .strval(rand(0, 9)) .strval(rand(0, 9)) .strval(rand(0, 9));

                    $sql5 = "UPDATE TABLE diretor SET login = '$login', senha = '$senha' WHERE id = $id_dir;";
                    $result5 = pg_query($conn, $sql5);
                }
            }**/
        }  
    } 
    /**else if ($oper == "inserir_diretor") {
        $nome = "";
        $email = "";
        $login = "to_be_defined";
        $senha = "to_be_defined";
        $cargo = "geral";
        $id_comite = $_REQUEST["id_comite"];
        if(isset($_REQUEST["nome"]) && isset($_REQUEST["email"])){
            $nome = $_REQUEST["nome"];
            $email = $_REQUEST["email"];
            
            $sql1 = "INSERT INTO diretor (nome, email, login, senha,cargo, fk_comite_id) values ('$nome', '$email', '$login', '$senha', '$cargo', '$id_comite');";
            $result1 = pg_query($conn, $sql1);

            $sql2 = "SELECT id FROM diretor ORDER BY id DESC LIMIT 1;";
            $result2 = pg_query($conn, $sql2);
            $diretor = pg_fetch_array($result2);
            $id_dir = strval($diretor[0]);

            $sql3 = "SELECT nome FROM comite WHERE id = '$id_comite';";
            $result3 = pg_query($conn, $sql3);
            $comite = pg_fetch_array($result3);

            $nome_comite = $comite[0]; 

            $login = $nome_comite.".dir.".$id_dir;

            $senha = $nome "." .strval(rand(0, 9)) .strval(rand(0, 9)) .strval(rand(0, 9));

            $sql4 = "UPDATE TABLE SET login = '$login', senha = '$senha' WHERE id = $id_dir;";
            $result4 = pg_query($conn, $sql4);

            echo "sucesso";
            
        }

    }**/

?>