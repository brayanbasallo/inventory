<?php

class Delete
{
    private $obj_admin;
    function __construct()
    {
        include_once('Admin.php');
        $this->obj_admin = new Admin;
    }
    /**
     * Esta función recibe sirve para eliminar datos 
     * @param string $tabla nombre de la tabla
     * @param string $campo columna en la que se va a buscar el id
     * @param string $id id del dato que se desea eliminar
     * @return boolean true si se elimina correctamente 
     */
    function delete($tabla, $campo, $id)
    {
        $exit = false;
        $sql = "DELETE FROM $tabla  WHERE $campo = '$id'";
        /* echo $sql; */
        $connection = $this->obj_admin->return_connection();
        $connection->query($sql);
        if ($connection->affected_rows > 0) {
            $exit = true;
        }
        $connection->close();
        if ($tabla == 'usuarios') {
            if ($id == $_SESSION['usuario'][0]['documento']) {
                $this->obj_admin->sign_out();
            }
        }
        $this->actualizarDisponibilidadProductos();
        return $exit;
    }
    /**
     * Cambia el estado de los producto para que se interpreten como eliminados 
     */
    function deleteProduct($id)
    {
        $exit = false;
        $sql = "UPDATE productos SET estado = '0' WHERE id_producto = '$id'";
        /* echo $sql; */
        $connection = $this->obj_admin->return_connection();
        $connection->query($sql);
        if ($connection->affected_rows > 0) {
            $exit = true;
        }
        $connection->close();
        return $exit;
    }
    /**
     * esta funcion se encarga de revisar que los productos que no tienen stock y no tienen caegoria se quiten
     */
    function actualizarDisponibilidadProductos()
    {
        $exit = false;
        $sql = "UPDATE productos SET estado = '0' WHERE id_categoria IS NULL OR stock = '0'";
        /* echo $sql; */
        $connection = $this->obj_admin->return_connection();
        $connection->query($sql);
        if ($connection->affected_rows > 0) {
            $exit = true;
        }
        $connection->close();
        return $exit;
    }
}
