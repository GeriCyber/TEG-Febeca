<?php 

?>

<!doctype html>
<html lang="es">
<head>
    <link rel="shortcut icon" href="assets/febeca.png" width="12%" height="12%">
    <meta charset="UTF-8">
    <title>Recuperar Contraseña</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <link rel="stylesheet" href="admin template/sufee-admin-dashboard-master/assets/css/normalize.css">
    <link rel="stylesheet" href="admin template/sufee-admin-dashboard-master/assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="admin template/sufee-admin-dashboard-master/assets/css/font-awesome.min.css">
    <link rel="stylesheet" href="admin template/sufee-admin-dashboard-master/assets/css/themify-icons.css">
    <link rel="stylesheet" href="admin template/sufee-admin-dashboard-master/assets/css/flag-icon.min.css">
    <link rel="stylesheet" href="admin template/sufee-admin-dashboard-master/assets/css/cs-skin-elastic.css">
    <link rel="stylesheet" href="admin template/sufee-admin-dashboard-master/assets/scss/style.css">
    <link rel="stylesheet" href="admin template/sufee-admin-dashboard-master/assets/css/xtra.css">
    <link href="https://fonts.googleapis.com/css?family=Quicksand:400,500" rel="stylesheet">

    </head>

<body>
<body class="bg-login">

    <div class="sufee-login d-flex align-content-center flex-wrap">
        <div class="container">
            <div class="login-content">
                <div class="login-logo">
                    <a href="index.php">
                        <img class="align-content" src="assets/img/uc.png" alt="">
                    </a>
                </div>
                <div class="login-form">
                    <form action="check_pass_recuperacion.php" method="post">
                        <div class="form-group">
                            <label>Correo Electrónico</label>
                            <input type="email" name="correo" class="form-control" placeholder="Email" required>
                        </div>
                        <button type="submit" name="enviar" class="btn btn-success btn-flat m-b-15">Enviar Contraseña</button>
                        <p class="mt-3"><a href="index.php" class="text-danger"><b>Regresar al Inicio de Sesión</b></a></p>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="admin template/sufee-admin-dashboard-master/assets/js/vendor/jquery-2.1.4.min.js"></script>
    <script src="admin template/sufee-admin-dashboard-master/assets/js/popper.min.js"></script>
    <script src="admin template/sufee-admin-dashboard-master/assets/js/plugins.js"></script>
    <script src="admin template/sufee-admin-dashboard-master/assets/js/main.js"></script>

</body>

</html>