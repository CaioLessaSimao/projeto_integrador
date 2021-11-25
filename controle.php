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
                $sigla = $arrayDelegacoes[$i];
                $nome = $arrayDelegacoes[$i+1];
                $email = $arrayDelegacoes[$i+2];

                $login = $nome.".".$sigla;
                $senha = $sigla.".".strval(rand(0, 9)) .strval(rand(0, 9)) .strval(rand(0, 9));

                $sql7 = "INSERT INTO delegacao(nome,email,DPO,fk_comite_id,login,senha) values ('$nome','$email','to_be_defined',$aux,'$login','$senha');";
                $result7 = pg_query($conn,$sql7);
                
            }
            header("Location: index.php?aux=final");
        }


    }

    if($oper == "logar_dir"){
        if(isset($_REQUEST['dir_usuario']) && isset($_REQUEST['dir_senha'])){
                    $login = $_REQUEST['dir_usuario'];
                    echo $login;
                    
                    $senha = $_REQUEST['dir_senha'];
                    echo $senha."<br>";
                             
                    $sql10 = "SELECT login,senha FROM diretor"; 

                    $result10 = pg_query($conn,$sql10);

                    $array = pg_fetch_array($result10);

                    echo $array[0];
                    
                    for($i=0;$i<count($array)-1;$i+=2){
                        $loginbd = $array[$i];

                        $senhabd = $array[$i+1];

                        if($login == $loginbd && $senha == $senhabd){
                            $sql11 = "SELECT fk_comite_id FROM diretor WHERE login='$login'";
                            $result11 = pg_query($conn,$sql11);
                            $aux = strval($result11[0]);
                            header("Location: pag_comite.php?idcomite=$aux");
                        }
                    }
                header("Location: index.php?aux=erro");
                }
    }
    if($oper == "logar_del"){
                if(isset($_REQUEST['del_usuario']) && isset($_REQUEST['del_senha'])){
                    $login = $_REQUEST['del_usuario'];
                        
                    $senha = $_REQUEST['del_senha'];
                    
                    $sql10 = "SELECT login,senha FROM delegacao"; 

                    $result10 = pg_query($conn,$sql10);

                    $array = pg_fetch_array($result10);
                    
                    echo $array[0."<br>";
                    echo $array[1]."<br>";
                    echo $array[2]."<br>";
                    echo $array[3]."<br>";
                    /*
                    for($i=0;$i<count($array);$i+=2){
                        echo $i."<br>";

                        $loginbd = $array[$i];
                        echo $loginbd."<br>";
                        
                        $senhabd = $array[$i+1];
                        echo $senhabd."<br>";
                        
                        if($login == $loginbd && $senha == $senhabd){
                            $sql11 = "SELECT fk_comite_id FROM delegacao WHERE login='$login'";
                            $result11 = pg_query($conn,$sql11);
                            $aux = strval($result11[0]);
                            header("Location: pag_comite.php?idcomite=$aux");
                        }
                    }
                    /*
                    header("Location: index.php?aux=erro");
                    */
                }
            }

?>