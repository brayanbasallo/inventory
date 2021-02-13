<!doctype html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Hugo 0.79.0">
    <title>Signin Template · Bootstrap v5.0</title>

    <link rel="canonical" href="https://getbootstrap.com/docs/5.0/examples/sign-in/">



    <!-- Bootstrap core CSS -->
    <link href="../css/bootstrap.min.css" rel="stylesheet">

    <style>
        .bd-placeholder-img {
            font-size: 1.125rem;
            text-anchor: middle;
            -webkit-user-select: none;
            -moz-user-select: none;
            user-select: none;
        }

        @media (min-width: 768px) {
            .bd-placeholder-img-lg {
                font-size: 3.5rem;
            }
        }
    </style>


    <!-- Custom styles for this template -->
    <link href="../css/signin.css" rel="stylesheet">
</head>

<body class="text-center">

    <main class="form-signin">
        <form action="../controller/login.php" method="POST">
            <img class="mb-4" src="../assets/icon.png" alt="" width="72">
            <h1 class="h3 mb-3 fw-normal">Por favor, inicie sesión</h1>
            <label for="inputEmail" class="visually-hidden">Usuario</label>
            <input type="text" name="usuario" id="inputEmail" class="form-control" placeholder="Usuario" required autofocus>
            <label for="inputPassword" class="visually-hidden">Contraseña</label>
            <input type="password" name="password" id="inputPassword" class="form-control" placeholder="Contraseña" required>
            <!-- <label>
                <input type="checkbox" value="remember-me"> Remember me
            </label> -->
            <?php
            if (isset($exit)) {
            ?>
                <div class="alert alert-danger ">
                    <p class="m-0 p-0"><?php echo $exit ?></p>
                </div>
            <?php
            }
            ?>
            <button class="w-100 btn btn-lg btn-primary" type="submit">Iniciar sesión</button>
            <p class="mt-5 mb-3 text-muted">&copy; 2017-2020</p>
        </form>
    </main>



</body>

</html>