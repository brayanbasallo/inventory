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


        $this->loadDataConnection();
    }
    /**
     * carga las variables con los datos necesarios para la conexión a la base de datos
     */
    private function loadDataConnection()
    {
        include_once('../config.php');
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
    function login($document, $password)
    {
        $exit = '';
        $connection = $this->return_connection();
        $sql = "SELECT * FROM usuarios WHERE usuario='$document'";
        $result = $connection->query($sql);
        if ($result) {
            $result = mysqli_fetch_array($result);
            if ($password == $result['password']) {
                session_start();
                $_SESSION['usuario'] = $result;
                header('location: caja.php');
            } else {
                if ($result == NULL) {
                    $exit = 'El usuario no existe';
                } else {
                    $exit = 'La contraseña es incorrecta';
                }
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
}
