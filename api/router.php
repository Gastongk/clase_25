<?php
require_once('api.php');
header('content-Type: application/json');
$api = new API();


if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    if (isset($_GET['usuarioId'])) {
        $usuarioId = $_GET['usuarioId'];
        $usuario = $api->consulta($usuarioId);
        echo ($usuario);
    } 

} elseif ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['registro'])) {
        $username = $_POST['username'];
        $password = $_POST['password'];
        $email = $_POST['email'];
        $resultadoRegistro = $api->alta($username, $password, $email);
        echo json_encode($resultadoRegistro);
    }
} elseif ($_SERVER['REQUEST_METHOD'] === 'PUT') {
    if (isset($putData['usuarioId']) && isset($putData['username']) && isset($putData['password']) && isset($putData['email'])) {
        $usuarioId = $putData['usuarioId'];
        $username = $putData['username'];
        $password = $putData['password'];
        $email = $putData['email'];
        $resultadoActualizacion = $api->modificacion($usuarioId, $username, $password, $email);
        echo json_encode($resultadoActualizacion);

} elseif ($_SERVER['REQUEST_METHOD'] === 'DELETE') {
    parse_str(file_get_contents("php://input"), $deleteData);
    if (isset($deleteData['usuarioId'])) {
        $usuarioId = $deleteData['usuarioId'];
        $resultadoEliminacion = $api->baja($usuarioId);
        echo json_encode($resultadoEliminacion);
    } 
} 
}