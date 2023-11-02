<?php

require('user.php');

class API {

public function alta($username, $password, $email) {
    $resultadoRegistro = Usuario::crearUsuario($username, $password, $email);
    return $resultadoRegistro;
}

public function consulta($usuarioId) {
    $usuario = Usuario::obtenerUsuario($usuarioId);
    return $usuario;
}

public function modificacion($usuarioId, $username, $password, $email) {
    $resultadoActualizacion = Usuario::actualizarUsuario($usuarioId, $username, $password, $email);
    return $resultadoActualizacion;
}


public function baja($usuarioId) {
    $resultadoEliminacion = Usuario::eliminarUsuario($usuarioId);
    return $resultadoEliminacion;
}

}
/* 
$usuario = new Api();
$usuario->alta('valen','2222','valen@gmail.com');


if ($usuario) {
    echo "Usuario registrado exitosamente.";
} else {
    echo "Error al registrar el usuario.";
}

 */

/* 
$usuario = new Api();
$resultado = $usuario->consulta(8);

// Verificar la respuesta
if ($resultado) {
    // Convertir el objeto de usuario en JSON
    $jsonUsuario = json_encode($resultado);

    // Imprimir el JSON
    echo $jsonUsuario;
} else {
    echo "Usuario no encontrado.";
} */