<?php
	require_once  "connection.php";
    
    $oper = $_REQUEST['funcao'];

    if($oper == "Criar Comitê"){
        header("Location: criar_comite.html");
    }

?>