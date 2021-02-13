<?php

class Admin
{
    private $host;
    private $user;
    private $password;
    private $data_base;


    function __construct()
    {
        if (session_status() === PHP_SESSION_ACTIVE) {
            $this->verificar_login();
        }

        /* include_once('../config.php');
        $this->host = $host;
        $this->user = $user;
        $this->password = $password;
        $this->data_base = $data_base; */
        $this->loadDataConnection();
    }
    /**
     * carga las variables con los datos necesarios para la conexión a la base de datos
     */
    private function loadDataConnection()
    {
        include('../config.php');
        $this->host = $host;
        $this->user = $user;
        $this->password = $password;
        $this->data_base = $data_base;
    }
    /**
     * retorna la conexión a la base de datos
     * @return false|mysqli devuelve la conexión a la base de datos
     */
    function return_connection()
    {
        return mysqli_connect("$this->host", "$this->user", "$this->password", "$this->data_base");
    }
    /**
     * esta funcion se encarga de hacer el login del usuario
     * @return string si no se autentica correctamente devuelve el motivo
     */
    function login($usuario, $password)
    {
        $exit = '';
        $connection = $this->return_connection();
        $sql = "SELECT * FROM usuarios WHERE usuario='$usuario'";
        $result = $connection->query($sql);
        if ($result) {
            $result = $result->fetch_all(MYSQLI_ASSOC);
            if (count($result) > 0) {
                if ($password == $result[0]['password']) {
                    session_start();
                    $_SESSION['usuario'] = $result;
                    header('location: caja.php');
                } else {
                    $exit = 'La contraseña es incorrecta';
                }
            } else {
                $exit = 'El usuario no existe';
            }
        } else {
            $exit = 'Error en el servidor, por favor vuelve a intentarlo';
        }
        return $exit;
    }
    /**
     * esta funcion se encarga de terminar la session
     */
    function sign_out()
    {
        unset($_SESSION['usuario']);
        session_destroy();
        header('Location: login.php');
    }
    /**
     * esta funcion se encarga de verificar si el usuario se encuentra logueado
     */
    function verificar_login()
    {
        if (!isset($_SESSION['usuario'])) {
            $this->sign_out();
        }
    }
    /**
     * ejecuta el un sql para guardar datos
     * 
     */
    function guardar($sql)
    {
        $exit = false;
        $connection = $this->return_connection();
        $result = $connection->query($sql);
        if ($connection->affected_rows > 0) {
            $exit = true;
        }
        return $exit;
    }
}
