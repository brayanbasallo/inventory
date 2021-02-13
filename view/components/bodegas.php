<div class="row ">
    <span class="fs-5 fw-bold">Agregar bodega</span>
    <form action="bodegas.php" method="POST">
        <div class="form-group">
            <label for="">Nombre</label>
            <input type="text" name="nombre" id="" class="form-control" placeholder="Nombre de la bodega">
        </div>
        <div class="form-group">
            <label for="">Descripción </label>
            <textarea name="descripcion" id="" cols="30" rows="3" class="form-control" placeholder="Información sobre el contenido de la bodega"></textarea>
        </div>
        <div class="form-group mt-2">
            <input type="submit" value="Agregar bodega" class="btn btn-primary col-12">
        </div>
    </form>
</div>
<div class="row mt-3">
    <div class="table-responsive">
        <table class="table table-striped table-sm">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Nombre</th>
                    <th>Descripcion</th>
                    <th>Editar</th>
                    <th>Eliminar</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $contador = 0;
                foreach ($bodegas as $bodega) {
                    $contador++;
                ?>
                    <tr>
                        <td><?php echo $contador ?></td>
                        <td><?php echo $bodega['nombre'] ?></td>
                        <td><?php echo $bodega['descripcion'] ?></td>
                        <td><a href="<?php echo $bodega['id'] ?>">Editar</a></td>
                        <td><a href="<?php echo $bodega['id'] ?>">Eliminar</a></td>

                    </tr>
                <?php
                }
                ?>
            </tbody>
        </table>
    </div>
</div>