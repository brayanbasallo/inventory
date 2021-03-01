<?php
class Request
{
    private $obj_admin;
    function __construct()
    {
        include_once('Admin.php');
        $this->obj_admin = new Admin;
    }
    /**
     * retorna los datos de la tabla de la base de datos que le pasemos
     * @param string nombre de la tabla
     * @return array $result con los datos de la tabla
     */
    function get_all_table_data($table, $order = false)
    {
        $sql = "SELECT * FROM $table";
        if ($order) $sql .= " ORDER BY $order";
        $connection = $this->obj_admin->return_connection();
        $data = $connection->query($sql);
        if ($data != false) {
            $exit = $data->fetch_all(MYSQLI_ASSOC);
        } else {
            $exit = [];
        }
        $connection->close();
        return $exit;
    }
    /**
     * ejecuta un sql y devuelve el resultado
     * @param string $sql petición a la base de datos
     * @return array $result con los datos de la tabla
     */
    function get_data($sql)
    {
        $connection = $this->obj_admin->return_connection();
        $sql = "$sql";
        $results = $connection->query($sql);
        if ($results != false) {
            $exit = $results->fetch_all(MYSQLI_ASSOC);
        } else {
            $exit = [];
        }
        $connection->close();
        return $exit;
    }
}
