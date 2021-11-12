<?php
	require_once  "connection.php";
    
    $oper = $_REQUEST['funcao'];

    if($oper == "criar_comite"){
        header("Location: criar_comite.html");
    }

    if($oper == 'inserir_comite'){
        $orgao = "";
        $tema = "";
        $desc = "";
        $blog = "";
        $logo = "test";

        if (isset($_REQUEST["orgao"]) && isset($_REQUEST["tema"]) && isset($_REQUEST["desc"]) && isset($_REQUEST["blog"])){
            $orgao = $_REQUEST["orgao"];
            $tema = $_REQUEST["tema"];
            $desc = $_REQUEST["desc"];
            $blog = $_REQUEST["blog"];
            
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
            
            $sql2 = "SELECT id FROM comite WHERE tema = '$tema';";

            $result2 = pg_query($conn, $sql2);
            
            $comite = pg_fetch_array($result2);

            header("Location: add_diretor.php?idcomite=$comite[0]");
        }
    } elseif ($oper == "inserir_diretor") {
        $nome = "";
        $email = "";
        $login = "to_be_defined";
        $senha = "to_be_defined";
        $cargo = "geral";
        $id_comite = $_REQUEST["id_comite"];
        if(isset($_REQUEST["nome"]) && isset($_REQUEST["email"])){
            $nome = $_REQUEST["nome"];
            $email = $_REQUEST["email"];
            
            $sql1 = "INSERT INTO diretor (nome, email"

            $sql3 = "SELECT nome FROM comite WHERE id = '$id_comite'";
            $result3 = pg_query($conn, $sql1);
            $comite = pg_fetch_array($result2);

            $nome_comite = $comite[0]; 
            
        }

    }

?>