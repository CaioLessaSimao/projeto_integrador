<?php


$data = json_decode(file_get_contents('php://input'), true);

$resposta = $data['campo'];



echo json_encode($resposta);

?>