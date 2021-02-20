<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <script src="../js/vue.js"></script>
    <title>Instalador</title>
</head>
<style>
    #app {
        height: 100vh;
    }
</style>

<body>
    <div id="app" class="container d-flex justify-content-center align-items-center">
        <div class="" v-if="form">
            <div class="col-12" v-if="!spinners">
                <div class="col-6 m-auto text-center py-4 fw-bold fs-4">Bienvenido, llena los siguientes campos para establecer conexión y así poder almacenar toda tu información</div>
                <div class="col-6 m-auto text-center py-4 alert alert-danger" v-if="error.length >0">{{error}}</div>
                <form action="" class="col-5 m-auto ">
                    <span>Datos de conexión</span>
                    <div class="form-group">
                        <label for="">Host</label>
                        <input v-model="model.host" type="text" name="" class="form-control" placeholder="host o dirección IP">
                    </div>
                    <div class="form-group">
                        <label for="">Nombre del usuario</label>
                        <input v-model="model.user_name" type="text" name="" class="form-control" placeholder="nombre de usuario para la conexión">
                    </div>
                    <div class="form-group">
                        <label for="">Contraseña</label>
                        <input v-model="model.password" type="text" name="" class="form-control" placeholder="contraseña del usuario para la conexión">
                    </div>
                    <div class="form-group">
                        <label for="">Base de datos</label>
                        <input v-model="model.database" type="text" name="" class="form-control" placeholder="Nombre de la base de datos">
                    </div>
                    <div class="form-group pt-1">
                        <button @click="config" class="btn col-12 btn-primary btn-block">Guardar configuracion</button>
                    </div>
                </form>
            </div>
            <div class="col-12 text-center" v-else>
                <div class="spinner-border text-primary" role="status">
                    <span class="visually-hidden">Loading...</span>
                </div>
                <p>Esto puede tardar algunos minutos, por favor espera</p>
            </div>
        </div>
        <div class="text-center" v-else>
            <p>se ha instalado correctamente</p><a href="../index.php">Ir al login</a>
        </div>
    </div>
    <script src="main.js"></script>
</body>

</html>