<?php //redirigir dependiendo del rol del usuario activo, si hay alguno
    session_start();
    $err = isset($_GET["err"]) ? "?err=".$_GET["err"] : "";

    $id_rol = isset($_SESSION["id_rol"]) ? $_SESSION["id_rol"] : "";
    switch ($id_rol) 
    {
        case "admin":
            header("Location: dashboard".$err);
            break;

        case "analista":
            header("Location: dashboard".$err);
            break;
    }
?>
<!doctype html>
<html lang="es">
<head>
    <link rel="shortcut icon" href="assets/img/favicon.jpg" width="12%" height="12%">
    <meta charset="UTF-8">
    <title>Gestión Web</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <link rel="stylesheet" href="assets/css/normalize.css">
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/font-awesome.min.css">
    <link rel="stylesheet" href="assets/css/cs-skin-elastic.css">
    <link rel="stylesheet" href="assets/scss/style.css">
    <link rel="stylesheet" href="assets/css/xtra.css">
    <link href="https://fonts.googleapis.com/css?family=Quicksand:400,500" rel="stylesheet">

    </head>

<body>
<body class="bg-login">

    <div class="sufee-login d-flex align-content-center flex-wrap">
        <div class="container">
            <div class="login-content">
                <div class="login-form pb-4">
                    <div class="login-logo">
                        <img class="align-content" src="assets/img/logo appmicroformacion.jpg" alt="logo app">
                    </div>
                    <form action="inc/login.php" method="post">
                        <div class="form-group">
                            <label>Usuario</label>
                            <input type="text" name="usuario" class="form-control" placeholder="Usuario">
                        </div>
                        <div class="form-group">
                            <label>Contraseña</label>
                            <input type="password" name="password" class="form-control" placeholder="Contraseña">
                        </div>
                        <div class="checkbox">
                            <label>
                                <input type="checkbox"> Recuerdame
                            </label>
                        </div>
                        <input type="submit" class="btn btn-success btn-flat m-b-30 m-t-30" name="enviar" value="Ingresar">
                        
                    </form>
                    <?php 
                        if(isset($_GET['error']))
                        { 
                    ?>
                    <div class="sufee-alert alert with-close alert-danger alert-dismissible fade show mt-4">
                        <span class="badge badge-pill badge-danger">Error</span>
                            <?php echo $_GET['error']; ?>
                          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                            
                    <?php } ?>

                    <?php 
                    if(isset($_GET['success']))
                    { 
                    ?>
                    <div class="sufee-alert alert with-close alert-success alert-dismissible fade show mt-4">
                        <span class="badge badge-pill badge-success">Éxito</span>
                            <?php echo $_GET['success']; ?>
                          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                            
                    <?php } ?>

                </div>
            </div>
        </div>
    </div>

    <script src="assets/js/vendor/jquery-2.1.4.min.js"></script>
    <script src="assets/js/popper.min.js"></script>
    <script src="assets/js/plugins.js"></script>
    <script src="assets/js/main.js"></script>

</body>

</html>