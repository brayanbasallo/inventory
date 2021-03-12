<div class="row">
    <span class="fw-bold fs-5">Agregar usuario</span>
    <form action="usuarios.php" method="POST">
        <div class="row d-flex">
            <div class="form-group col-6">
                <label for="">Nombre</label>
                <input type="text" class="form-control" name="nombre" placeholder="Nombre del usuario" required>
            </div>
            <div class="form-group col-6">
                <label for="">Usuario</label>
                <input type="text" class="form-control" name="usuario" placeholder="Apodo del usuario" required>
            </div>
        </div>
        <div class="row d-flex">
            <div class="form-group col-6">
                <label for="">Documento</label>
                <input type="number" class="form-control" name="documento" placeholder="Número de documento" required>
            </div>
            <div class="form-group col-6">
                <label for="">Cargo</label>
                <select class="form-select" name="cargo">
                    <option disabled>Seleccionar</option>
                    <?php

                    foreach ($cargos as $cargo) {
                        # code...
                        if ($cargo['id_cargo'] != 3) {
                    ?>
                            <option value="<?php echo $cargo['id_cargo'] ?>"><?php echo $cargo['nombre_cargo'] ?></option>
                    <?php
                        }
                    }
                    ?>
                </select>
            </div>
        </div>
        <div class="form-group"><label for="">Contraseña</label>
            <input type="password" name="password" placeholder="contraseña" class="form-control" required>
        </div>
        <div class="form-group d-flex">
            <div class="col-sm-6">
                <label for="">Departamento</label>
                <select @change="load_municipios" class="form-select" v-model="dep_select" name="" id="">
                    <option value="" disabled>Seleccionar</option>
                    <option :value="dep.id" v-for="dep in departamentos">{{dep.estado}}</option>
                </select>
            </div>
            <div class="col-sm-6" v-if="Object.keys(municipios).length > 0">
                <label for="">municipio</label>
                <select class="form-select" name="mun_id" id="">
                    <option value="" disabled>Seleccionar</option>
                    <option :value="mun.id_mcpio" v-for="mun in municipios">{{mun.nombre_mcpio}}</option>
                </select>
            </div>
        </div>
        <div class="form-group mt-2">
            <input type="submit" value="Registrar usuario" name="new" class="btn btn-primary col-12">
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
                    if ($usuario['id_cargo'] != 3) {
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
                            <td>
                                <a href="editarUsuario.php?id=<?php echo $usuario['documento'] ?>" class="text-primary">Editar</a>
                            </td>
                            <td>
                                <form action="usuarios.php?documento=<?php echo $usuario['documento']; ?>" method="POST">
                                    <input type="submit" value="delete" name="delete" class="btn p-0 material-icons ">
                                </form>
                            </td>

                        </tr>
                <?php
                    }
                }
                ?>
            </tbody>
        </table>
    </div>
</div>