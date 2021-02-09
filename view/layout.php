<!doctype html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/dashboard.css">
    <title>Inventario</title>
</head>

<body>
    <?php
    include 'layouts/navbar.phtml'
    ?>
    <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">

        <?php
        /*    include $view; */
        include $page . '.php'

        ?>
    </main>
    <script src="../js/bootstrap.bundle.min.js"></script>

</body>

</html>