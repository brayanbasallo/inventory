<!doctype html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!-- <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet"> -->
    <link rel="stylesheet" href="../css/icons.css">
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/dashboard.css">
    <script src="../js/vue.js"></script>
    <script src="https://unpkg.com/@trevoreyre/autocomplete-vue"></script>
    <title>Inventario</title>
</head>

<body>
    <div id="app">
        <?php
        include 'layouts/navbar.phtml'
        ?>
        <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 p-2">

            <?php
            /*    include $view; */
            include $page . '.php'

            ?>
        </main>
    </div>
    <script src="../js/bootstrap.bundle.min.js"></script>
    <script src="../js/main.js"></script>



</body>

</html>