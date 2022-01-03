<?php
	require_once  "connection.php";

    $oper = $_REQUEST['funcao'];

    if($oper == "criar_comite"){
        header("Location: criar_comite.html");
    }

    $arrayDir = [];
    $arrayDel = [];

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

                    $arrayLS = array($login, $senha, $email_dir);

                    $arrayDir[] = $arrayLS;

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

                    $arrayLS = array($login, $senha, $email_dir);
                    $arrayDir[] = $arrayLS;

                    $sql5 = "UPDATE diretor SET login = '$login', senha = '$senha' WHERE id = $id_dir;";
                    $result5 = pg_query($conn, $sql5);
                    
                } 
            }
            $idc = strval($id_comite);
            var_dump($arrayDir);
            //header("Location: add_delegacao.php?idcomite=$idc");
        }  
    } 



    if($oper == "add_del"){

        if(isset($_REQUEST['delegacoes']) && isset($_REQUEST['comite'])){
            
            $arrayDelegacoes = explode(",",$_REQUEST['delegacoes']);
            
            $aux = (int)$_REQUEST['comite'];
            
            $sql6 = "SELECT nome FROM comite WHERE id=$aux";
            
            $result6 = pg_query($conn,$sql6);

            $aux2 = pg_fetch_array($result6);

            $nomeComite = $aux2[0];

            $sigla = "";
            $nome = "";
            $email = "";
            $login = "";
            $senha = "";
            
            for($i = 0; $i <count($arrayDelegacoes) - 2; $i += 3){
                $sigla = $arrayDelegacoes[$i];
                $nome = $arrayDelegacoes[$i+1];
                $email = $arrayDelegacoes[$i+2];

                $login = $sigla.".".$nomeComite;
                $senha = $sigla.".".strval(rand(0, 9)) .strval(rand(0, 9)) .strval(rand(0, 9));

                $arrayLS = array($nome, $email, $login, $senha);
                $arrayDel[] = $arrayLS;

                $sql7 = "INSERT INTO delegacao(nome,email,DPO,fk_comite_id,login,senha) values ('$nome','$email','to_be_defined',$aux,'$login','$senha');";
                $result7 = pg_query($conn,$sql7);
                
            }
            //header("Location: index.php?aux=final");
            var_dump($arrayDel);
        }


    }

    if($oper == "logar_dir"){
                if(isset($_REQUEST['dir_usuario']) && isset($_REQUEST['dir_senha'])){
                    
                    $login = $_REQUEST['dir_usuario'];
                        
                    $senha = $_REQUEST['dir_senha'];
                    
                    if(empty($login) || empty($senha)){
                        header("Location: index.php");
            
                    }
                    else if(ctype_space($login) || ctype_space($senha)){
                        header("Location: index.php");
                    }

                    $query = "SELECT id FROM diretor WHERE login='$login' and senha='$senha';";

                    $result9 = pg_query($conn, $query);

                    $row = pg_num_rows($result9);

                    if ($row == 1) {
                        $query2 = "SELECT fk_comite_id FROM diretor WHERE login='$login';";
                        $result10 = pg_query($conn,$query2);
                        $array = pg_fetch_array($result10);
                        $idcomite = $array[0];
                        header("Location: pag_comite.php?idcomite=$idcomite");
                    }
                    else{
                        header("Location: index.php?aux=erro");
                    }
                }
            }
    if($oper == "logar_del"){
                if(isset($_REQUEST['del_usuario']) && isset($_REQUEST['del_senha'])){
                    
                    $login = $_REQUEST['del_usuario'];
                        
                    $senha = $_REQUEST['del_senha'];
                    
                    if(empty($login) || empty($senha)){
                        header("Location: index.php");
            
                    }
                    else if(ctype_space($login) || ctype_space($senha)){
                        header("Location: index.php");
                    }

                    $query = "SELECT id FROM delegacao WHERE login='$login' and senha='$senha';";

                    $result9 = pg_query($conn, $query);

                    $row = pg_num_rows($result9);

                    if ($row == 1) {
                        $query2 = "SELECT fk_comite_id FROM delegacao WHERE login='$login';";
                        $result10 = pg_query($conn,$query2);
                        $array = pg_fetch_array($result10);
                        $idcomite = $array[0];
                        header("Location: pag_comite.php?idcomite=$idcomite");
                    }
                    else{
                        header("Location: index.php?aux=erro");
                    }
                }
    }

    if($oper == 'deletar_delegacao'){
        $id_del = (int)$_REQUEST['id'];
        $id_comite = $_REQUEST['idcomite'];

        $sql = "DELETE FROM delegacao WHERE id = $id_del;";
        $result = pg_query($conn, $sql);

        header("Location: lst_del.php?idcomite=$id_comite");

    }
    
        

?>