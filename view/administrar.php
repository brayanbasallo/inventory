<div class="row">
    <h2>Administracion</h2>
    <p>Aqui podras tener control sobre los usuarios y productos</p>
</div>
<div class=" d-flex justify-content-between text-center mt-2">
    <div class="col-4 ">
        <a href="productos.php" class="nav-link text-secondary fw-bold">Productos</a>
    </div>
    <div class="col-4">
        <a href="bodegas.php" class="nav-link text-secondary fw-bold">Bodegas</a>
    </div>
    <div class="col-4">
        <a href="usuarios.php" class="nav-link text-secondary fw-bold">Usuarios</a>
    </div>
</div>
<hr>
<div class="p-2">
    <?php
    include('components/' . $admin . '.php');
    ?>
</div>