<?php
require_once('config.php');

class Usuario {
    private $id;
    private $username;
    private $password;
    private $email;

    public function __construct($id, $username, $password, $email) {
        $this->id = $id;
        $this->username = $username;
        $this->password = $password;
        $this->email = $email;
    }

    public function getId() {
        return $this->id;
    }

    public function getUsername() {
        return $this->username;
    }

    public function getPassword() {
        return $this->password;
    }

    public function getEmail() {
        return $this->email;
    }

    public static function crearUsuario($username, $password, $email) {
        $response = array();
        $sql = "INSERT INTO usuarios (username, password, email) VALUES (?, ?, ?)";
        $parametros = [$username, $password, $email];

        try {
            ConexionDB::getInstancia()->ejecutarConsulta($sql, $parametros);
            $response["success"] = true;
            $response["message"] = "Usuario registrado exitosamente.";
        } catch (Exception $e) {
            $response["success"] = false;
            $response["message"] = "Error al registrar el usuario.";
        }

        return json_encode($response);
    }

    public static function obtenerUsuario($id) {
        $response = new stdClass();
        $sql = "SELECT id, username, password, email FROM usuarios WHERE id = ?";
        $parametros = [$id];
    
        try {
            $stmt = ConexionDB::getInstancia()->ejecutarConsulta($sql, $parametros);
            $usuario = $stmt->fetch(PDO::FETCH_ASSOC);
    
            if ($usuario) {
                $response->success = true;
                $response->usuario = new stdClass();
                $response->usuario->id = $usuario['id'];
                $response->usuario->username = $usuario['username'];
                $response->usuario->password = $usuario['password'];
                $response->usuario->email = $usuario['email'];
            } else {
                $response->success = false;
                $response->message = "Usuario no encontrado.";
            }
        } catch (Exception $e) {
            $response->success = false;
            $response->message = "Error al obtener el usuario.";
        }
    
        return json_encode($response);
    }
    

    public static function actualizarUsuario($id, $username, $password, $email) {
        $response = array();
        $sql = "UPDATE usuarios SET username = ?, password = ?, email = ? WHERE id = ?";
        $parametros = [$username, $password, $email, $id];
    
        try {
            ConexionDB::getInstancia()->ejecutarConsulta($sql, $parametros);
            $response["success"] = true;
            $response["message"] = "Usuario actualizado exitosamente.";
        } catch (Exception $e) {
            $response["success"] = false;
            $response["message"] = "Error al actualizar el usuario.";
        }
    
        return json_encode($response);
    }
    

    public static function eliminarUsuario($id) {
        $response = array();
        $sql = "DELETE FROM usuarios WHERE id = ?";
        $parametros = [$id];

        try {
            ConexionDB::getInstancia()->ejecutarConsulta($sql, $parametros);
            $response["success"] = true;
            $response["message"] = "Usuario eliminado exitosamente.";
        } catch (Exception $e) {
            $response["success"] = false;
            $response["message"] = "Error al eliminar el usuario.";
        }

        return json_encode($response);
    }
}
