<div class="row m-1">
    <span class="fw-bold fs-5">Agregar producto</span>
    <form action="" method="post" class="">
        <div class="d-flex">
            <div class="col-6 p-1">
                <div class="form-group">
                    <label for="">Lote</label>
                    <input type="number" name="id_producto" id="" class="form-control" placeholder="Codigo unico del producto" required>
                </div>
                <div class="form-group">
                    <label for="">Cantidad</label>
                    <input type="number" name="stock" id="" class="form-control" placeholder="Cantidad de producto a stock" required>
                </div>
                <div class="form-group">
                    <label for="">Nombre</label>
                    <input type="text" name="nombre" id="" class="form-control" placeholder="Nombre del producto" required>
                </div>
            </div>
            <div class="col-6 p-1">
                <div class="form-group">
                    <label for="">Precio por unidad</label>
                    <input type="number" name="precio_unitario" id="" class="form-control" placeholder="Precio del producto" required>
                </div>
                <div class="form-group">
                    <label for="">Seleccionar bodega</label>
                    <select name="id_categoria" id="" class="form-select" required>
                        <?php
                        foreach ($bodegas as $bodega) {
                        ?>
                            <option value="<?php echo $bodega['id']; ?>"><?php echo $bodega['nombre']; ?></option>
                        <?php
                        }
                        ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="">Fecha vencimiento</label>
                    <input class="form-control" type="date" name="fecha_vencimiento" id="">
                </div>
            </div>
        </div>
        <div class="form-group mt-1">
            <button class="btn col-12 btn-primary btn-block">Agregar producto</button>
        </div>
    </form>
</div>
<div class="row">
    <h4>Traer productos</h4>
    <div class="m-2">
        <label for="">Seleccionar bodega</label>
        <select name="" id="" class="form-select">
            <option value="null">Seleccionar</option>

            <?php
            foreach ($bodegas as $bodega) {
            ?>
                <option value="<?php echo $bodega['id']; ?>"><?php echo $bodega['nombre']; ?></option>
            <?php
            }
            ?>
        </select>
    </div>
</div>
<div class="">
    <?php
    if (isset($exit)) {
        echo $exit;
    }
    ?>
</div>
<div class="row mt-4">
    <h3>Productos en bodega</h3>
    <div class="table-responsive">
        <table class="table table-striped table-sm">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Lote</th>
                    <th>Nombre</th>
                    <th>Precio Unidad</th>
                    <th>Cantidad</th>
                    <th>Fecha de vencimiento</th>
                    <th>Total</th>
                    <th>Quitar</th>
                </tr>
            </thead>
            <tbody>
                <?php

                foreach ($productos as $producto) {
                ?>
                    <tr>
                        <td>#</td>
                        <td><?php echo $producto['lote']; ?></td>
                        <td><?php echo $producto['nombre']; ?></td>
                        <td><?php echo $producto['precio_unitario']; ?></td>
                        <td><?php echo $producto['stock']; ?></td>
                        <td><?php echo $producto['fecha_vencimiento']; ?></td>
                        <td><?php echo $producto['stock']; ?></td>
                        <td><a href="">Eliminar</a></td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</div>