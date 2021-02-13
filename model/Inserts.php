<?php

/**
 * @author brayan basallo soto
 */

class Inserts
{
    private $obj_admin;
    function __construct()
    {
        include_once('Admin.php');
        $this->obj_admin = new Admin;
    }
    /**
     * Esta funcion se encarga de registrar un usuario
     * @param int $documento documento del usuario
     * @param string $usuario apodo del usuario
     * @param string $nombre nombre del usuario 
     * @param string $password contraseña del usuario
     * @param int $id_cargo di del cargo del usuario
     * @return boolean true si se incerto correctamente, false si hubo un fallo
     */
    function agregarUsuario($documento, $usuario, $nombre, $password, $id_cargo)
    {
        $sql = "INSERT INTO usuarios(documento,usuario,nombre,password,id_cargo)
                VALUES('$documento','$usuario','$nombre','$password','$id_cargo')";
        $exit = $this->obj_admin->guardar($sql);
        return $exit;
    }
    /**
     * Esta funcion se encarga de guardar una bodega
     * @param string $nombre nombre de la bodega
     * @param string $descripcion descripcion del producto
     * @return boolean true si se incerto correctamente, false si hubo un fallo
     */
    function agregarBodega($nombre, $descripcion)
    {
        $sql = "INSERT INTO categorias(nombre,descripcion) VALUES('$nombre','$descripcion')";
        $exit = $this->obj_admin->guardar($sql);
        return $exit;
    }
    /**
     * Esta funcion se encarga de guardar un nuevo producto
     * @param int $id_producto codigo del producto
     * @param int $stock cantidad de productos 
     * @param string $nombre nombre del prodicto
     * @param int $precio_unidad precio del producto
     * @param int $id_categoria id de la categoria del producto
     * @param date $fecha_vencimiento fecha en la que vence el producto 
     */
    function agregarProducto($id_producto, $stock, $nombre, $precio_unidad, $id_categoria, $fecha_vencimiento)
    {
        $sql = "INSERT INTO productos(id_producto,lote,stock,nombre,precio_unitario,id_categoria,fecha_vencimiento) 
                VALUES('$id_producto','$id_producto','$stock','$nombre','$precio_unidad','$id_categoria'";
        strlen($fecha_vencimiento) == 0 ? $sql .= ',NULL)' : $sql .= ",'$fecha_vencimiento')";
        $exit = $this->obj_admin->guardar($sql);
        return $exit;
    }
}
