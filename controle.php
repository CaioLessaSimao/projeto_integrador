<?php
	require_once  "connection.php";
    
    $oper = $_REQUEST['funcao'];

    if($oper == "criar_comite"){
        header("Location: criar_comite.html");
    }

    else if($oper = 'inserir_comite'){
        $orgao = "";
        $tema = "";
        $desc = "";
        $blog = "";
        $logo = "test";

        if (isset($_REQUEST["orgao"] && isset($_REQUEST["tema"] && isset($_REQUEST["desc"] && isset($_REQUEST["blog"])){
            $orgao = $_REQUEST["orgao"];
            $tema = $_REQUEST["tema"];
            $desc = $_REQUEST["desc"];
            $blog = $_REQUEST["blog"];
            
            if(empty($orgao) || empty($tema) || empty($desc) || empty($blog)){
                echo  "<script>alert('Existem campos vazios!');</script>";
                header("Location: criar_comite.html");
            
            }else if(ctype_space($orgao) || ctype_space($tema) || ctype_space($desc) || ctype_space($blog)){
                echo  "<script>alert('Os campos não podem ficar em branco!');</script>";
                header("Location: criar_comite.html");
            }

            $query = "INSERT INTO comite (nome, tema, descricao, link_do_blog, logo) VALUES ('$orgao', '$tema, '$desc', '$blog', '$logo');";
            $result = pg_query($query);
            header("Location = add_delegacao.html");
        }

        /*$query = "INSERT INTO book VALUES ('$_POST[bookid]','$_POST[book_name]',
        '$_POST[price]','$_POST[dop]')";
        $result = pg_query($query);*/ 
    }

?>