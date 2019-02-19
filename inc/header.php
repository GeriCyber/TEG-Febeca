<?php
  session_start();
  if (empty($_SESSION["id_usuario"]))
      header("Location: index.php");

    require_once 'inc/funciones_bd.php';
    $db = new funciones_BD();
?>

<!DOCTYPE html>
<html class="no-js" lang="es">
<head>
    <link rel="shortcut icon" href="assets/img/favicon.jpg">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title><?php if(($_SESSION["id_rol"])=='analista') { ?>Analista<?php } else { ?>Administrador<?php } ?></title>

    <link rel="stylesheet" href="assets/css/normalize.css">
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/font-awesome.min.css">
    <link rel="stylesheet" href="assets/css/cs-skin-elastic.css">
    <link rel="stylesheet" href="assets/scss/widgets.css">
    <link rel="stylesheet" href="assets/css/lib/datatable/dataTables.bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/lib/datatable/dataTables.checkboxes.css">
    <link rel="stylesheet" href="assets/css/lib/datatable/buttons.bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/lib/datatable/buttons.dataTables.min.css">
    <link rel="stylesheet" href="assets/css/lib/datatable/select.dataTables.min.css">
    <link rel="stylesheet" href="assets/css/lib/datatable/responsive.dataTables.min.css">
    <link rel="stylesheet" href="assets/css/lib/chosen/chosen.min.css">
    <link rel="stylesheet" href="assets/css/bootstrap-datepicker.css">

    <link rel="stylesheet" href="assets/scss/style.css">
    <link rel="stylesheet" href="assets/css/xtra.css">
    <link rel="stylesheet" href="assets/css/tempusdominus-bootstrap-4.min.css">
    <link href="https://fonts.googleapis.com/css?family=Quicksand:400,500" rel="stylesheet">

</head>

