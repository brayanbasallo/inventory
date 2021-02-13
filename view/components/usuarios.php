<div class="row">
    <span class="fw-bold fs-5">Agregar usuario</span>
    <form action="usuarios.php" method="POST">
        <div class="row d-flex">
            <div class="form-group col-6">
                <label for="">Nombre</label>
                <input type="text" class="form-control" name="nombre" id="" placeholder="Nombre del usuario">
            </div>
            <div class="form-group col-6">
                <label for="">Usuario</label>
                <input type="text" class="form-control" name="usuario" id="" placeholder="Apodo del usuario">
            </div>
        </div>
        <div class="row d-flex">
            <div class="form-group col-6">
                <label for="">Documento</label>
                <input type="number" class="form-control" name="documento" id="" placeholder="Número de documento">
            </div>
            <div class="form-group col-6">
                <label for="">Cargo</label>
                <select class="form-select" name="cargo" id="">
                    <option selected>Seleccionar</option>
                    <?php

                    foreach ($cargos as $cargo) {
                        # code...

                    ?>
                        <option value="<?php echo $cargo['id_cargo'] ?>"><?php echo $cargo['nombre_cargo'] ?></option>
                    <?php
                    }
                    ?>
                </select>
            </div>
        </div>
        <div class="form-group"><label for="">Contraseña</label>
            <input type="password" name="password" id="" placeholder="contraseña" class="form-control">
        </div>
        <div class="form-group mt-2">
            <input type="submit" value="Registrar usuario" class="btn btn-primary col-12">
        </div>
    </form>
</div>

<div class="row mt-4">
    <div class="table-responsive">
        <table class="table table-striped table-sm">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Documento</th>
                    <th>Nombre</th>
                    <th>Usuario</th>
                    <th>Cargo</th>
                    <th>Editar</th>
                    <th>Eliminar</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $contador = 0;
                foreach ($usuarios as $usuario) {
                    $contador++;
                ?>
                    <tr>
                        <td><?php echo $contador ?></td>
                        <td><?php echo $usuario['documento'] ?></td>
                        <td><?php echo $usuario['nombre'] ?></td>
                        <td><?php echo $usuario['usuario'] ?></td>
                        <td>
                            <?php

                            foreach ($cargos as $cargo) {
                                # code...
                                if ($cargo['id_cargo'] == $usuario['id_cargo']) {
                                    echo $cargo['nombre_cargo'];
                                }
                            }
                            ?>
                        </td>
                        <td><a href="<?php echo $usuario['id'] ?>">Editar</a></td>
                        <td><a href="<?php echo $usuario['id'] ?>">Eliminar</a></td>

                    </tr>
                <?php
                }
                ?>
            </tbody>
        </table>
    </div>
</div>