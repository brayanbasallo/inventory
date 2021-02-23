<div class="row">
    <h2>Alertas</h2>
    <p>Aqui puedes observar los productos que estan en riego de caducar</p>
</div>
<div class="row">
    <span class="fw-bold">Niveles de riesgo</span>
    <div class="d-flex m-1">
        <div style="width: 20px;height: 20px;" class="bg-danger rounded-circle"></div>
        <span>Producto que debe salir de inmediato</span>
    </div>
    <div class="d-flex m-1">
        <div style="width: 20px;height: 20px;" class="bg-warning rounded-circle"></div>
        <span>Producto que esta pronto a vencer</span>
    </div>
</div>
<div class="row mt-4">
    <h3>Productos en riesgo</h3>
    <div class="table-responsive">
        <table class="table table-sm">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Codigo del producto</th>
                    <th>Nombre</th>
                    <th>Cantidad</th>
                    <th>Fecha vencimiento</th>
                    <th>Dias restantes</th>
                    <?php
                    if ($_SESSION['usuario'][0]['id_cargo'] == 1 || $_SESSION['usuario'][0]['id_cargo'] == 3) {
                    ?>
                        <th>Quitar</th>
                    <?php
                    }
                    ?>
                </tr>
            </thead>
            <tbody>
                <?php
                $contador = 0;
                foreach ($alertas as $alert) {
                    if ($alert['estado'] != 0) {
                        $contador++;
                ?>
                        <tr class=" <?php
                                    if ($alert['dias_restantes'] <= 1) {
                                        echo 'table-danger';
                                    } elseif ($alert['dias_restantes'] <= 5) {
                                        echo 'table-warning';
                                    }
                                    ?>">
                            <td><?php echo $contador; ?></td>
                            <td><?php echo $alert['id_producto']; ?></td>
                            <td><?php echo $alert['nombre']; ?></td>
                            <td><?php echo $alert['stock']; ?></td>
                            <td><?php echo $alert['fecha_vencimiento']; ?></td>
                            <td><?php echo $alert['dias_restantes']; ?></td>
                            <?php
                            if ($_SESSION['usuario'][0]['id_cargo'] == 1 || $_SESSION['usuario'][0]['id_cargo'] == 3) {
                            ?>
                                <td>
                                    <form action="alertas.php?id=<?php echo $alert['id_producto']; ?>" method="POST">
                                        <input type="submit" value="delete" name="delete" class="btn p-0 material-icons ">
                                    </form>
                                </td>
                            <?php
                            }
                            ?>
                        </tr>
                <?php
                    }
                }
                ?>
            </tbody>
        </table>
        <?php if ($contador == 0) echo "No hay productos en riesgo" ?>
    </div>
</div>