<?php require_once('inc/header.php'); ?>
<?php require_once('inc/funciones_bd.php'); ?>
<?php 
$db = new funciones_BD(); 
?>

<?php if(($_SESSION["id_rol"])=='admin') { ?>
<!--Div que viene de header-->
    <div class="breadcrumbs">
          <div class="col-sm-12">
              <div class="page-header">
                  <div class="page-title text-center">
                      <h1 class="text-muted">Valoraciones</h1>
                  </div>
              </div>
          </div>
    </div>
    <div class="content mt-3">
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
                    <table id="tabla_valoraciones" class="table table-striped table-bordered table-responsive-sm">
                        <thead>
                            <tr>
                              <th class="d-none"></th>
                                <th>Fecha</th>
                                <th>Usuario</th>
                                <th>Video</th>
                                <th>Comentario</th>
                                <th class="text-center">Valoración</th>
                                <th class="text-center">Eliminar</th>
                            </tr>
                        </thead>
                        <tbody id="tabla">
                            <?php $comentarios = $db->buscar_comentarios();
                              foreach ($comentarios as $item)
                              { 
                                //$signo = $item['valoracion'] > 0 ? "+" : ""; ?>
                              <tr>
                                  <td class="d-none"><?=$item['id_comentario']; ?></td>
                                  <td><?=$item['fecha']; ?></td>
                                  <td><?=$item['id_usuario']; ?></td>
                                  <td>
                                  	<a href="videos.php" class="text-success"><?=$item['nombre_video']; ?>
                                  	</a>
                                  </td>
                                  <td><?=$item['comentario']; ?></td>
                                  <td class="text-center">
                                  	<?php
                                  		if($item['valoracion'] == 1)
                                  			{ ?> <i class="fa fa-star text-warning"></i> <?php } 
                                  		else if($item['valoracion'] == -1) 
                                  			{ ?> <i class="fa fa-star-o text-warning"></i> <?php } 
                                  				else if(($item['valoracion'] == 0)) 
                                  					{ ?> <i class="fa fa-star-half-o text-warning"></i> <?php } ?>
                                  </td>
                                  <td class="text-center">
                                      <a href="#myModalEliminar" class="btn btn-sm btn-danger" data-toggle="modal" data-target="#myModalEliminar"><i class="fa fa-trash text-white"></i></a>
                                  </td>
                              </tr>
                        <?php } ?>
                    </tbody>
                  </table>
                </div>
                <br/>
            </div>
        </div>
    </div>

    <!--modal eliminar comentario-->
    <div class="modal fade" id="myModalEliminar">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <div class="mr-2"><img src="assets/img/warning.svg" width="40"></div>
                    <h5 class="modal-title text-danger mt-2">Eliminar Valoración</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                        <i class="fa fa-times-circle"></i>
                    </button>
                </div>
                <div class="modal-body text-center">
                    <form method="post" action="inc/comentarios/eliminar_comentario.php">
                        <input type="hidden" name="id_comentario" class="oculto_id_comentario" id="coment">
                        <div class="alert alert-danger py-3">¿Seguro que quieres eliminar este comentario?</div>
                        <button type="submit" class="btn btn-danger loading" 
                        data-loading-text="<i class='fa fa-spinner fa-spin '></i> Eliminando comentario...">Eliminar</button>
                    </form>
                </div>
                <div class="modal-footer">
                    <a href="#" data-dismiss="modal" class="btn btn-secondary">Cancelar</a>
                </div>
            </div>
        </div>
    </div>
    <!--fin modal eliminar comentario-->
<!--Div que viene de header-->
</div>
    
<?php include 'inc/const.php' ?>

<script>
$(document).ready(function() 
{
    var table = $('#tabla_valoraciones').DataTable({
        order: [[2, 'desc']],
        language:
        {
            "sProcessing":     "Procesando...",
            "sLengthMenu":     "Mostrar _MENU_ registros",
            "sZeroRecords":    "No se encontraron resultados",
            "sEmptyTable":     "Ningún dato disponible en esta tabla",
            "sInfo":           "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
            "sInfoEmpty":      "Mostrando registros del 0 al 0 de un total de 0 registros",
            "sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
            "sInfoPostFix":    "",
            "sSearch":         "Buscar:",
            "sUrl":            "",
            "sInfoThousands":  ",",
            "sLoadingRecords": "Cargando...",
            "oPaginate": 
            {
                "sFirst":    "Primero",
                "sLast":     "Último",
                "sNext":     "Siguiente",
                "sPrevious": "Anterior"
            },
            "oAria": 
            {
                "sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
                "sSortDescending": ": Activar para ordenar la columna de manera descendente"
            }
        }
    });
 
    $('#tabla_valoraciones tbody').on( 'click', 'tr', function() 
    {
        if ( $(this).hasClass('selected') ) 
            $(this).removeClass('selected');
        else 
        {
            table.$('tr.selected').removeClass('selected');
            $(this).addClass('selected');
        }
        var fila_seleccionada = table.row(this).data();
        var id_comentario = fila_seleccionada[0];
        console.log(id_comentario);
        $('.oculto_id_comentario').attr('value', id_comentario);
    } );  

});

//loading actions
$('.loading').on('click', function() 
{
    if ($('#coment').val()) 
    {
        var $this = $(this);
        $this.button('loading');
        setTimeout(function() 
        {
           $this.button('reset');
       }, 600000);
    }
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