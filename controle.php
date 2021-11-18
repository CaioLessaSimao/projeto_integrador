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
            $nome_comite = $comite[1];
            
            $arrayDiretores = explode(",", $_REQUEST['diretores']);
            
            for($i = 0; $i <count($arrayDiretores) - 1; $i += 2){
                $nome_dir = $arrayDiretores[$i];
                $email_dir = $arrayDiretores[$i + 1];
                $cargo="";
                if($i == 0){
                    $cargo = "geral";
                    $sql3 = "INSERT INTO diretor (nome, email, login, senha,cargo, fk_comite_id) values ('$nome_dir', '$email_dir', 'to_be_defined', 'to_be_defined', '$cargo', $id_comite);";
                    $result3 = pg_query($conn, $sql3);
                    
                    $sql4 = "SELECT id FROM diretor ORDER BY id DESC limit 1";
                    $result4 = pg_query($conn, $sql4);
                    
                    $dir = pg_fetch_array($result4);
                    $id_dir = $dir[0];
                    
                    $login = $nome_comite.".dir.".$id_dir;
                                
                    $senha = $nome_comite ."." .strval(rand(0, 9)) .strval(rand(0, 9)) .strval(rand(0, 9));

                    $sql5 = "UPDATE diretor SET login = '$login', senha = '$senha' WHERE id = $id_dir;";
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

                    $sql5 = "UPDATE diretor SET login = '$login', senha = '$senha' WHERE id = $id_dir;";
                    $result5 = pg_query($conn, $sql5);
                    
                } 
            }
            $idc = strval($id_comite);
            header("Location: add_delegacao.php?idcomite=$idc");
        }  
    } 



    if($oper == "add_del"){

        if(isset($_REQUEST['delegacoes']) && isset($_REQUEST['comite'])){
            
            $arrayDelegacoes = explode(",",$_REQUEST['delegacoes']);
            
            $aux = (int)$_REQUEST['comite'];
            
            $sql6 = "SELECT nome FROM comite WHERE id=$aux";

            $result6 = pg_query($conn,$sql6);

            $aux2 = pg_fetch_array($result6);

            $nome = $aux2[0];

            $sigla = "";
            $nome = "";
            $email = "";
            $login = "";
            $senha = "";
            
            for($i = 0; $i <count($arrayDelegacoes) - 2; $i += 3){
                $sigla = $arrayDelegacoes[i];
                $nome = $arrayDelegacoes[i+1];
                $emai = $arrayDelegacoes[i+2];

                $login = $nome.".".$sigla;
                $senha = $sigla.".".strval(rand(0, 9)) .strval(rand(0, 9)) .strval(rand(0, 9));

                $sql7 = "INSERT INTO delegacao(nome,email,DPO,fk_comite_id,login,senha) values '$nome','$email','to_be_defined',$aux,'$login','$senha';";
                $result7 = pg_query($conn,$sql7);
            }
            
            header("Location: final.php");
            
        }


    }

?>