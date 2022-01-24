<?php

session_start();

require_once "connection.php";

$aux = json_decode(file_get_contents('php://input'), true);

$oper = $aux['action'];

if($oper == "iniciar"){
	echo json_encode($aux['action']);
	$json_data = [
	    "to" => '/topics/all',
	    "data" => [
	        "action" => $aux['action'],
	        "idcomite" => $aux['idcomite']
	    ]
	];

	$data = json_encode($json_data);
	//FCM API end-point
	$url = 'https://fcm.googleapis.com/fcm/send';
	//api_key in Firebase Console -> Project Settings -> CLOUD MESSAGING -> Server key
	$server_key = 'AAAAe2E784o:APA91bEi1GOOfi9nqvmxxOy-G4Ad8DIAVTECnIDd4RbrHt2FskqElDhzYdcddIWFYbXhAtNbxyzlu2rRhbiLrLov6ZiNTb5_ttfy8GUwBOh9h-dzUFSXOPK26gMNFIQWei3eJ_IloY2Q';
	//header with content_type api key
	$headers = array(
	    'Content-Type:application/json',
	    'Authorization:key='.$server_key
	);
	//CURL request to route notification to FCM connection server (provided by Google)
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, $url);
	curl_setopt($ch, CURLOPT_POST, true);
	curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
	curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
	$result = curl_exec($ch);
	if ($result === FALSE) {
	    die('Oops! FCM Send Error: ' . curl_error($ch));
	}
	curl_close($ch);
}

if($oper == "sel_del"){
	$idComite = (int)$aux['idcomite'];

	$sql = "SELECT nome FROM delegacao WHERE fk_comite_id = $idComite";

	$result = pg_query($conn, $sql);

	$nomes = [];

	$ids = [];

	while ($row = pg_fetch_assoc($result)) {
		    $nomes[] = $row['nome']; 
	}

	$c = 0;

	$delegacoes = [];
	/*
	while ($c < count($nomes)) {
		$delegacoes[] = [$ids[$c] => $nomes[$c]];
		$c++;
	}
	*/
	echo json_encode($nomes);
}

if ($oper == "load_lst"){
	$idComite = $aux['idcomite'];

	if($_SESSION[$idComite]){
		echo json_encode($_SESSION[$idComite]);
	}
	else{
		$_SESSION[$idComite] = "";
		echo json_encode($_SESSION[$idComite]);
	}
}

if ($oper == "add_del") {
	$idComite = $aux["idcomite"];
	$nomeDel = $aux["nomedel"];

	if($_SESSION[$idComite] == ""){
		$_SESSION[$idComite] .= $nomeDel . ",";
		echo json_encode("2");
	}
	else{
		$dels = explode(",", $_SESSION[$idComite]);
		foreach ($dels as $i) {
		 	if($i == $nomeDel){
		 		echo json_encode("1");
		 	}
		}
		$_SESSION[$idComite] .= $nomeDel .",";
		echo json_encode("2");  
	}
}

if ($oper == "upd_prx"){
	$del = $aux["del"];
	$_SESSION["proximo"] = $del;
}

if ($oper == "load_prx"){
	if($_SESSION["proximo"]){
		echo json_encode($_SESSION["proximo"]);
	}
	else{
		$_SESSION["proximo"] = "";
		echo json_encode($_SESSION["proximo"]);
	}
}
?>