<body>

    <aside id="left-panel" class="left-panel">
      <nav class="navbar navbar-expand-sm navbar-default">

          <div class="navbar-header">
              <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#main-menu" aria-controls="main-menu" aria-expanded="false" aria-label="Toggle navigation">
                  <i class="fa fa-bars"></i>
              </button>
              <a class="navbar-brand py-3" href="./"><img src="assets/img/logo appmicroformacion.jpg"></a>
              <a class="navbar-brand hidden" href="./">M</a>
          </div>

          <div id="main-menu" class="main-menu collapse navbar-collapse">
              <ul class="nav navbar-nav">
                  <li class="active">
                      <a href="index.php"> <i class="menu-icon fa fa-dashboard"></i>Dashboard </a>
                  </li>
                  <?php if ($_SESSION["id_rol"] == "admin"){ ?>
                  <h3 class="menu-title">Empresas</h3><!-- /.menu-title -->
                  <li class="menu-item-has-children dropdown">
                      <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fa fa-building-o"></i>Administrar Empresas</a>
                      <ul class="sub-menu children dropdown-menu">
                          <li><i class="fa fa-plus"></i><a href="empresas.php">Agregar/Modificar Empresa</a></li>
                      </ul>
                  </li>

                  <h3 class="menu-title">Usuarios</h3><!-- /.menu-title -->
                  <li class="menu-item-has-children dropdown">
                      <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fa fa-users"></i>Administrar Usuarios</a>
                      <ul class="sub-menu children dropdown-menu">
                          <li><i class="fa fa-plus"></i><a href="usuarios.php">Agregar/Modificar Usuarios</a></li>
                          <li><i class="fa fa-cloud-upload"></i><a href="carga_masiva.php">Carga Masiva de Usuarios</a></li>
                      </ul>
                  </li>

                  <h3 class="menu-title">Contenido</h3><!-- /.menu-title -->
                  <li class="menu-item-has-children dropdown">
                      <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fa fa-eye"></i>Administrar Contenido</a>
                      <ul class="sub-menu children dropdown-menu">
                          <li><i class="fa fa-tag"></i><a href="categorias.php">Crear/Modificar Categoría</a></li>
                          <li><i class="fa fa-file"></i><a href="documentos.php">Agregar/Asignar Documento</a></li>
                          <li><i class="fa fa-youtube-play"></i><a href="videos.php">Agregar/Asignar Vídeo</a></li>
                          <li><i class="fa fa-star"></i><a href="valoraciones.php">Gestionar valoraciones</a></li>
                      </ul>
                  </li>

                  <h3 class="menu-title">Reportes</h3><!-- /.menu-title -->
                  <li>
                      <a href="reportes.php"> <i class="menu-icon fa fa-bar-chart-o (alias)"></i>Generar Reportes</a>
                  </li>

                  <h3 class="menu-title">Auditoría</h3><!-- /.menu-title -->
                  <li>
                      <a href="auditoria.php"> <i class="menu-icon fa fa-exclamation-triangle (alias)"></i>Gestionar Actividad</a>
                  </li>
                <?php }
                   else if ($_SESSION["id_rol"] == "analista"){ ?>
                  <h3 class="menu-title">Reportes</h3><!-- /.menu-title -->
                  <li>
                      <a href="reportes.php"> <i class="menu-icon fa fa-bar-chart-o (alias)"></i>Generar Reportes </a>
                  </li>
              <?php } ?>
              </ul>
          </div><!-- /.navbar-collapse -->
      </nav>
  </aside><!-- /#left-panel -->
  
  <div id="right-panel" class="right-panel">

    <!-- Header-->
    <header id="header" class="header">

        <div class="header-menu">

            <div class="col-sm-12">
                <a id="menuToggle" class="menutoggle pull-left"><i class="fa fa-arrow-left"></i></a>
                <div class="user-area dropdown float-right">
                  <?php if($_SESSION["id_rol"] == "admin") { ?>
                  <div class="dropdown for-notification mr-1">
                      <?php 
                            $notificacion = count($db->ElementosCaducados('documentos', $eliminar=false)) +
                                            count($db->ElementosCaducados('videos', $eliminar=false));
                      if($notificacion > 0) { ?>
                        <button class="btn bg-login dropdown-toggle" type="button" id="notification" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                          <i class="fa fa-bell text-white"></i>
                          <span class="count bg-danger">1</span>
                        </button>
                        <div class="dropdown-menu mt-2 bubble" aria-labelledby="notification">
                          <p class="text-muted text-center">Tienes una Notificación</p>
                          <a class="dropdown-item media bg-flat-color-4" href="eliminar_caducados.php">
                              <i class="fa fa-warning text-white"></i>
                              <p class="text-white">Hay <?php echo $notificacion; ?> contenidos caducados</p>
                          </a>
                        </div>
                      <?php } else { ?>
                        <button class="btn bg-login dropdown-toggle" type="button" id="notification" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                          <i class="fa fa-bell text-white"></i>
                          <span class="count bg-danger">0</span>
                        </button>
                        <div class="dropdown-menu mt-2" aria-labelledby="notification">
                          <p class="text-muted text-center">No hay notificaciones</p>
                        </div>
                      <?php } ?>
                    </div>
                  <?php } ?>
                    <i class="fa fa-user text-white icon-size"></i>
                    <div class="user-area dropdown float-right">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            &nbsp;&nbsp;<span class="text-white"><b><?=$_SESSION["nombre"]; ?></b></span>&nbsp;&nbsp;
                            <i class="fa fa-caret-down text-white icon-size"></i>
                        </a>
                        <div class="user-menu dropdown-menu">
                                <a class="nav-link text-muted" href="cambiar_contrasena.php"><i class="fa fa-lock"></i>&nbsp;&nbsp;Cambiar Contraseña</a>
                                <a class="nav-link text-muted" href="inc/logout.php"><i class="fa fa-power-off"></i>&nbsp;&nbsp;Cerrar Sesión</a>
                        </div>
                    </div>
                </div>

            </div>
        </div>

    </header><!-- /header -->    