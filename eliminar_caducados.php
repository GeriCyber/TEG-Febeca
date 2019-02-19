<?php require_once('inc/header.php'); ?>

<?php
    require_once 'inc/funciones_bd.php';
    $db = new funciones_BD();
?>
<?php if(($_SESSION["id_rol"])=='admin') { ?>
<!--Div que viene de header-->
    <div class="breadcrumbs">
        <div class="col-sm-12">
            <div class="page-header">
                <div class="page-title text-center">
                    <h1 class="text-muted">Eliminar Contenidos Caducados</h1>
                </div>
            </div>
        </div>
    </div>

    <div class="content mt-3">
        <div class="animated fadeIn">
            <div class="row">
            	<div class="col-md-12">
	                <br/>
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
	                        
	                <?php }
	                    if(isset($_GET['exito']))
	                    { 
	                ?>
	                <div class="sufee-alert alert with-close alert-success alert-dismissible fade show mt-4">
	                    <span class="badge badge-pill badge-success">Éxito</span>
	                        <?php echo $_GET['exito']; ?>
	                      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
	                        <span aria-hidden="true">&times;</span>
	                    </button>
	                </div>
	                        
	                <?php } ?>
	                    
	                <div id="overlay">
	                    <div class="spinner"></div> 
	                </div>
	               	
	               	<div class="panel panel-primary mt-3">
	                    <?php
	                        $documentos = $db->ElementosCaducados('documentos', $eliminar=false);
	                        $videos = $db->ElementosCaducados('videos', $eliminar=false); ?>
	                        <div class="card">
                                <div class="card-header">
                                    <h4 class="text-danger pull-left">Contenidos Caducados</h4>
                                    <?php if(!empty($documentos) || !empty($videos)) { ?><a href="#myModalEliminar" data-toggle="modal" data-target="#myModalEliminar" class="btn-sm btn btn-danger pull-right text-white"><i class="fa fa-trash text-white"></i>&nbsp;&nbsp;Eliminar Todos</a> <?php } else { ?>
                                    <a href="#" data-toggle="modal" data-target="#myModalEliminar" class="btn-sm btn btn-danger pull-right text-white disabled"><i class="fa fa-trash text-white"></i>&nbsp;&nbsp;Eliminar Todos</a> <?php } ?>
                                </div>
                                <div class="card-body">
                                    <div class="default-tab">
                                        <nav>
                                            <div class="nav nav-tabs" id="nav-tab" role="tablist">
                                                <a class="nav-item nav-link active" id="nav-home-tab" data-toggle="tab" href="#nav-home" role="tab" aria-controls="nav-home" aria-selected="true">Documentos</a>
                                                <a class="nav-item nav-link" id="nav-profile-tab" data-toggle="tab" href="#nav-profile" role="tab" aria-controls="nav-profile" aria-selected="false">Vídeos</a>
                                            </div>
                                        </nav>
                                        <div class="tab-content pl-3 pt-2" id="nav-tabContent">
                                            <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
                                                <ul class="list-group list-group-flush"> 
                                                    <?php if(!empty($documentos)) { ?>
				                                    	<div class="text-center"><a href="documentos.php" class="btn btn-sm btn-success mt-1"><i class="fa fa-clock-o text-white"></i>&nbsp;&nbsp;Modificar fecha de caducidad</a></div><br>
	                                            		<?php foreach ($documentos as $documento) { 
                                                            $date = substr($documento['fecha_caducidad'], 0, -8);
                                                            $date = str_replace('/', '-', $date); ?>
						                                    <li class="list-group-item">
						                                        <i class="fa fa-file text-success"></i>&nbsp;&nbsp;&nbsp;<?=$documento['nombre']; ?> <span class="badge badge-danger pull-right"><?=$date ?></span>
						                                    </li> 
						                                <?php  } 
						                                } 
						                                else { ?> No hay Documentos caducados...
						                            <?php } ?>
				                                </ul>
                                            </div>
                                            <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
                                                <ul class="list-group list-group-flush">
                                                	<?php if(!empty($videos)) { ?>
                                                		<div class="text-center"><a href="videos.php" class="btn btn-sm btn-success mt-1"><i class="fa fa-clock-o text-white"></i>&nbsp;&nbsp;Modificar fecha de caducidad</a></div><br>
	                                            		<?php foreach ($videos as $video) { 
                                                            $date = substr($video['fecha_caducidad'], 0, -8);
                                                            $date = str_replace('/', '-', $date); ?>
						                                    <li class="list-group-item">
						                                        <i class="fa fa-play text-success"></i>&nbsp;&nbsp;&nbsp;<?=$video['nombre']; ?> <span class="badge badge-danger pull-right"><?=$date ?></span>
						                                    </li>
						                                <?php } 
						                                } 
						                                else { ?> No hay Videos caducados...
						                            <?php } ?>
				                                </ul>	
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
	                	</div>
	                <br/>

	            </div>
			</div>
        </div>
	</div>

	<div class="modal fade" id="myModalEliminar">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <div class="mr-2"><img src="assets/img/warning.svg" width="40"></div>
                    <h5 class="modal-title text-danger mt-2">Eliminar Contenidos</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                        <i class="fa fa-times-circle"></i>
                    </button>
                </div>
                <div class="modal-body text-center">
                    <div class="alert alert-danger py-3">¿Seguro que quieres eliminar estos contenidos?</div>
                    <a href="inc/caducados.php" class="btn btn-danger loading" 
                    data-loading-text="<i class='fa fa-spinner fa-spin '></i> Eliminando...">Eliminar</a>
                </div>
                <div class="modal-footer">
                    <a href="#" data-dismiss="modal" class="btn btn-secondary">Cancelar</a>
                </div>
            </div>
        </div>
    </div>

<!--Div que viene de header-->
</div>
    
<?php include 'inc/const.php' ?>
<script>
//loading actions
$('.loading').on('click', function() 
{
    var $this = $(this);
    $this.button('loading');
    setTimeout(function() 
    {
       $this.button('reset');
    }, 600000);
});
</script>

<?php } else { ?>
  <div class="container mt-2">
    <div class="alert alert-danger text-center" role="alert">
        <h6>No tienes permisos para ver esto!</h6>
    </div>
  </div> <?php } ?>

</body>
</html>