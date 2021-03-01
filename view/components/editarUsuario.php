<div class="modal-content">
    <div class="modal-header">
        <h5 class="modal-title">Editar usuario</h5>
        <span class="fw-bold">Documento: <?php echo $usuario[0]['documento'] ?> - Usuario: <?php echo $usuario[0]['usuario'] ?></span>
    </div>
    <form action="editarUsuario.php?id=<?php echo $usuario[0]['documento'] ?>" method="POST">
        <div class="modal-body">
            <div class="form-group">
                <label for="">Nombre</label>
                <input name="name" class="form-control" type="text" value="<?php echo $usuario[0]['nombre'] ?>" placeholder="Nuevo nombre">
            </div>
            <div class="form-group">
                <label for="">Contraseña</label>
                <input name="password" class="form-control" type="password" value="" placeholder="Nuevo contraseña">
            </div>
        </div>
        <div class="modal-footer">
            <a href="usuarios.php" class="btn btn-secondary">Canelar</a>
            <button type="submit" class="btn btn-primary" data-dismiss="modal">Guardar cambios</button>
        </div>
    </form>
</div>