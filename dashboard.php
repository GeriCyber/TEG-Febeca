<?php require_once('inc/header.php'); ?>

<?php
    require_once 'inc/funciones_bd.php';
    $db = new funciones_BD();
?>

<!--Div que viene de header-->
    <div class="breadcrumbs">
        <div class="col-sm-12">
            <div class="page-header">
                <div class="page-title text-center">
                    <h1 class="text-muted">Dashboard</h1>
                </div>
            </div>
        </div>
    </div>
    <div class="content mt-3">
        <div class="animated fadeIn">
            <div class="row">

                <div class="col-sm-12">
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                      Bienvenido <br>
                        <span class="badge badge-pill badge-success"><?=$_SESSION["nombre"]; ?></span>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                </div>
                
                <?php
                if($_SESSION["id_rol"] == "admin") 
                {
                    $notificacion = count($db->ElementosCaducados('documentos', $eliminar=false)) +
                                    count($db->ElementosCaducados('videos', $eliminar=false));
                    if($notificacion > 0) { ?>
                        <div class="col-sm-12">
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                              ¡Hay <?php echo $notificacion; ?> contenidos caducados!<br>
                              <a href="eliminar_caducados.php" class="btn btn-sm btn-danger text-white mt-3"><i class="fa fa-trash"></i>&nbsp;&nbsp;Eliminar</a>
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        </div>
                    <?php } 
                } ?>

                <div class="col-12 col-lg-4">
                    <div class="card">
                        <div class="card-body">
                            <div class="clearfix">
                                <i class="fa fa-user bg-light-green p-3 font-2xl mr-3 float-left text-muted"></i>
                                <?php 
                                    $usuarios = $db->cantidad_registros_tabla("usuarios"); 
                                    $usuariosAdmin = $db->total_usuarios_admin(); 
                                    $usuariosEmpleados = $db->total_usuarios_empleados(); 
                                    $usuariosAnalista = $db->total_usuarios_analista(); 
                                ?>
                                <div class="h5 text-secondary mb-0 mt-1"><?php echo $usuarios; ?></div>
                                <div class="text-muted text-uppercase font-weight-bold font-xs small">Usuarios
                                <br><br>
                                    <span class="badge badge-success"><?php echo $usuariosAdmin; ?></span>&nbsp;&nbsp;Admin&nbsp;
                                    <span class="badge badge-success"><?php echo $usuariosEmpleados; ?></span>&nbsp;&nbsp;Empleados&nbsp;
                                    <span class="badge badge-success"><?php echo $usuariosAnalista; ?></span>&nbsp;&nbsp;Analistas
                                </div>
                            </div>
                            <div class="b-b-1 pt-3"></div>
                        </div>
                    </div>
                </div><!--/.col-->

                <div class="col-12 col-lg-4">
                    <div class="card">
                        <div class="card-body">
                            <div class="clearfix">
                                <i class="fa fa-building bg-light-green p-3 font-2xl mr-3 float-left text-muted"></i>
                                <?php 
                                    $empresas = $db->cantidad_registros_tabla("sucursales"); 
                                    $ultima = $db->ultima_empresa(); 
                                ?>
                                <div class="h5 text-secondary mb-0 mt-1"><?php echo $empresas; ?></div>
                                <div class="text-muted text-uppercase font-weight-bold font-xs small">Empresas<br><br>
                                    <span class="badge badge-success"><?php echo $ultima; ?></span>&nbsp;&nbsp;Última Empresa agregada&nbsp;
                                </div>
                            </div>
                            <div class="b-b-1 pt-3"></div>
                        </div>
                    </div>
                </div><!--/.col-->

                <div class="col-12 col-lg-4">
                    <div class="card">
                        <div class="card-body">
                            <div class="clearfix">
                                <i class="fa fa-cogs bg-light-green p-3 font-2xl mr-3 float-left text-muted"></i>
                                <?php 
                                    $videos = $db->cantidad_registros_tabla("videos");
                                    $documentos = $db->cantidad_registros_tabla("documentos"); 
                                ?>
                                <div class="h5 text-secondary mb-0 mt-1"><?php echo $videos+$documentos ?></div>
                                <div class="text-muted text-uppercase font-weight-bold font-xs small">Contenidos<br><br>
                                    <span class="badge badge-success"><?php echo $videos; ?></span>&nbsp;&nbsp;Vídeos&nbsp;
                                    <span class="badge badge-success"><?php echo $documentos; ?></span>&nbsp;&nbsp;Documentos
                                </div>
                            </div>
                            <div class="b-b-1 pt-3"></div>
                        </div>
                    </div>
                </div><!--/.col-->

                <?php if($_SESSION["id_rol"] == "admin") 
                { ?>
                <div class="col-md-4" style="overflow-y: scroll;height: 156px;">
                    <aside class="profile-nav alt">
                        <section class="card">
                            <div class="card-header user-header alt bg-login">
                                <div class="media d-flex align-items-center">
                                    <img src="assets/img/video-player.svg" width="32">
                                    <div class="media-body">   
                                        <h5 class="font-w-300 display-6 pl-3 text-light">Administrar Contenido</h5>
                                    </div>
                                </div>
                            </div>

                            <ul class="list-group list-group-flush">
                                <li class="list-group-item">
                                    <a href="videos.php">Agregar/Asignar Vídeo<span class="pull-right"><i class="fa fa-play text-success"></i></span></a>
                                </li>
                                <li class="list-group-item">
                                    <a href="documentos.php">Agregar/Asignar Documento<span class="pull-right"><i class="fa fa-file text-success"></i></span></a>
                                </li>
                                <li class="list-group-item">
                                    <a href="categorias.php">Crear/Modificar Categoría<span class="pull-right"><i class="fa fa-tag text-success"></i></span></a>
                                </li>
                                <li class="list-group-item">
                                   <a href="valoraciones.php">Gestionar Valoraciones <span class="pull-right"><i class="fa fa-star text-success"></i></span></a>
                                </li>
                            </ul>

                        </section>
                    </aside>
                </div>

                <div class="col-md-4">
                    <aside class="profile-nav alt">
                        <section class="card">
                            <div class="card-header user-header alt bg-login">
                                <div class="media d-flex align-items-center">
                                    <img src="assets/img/work.svg" width="32">
                                    <div class="media-body">
                                        <h5 class="font-w-300 pl-3 text-light">Administrar Usuarios</h5>
                                    </div>
                                </div>
                            </div>

                            <ul class="list-group list-group-flush">
                                <li class="list-group-item">
                                    <a href="usuarios.php">Agregar/Modificar <span class="pull-right text-success"><i class="fa fa-plus text-da"></i></span></a>
                                </li>
                                <li class="list-group-item">
                                    <a href="carga_masiva.php">Carga Masiva <span class="pull-right text-success"><i class="fa fa-cloud-upload text-da"></i></span></a>
                                </li>
                            </ul>

                        </section>
                    </aside>
                </div>

                <div class="col-md-4">
                    <aside class="profile-nav alt">
                        <section class="card">
                            <div class="card-header user-header alt bg-login">
                                <div class="media d-flex align-items-center">
                                    <img src="assets/img/company.svg" width="32">
                                    <div class="media-body">
                                        <h5 class="font-w-300 display-6 pl-3 text-light">Administrar Empresas</h5>
                                    </div>
                                </div>
                            </div>

                            <ul class="list-group list-group-flush">
                                <li class="list-group-item">
                                    <a href="empresas.php">Agregar/Modificar <span class="pull-right"><i class="fa fa-plus text-success"></i></span></a>
                                </li>
                                <li class="list-group-item">
                                    <a href="empresas.php">Buscar Empresa <span class="pull-right"><i class="fa fa-search text-success"></i></span></a>
                                </li>
                            </ul>

                        </section>
                    </aside>
                </div>
                <?php } ?>     

            </div><!-- .row -->
        </div><!-- .animated -->
    </div><!-- .content -->
</div> <!--.Div que viene de header-->

<?php include 'inc/const.php' ?>

</body>

</html>
