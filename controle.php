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

            header("Location: add_diretor.html?idcomite=$comite[0]");
        }
    } elseif ($oper == "inserir_diretor") {
        echo "Cheguei";
    }

?>