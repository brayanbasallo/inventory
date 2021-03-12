<div class="row">
    <p>Aqui podras generar el reporte de ventas de tus empleados, o el total acumulado</p>
    <form action="reportes.php" method="GET">
        <div class="col-12 form-group">
            <label for="">traer ventas de: </label>
            <select name="fecha" id="" class="form-select" required>
                <option disabled>Seleccionar</option>
                <option value="mes">Mes</option>
                <option value="hoy">Día</option>
                <option value="">Todas</option>
            </select>
        </div>
        <div class="col-12">
            <label for="">Del usuario:</label>
            <select name="user" id="" class="form-select" required>
                <option disabled>Seleccionar</option>
                <option value="todos">Todos</option>
                <?php
                foreach ($usuarios as $user) {


                ?>
                    <option value="<?php echo $user['documento'] ?>"><?php echo $user['usuario'] ?></option>
                <?php } ?>

            </select>
        </div>
        <div class="col-12 pt-1">
            <input type="submit" value="buscar" class="btn col-12 btn-primary btn-block">
        </div>
    </form>
</div>
<?php
$saldo  = 0;
foreach ($facturas as $factura) {
    $saldo += $factura['saldo_total'];
}
if (count($facturas) > 0) {
?>
    <p class="pt-2 ">Total de ventas: $ <?php echo $saldo; ?></p>
    <div class="row mt-4">
        <div class="table-responsive">
            <table class="table table-striped table-sm">
                <thead>
                    <tr>
                        <th>Factura</th>
                        <th>Descuento</th>
                        <th>Saldo</th>
                        <th>Usuario</th>
                        <th>Fecha y hora</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    foreach ($facturas as $factura) {
                    ?>
                        <tr>
                            <td><?php echo $factura['id_factura'] ?></td>
                            <td><?php echo $factura['descuento'] ?> %</td>
                            <td><?php echo $factura['saldo_total'] ?></td>
                            <td><?php echo $factura['nombre'] ?></td>
                            <td><?php echo $factura['fecha'] ?></td>
                        </tr>
                    <?php
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
<?php
} else {
?>
    <p class="text-center">No se han encontrado registros</p>
<?php
}
?>