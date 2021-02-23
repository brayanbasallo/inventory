<div class="mt-1">
    <span class="fw-bold fs-5">Agregar producto</span>
    <form action="" method="post" class="">
        <div class="row">
            <div class="col-sm-12 col-md-6 p-1">
                <div class="form-group">
                    <label for="">Lote</label>
                    <input type="number" name="id_producto" class="form-control" placeholder="Codigo unico del producto" required>
                </div>
                <div class="form-group">
                    <label for="">Cantidad</label>
                    <input type="number" name="stock" class="form-control" placeholder="Cantidad de producto a stock" required>
                </div>
                <div class="form-group">
                    <label for="">Nombre</label>
                    <input type="text" name="nombre" class="form-control" placeholder="Nombre del producto" required>
                </div>
            </div>
            <div class="col-sm-12 col-md-6  p-1">
                <div class="form-group">
                    <label for="">Precio por unidad</label>
                    <input type="number" name="precio_unitario" class="form-control" placeholder="Precio del producto" required>
                </div>
                <div class="form-group">
                    <label for="">Seleccionar bodega</label>
                    <select name="id_categoria" class="form-select" required>
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
                    <input class="form-control" type="date" name="fecha_vencimiento">
                </div>
            </div>
        </div>
        <div class="form-group mt-1">
            <button class="btn col-12 btn-primary btn-block">Agregar producto</button>
        </div>
    </form>
</div>

<component-productos @delete-product="deleteProduct" admin="true"></component-productos>