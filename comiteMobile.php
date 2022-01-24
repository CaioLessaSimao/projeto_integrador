<?php
 
// array for JSON response
$response = array();

// conecta ao BD
$con = pg_connect(getenv("DATABASE_URL"));

$username = NULL;
$password = NULL;

$isAuth = false;

// Método para mod_php (Apache)
if(isset( $_SERVER['PHP_AUTH_USER'])) {
    $username = $_SERVER['PHP_AUTH_USER'];
    $password = $_SERVER['PHP_AUTH_PW'];
} // Método para demais servers
elseif(isset( $_SERVER['HTTP_AUTHORIZATION'])) {
    if(preg_match( '/^basic/i', $_SERVER['HTTP_AUTHORIZATION']))
		list($username, $password) = explode(':', base64_decode(substr($_SERVER['HTTP_AUTHORIZATION'], 6)));
}

// Se a autenticação não foi enviada
if(!is_null($username)){
    $query = pg_query($con, "SELECT senha FROM delegacao WHERE login='$username'");

	if(pg_num_rows($query) > 0){
		$row = pg_fetch_array($query);
		if($password == $row['senha']){
			$isAuth = true;
		}
	}
}
 
if($isAuth) {
	if(isset($_GET['idComite'])){

		$idComite = (int)$_GET['idComite'];

		$sql = "SELECT nome,tema FROM comite WHERE id=$idComite;";

		$query = pg_query($con, $sql);

		$sql2 = "SELECT * FROM diretor WHERE fk_comite_id=$idComite and cargo='geral'";
		$query2 = pg_query($conn, $sql2);

		$sql3 = "SELECT nome FROM diretor WHERE fk_comite_id=$idComite and cargo='assistente'";
		$query3 = pg_query($conn, $sql3);

		if (!empty($query)) {
        	if (pg_num_rows($query) > 0) {
        		$row = pg_fetch_array($query);
        		$row2 = pg_fetch_array($query2);


        		$response['dirAss'] = array();
        		if (pg_num_rows($query3) > 0) {
        			while ($row3 = pg_fetch_array($query3)) {
        				$diretor = array();
        				$diretor['nome'] = $row3['nome'];
        				array_push($response['dirAss'], $diretor);
        			}

        		}

				 

        		$response['nomeComite'] = $row['nome'];
        		$response['temaComite'] = $row['tema'];
        		$response['dirG'] = $row2['nome'];
        		$response["success"] = 1;
			}
			else{
				$response['success'] = 0;
				$response['error'] = "Erro de banco de dados(num rows)";
			}
		}
		else{
			$response['success'] = 0;
			$response['error'] = "Erro de banco de dados(empty)";
		}
	}
	else{
		$response["success"] = 0;
		$response["error"] = "id do comite não enviado";
	}
}
else {
	$response["success"] = 0;
	$response["error"] = "falha de autenticação";
}

pg_close($con);
echo json_encode($response);
?>