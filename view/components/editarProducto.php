<div class="modal-content">
    <div class="modal-header">
        <h5 class="modal-title">Editar producto</h5>
    </div>
    <form action="editarProducto.php?id=<?php echo $product[0]['id_producto'] ?>" method="POST">
        <div class="modal-body">
            <div class="col-12 p-1">
                <div class="form-group">
                    <label for="">Cantidad</label>
                    <input type="number" name="stock" value="<?php echo $product[0]['stock'] ?>" class="form-control" placeholder="Cantidad de producto a stock" required>
                </div>
                <div class="form-group">
                    <label for="">Nombre</label>
                    <input type="text" name="name" value="<?php echo $product[0]['nombre'] ?>" class="form-control" placeholder="Nombre del producto" required>
                </div>
            </div>
            <div class="col-12  p-1">
                <div class="form-group">
                    <label for="">Precio por unidad</label>
                    <input type="number" name="precio_unitario" value="<?php echo $product[0]['precio_unitario'] ?>" class="form-control" placeholder="Precio del producto" required>
                </div>

                <div class="form-group">
                    <label for="">Fecha vencimiento</label>
                    <input class="form-control" type="date" value="<?php echo $product[0]['fecha_vencimiento'] ?>" name="fecha_vencimiento">
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <a href="productos.php" class="btn btn-secondary">Canelar</a>
            <button type="submit" class="btn btn-primary" data-dismiss="modal">Guardar cambios</button>
        </div>
    </form>
</div>