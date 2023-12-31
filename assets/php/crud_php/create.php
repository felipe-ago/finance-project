<?php 
if (!isset($_SESSION)) {//Verificar se a sessão não já está aberta.
    session_start();
}
include('../includes_php/connect_db.php');

$date    = $_POST["date"];
$tipo    = $_POST["select"];
$subTipo = $_POST["select-sub"];
$desc    = $_POST["desc"];
$long_descr = $_POST["desc-long"];
$valor = str_replace('.', '', $_POST['value']); // remove todos os pontos
$valor = str_replace(',', '.', $valor); // substitui a vírgula pelo ponto
$valor = floatval($valor); // converte para número decimal
$user_id = $_SESSION['id_usuario'];


$response = array();

if ($valor > 1000000) {
    http_response_code(400);
    echo json_encode(array('status' => 'error', 'message' => 'O valor máximo permitido é de 1.000.000,00'));
    exit();
}

// Executar a consulta SQL para inserir os dados na tabela
$sql = "INSERT INTO releases (user_id, datetime, type, subtype, description, long_description, launch_value ) values('$user_id', '$date', '$tipo', '$subTipo', '$desc', '$long_descr', '$valor')";

if (mysqli_query($connect, $sql)) {
    $response['status'] = 'success';
} else {
    $response['status'] = 'error';
}

// Fechar a conexão com o banco de dados


mysqli_close($connect); 
echo json_encode($response);


