<div class="modal-content">
    <div class="modal-header">
        <h5 class="modal-title">Editar bodega</h5>
    </div>
    <form action="editarBodegas.php?id=<?php echo $bodega[0]['id'] ?>" method="POST">
        <div class="modal-body">
            <div class="form-group">
                <label for="">Nombre</label>
                <input name="name" class="form-control" type="text" value="<?php echo $bodega[0]['nombre'] ?>" placeholder="Nuevo nombre">
            </div>
            <div class="form-group">
                <label for="">Descripción</label>
                <textarea name="description" id="" cols="30" rows="10" class="form-control">
<?php echo $bodega[0]['descripcion'] ?>
                </textarea>
            </div>
        </div>
        <div class="modal-footer">
            <a href="bodegas.php" class="btn btn-secondary">Canelar</a>
            <button type="submit" class="btn btn-primary" data-dismiss="modal">Guardar cambios</button>
        </div>
    </form>
</div>