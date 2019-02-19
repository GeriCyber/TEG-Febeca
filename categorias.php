<?php require_once('inc/header.php'); ?>
<?php require_once('inc/funciones_bd.php'); ?>
<?php
$db = new funciones_BD();
?>

<?php if(($_SESSION["id_rol"])=='admin') { ?>
<!--Div que viene de header-->
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
                    <a href="#myModal" class="btn-success btn btn-lg text-white" data-toggle="modal" data-target="#myModalcrear"><i class="fa fa-tag"></i>&nbsp;&nbsp;Ingresar Categoría</a>
                
                <div id="overlay">
                    <div class="spinner"></div> 
                </div>

                <div class="panel panel-primary mt-3">
                    <table class="table table-hover table-responsive-sm" id="tabla-categorias">
                        <thead>
                        <tr>
                            <th class="d-none"></th>
                            <th>Nombre</th>
                            <th>Empresa</th>
                            <th class="text-center">Acciones</th>

                        </tr>
                        </thead>
                        <tbody id="tabla" class="pb-3">
                        <?php
                            $categorias = $db->listar_categorias();
                            foreach ($categorias as $categoria)
                            { ?>
                                <tr>
                                    <td class="d-none"><?=$categoria['id_categoria']; ?></td>
                                    <td style="vertical-align: middle;"><?=$categoria['descripcion']; ?></td> 
                                    <td style="vertical-align: middle;"><?=$categoria['nombre']; ?></td>
                                    <td style="vertical-align: middle;" class="text-center">
                                        <a href="#myModal" class="btn btn-sm btn-secondary" data-toggle="modal" data-target="#myModaleditar" id="btn-edit" ><i class="fa fa-pencil text-white"></i></a>&nbsp;
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

    <!--modal agregar categoria-->
    <div class="modal fade" id="myModalcrear">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <div class="mr-2"><img src="assets/img/add-tag.svg" width="40"></div>
                    <h5 class="modal-title text-success mt-2">Agregar Categoría</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                        <i class="fa fa-times-circle"></i>
                    </button>
                </div>
                <div class="modal-body">

                    <form class="form-horizontal" method="post" action="inc/categorias/agregar_categoria.php" autocomplete="off">

                        <fieldset>
                            <?php if (!empty($_SESSION["id_sucursal"])){ ?>
                                <input type="hidden" name="id_sucursal" id="empresa-nuevo" value="<?=$_SESSION['id_sucursal']; ?>" required />
                            <?php }else{ ?>
                            <div class="row form-group">
                                <div class="col col-md-3">
                                    <label class="form-control-label" for="id_tipo_falla">Empresa</label>
                                </div>
                                <div class="col-md-8 col-12">
                                    <select name="id_sucursal" class="form-control" id="empresa">
                                <?php 
                                $empresas = $db->buscar_sucursales();
                                foreach ($empresas as $empresa)
                                { ?>
                                    <option value=<?=$empresa["id_sucursal"]; ?> ><?=$empresa["nombre"]; ?></option>
                                <?php } ?>
                                    </select>
                                </div>
                            </div>
                        <?php } ?>

                            <div class="row form-group">
                                <div class="col col-md-3">
                                    <label class="form-control-label" for="descripcion">Nombre&nbsp;<b class="text-danger">*</b></label>
                                </div>
                                <div class="col-12 col-md-8">
                                    <input id="descripcion" maxlength="80" name="descripcion" type="text" class="form-control input-md" required>
                                </div>
                            </div>

                            <div class="form-group text-center">
                              <div class="col-md-12 pt-3">
                                  <button type="submit" name="btn_ingresar" class="btn btn-success loading" id="btn-agregar"
                                  data-loading-text="<i class='fa fa-spinner fa-spin '></i> Agregando categoría...">Agregar Categoría</button>
                              </div>
                            </div>
                        </fieldset>
                    </form>
                </div>
                <div class="modal-footer">
                    <a href="#" data-dismiss="modal" class="btn btn-secondary">Cerrar</a>
                </div>
            </div>
        </div>
    </div>
    <!--fin modal agregar categoria-->

    <!--modal modificar categoria-->
    <div class="modal fade" id="myModaleditar">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <div class="mr-2"><img src="assets/img/edit-tag.svg" width="40"></div>
                    <h5 class="modal-title text-success mt-2">Modificar Categoría</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                        <i class="fa fa-times-circle"></i>
                    </button>
                </div>
                <div class="modal-body">

                    <form class="form-horizontal" method="post" action="inc/categorias/modificar_categoria.php" autocomplete="off">
                        <input type="hidden" name="id_categoria" class="oculto_id_categoria">
                        <fieldset>

                            <?php if (!empty($_SESSION["id_sucursal"])){ ?>
                                <input type="hidden" name="id_sucursal" id="empresa-nuevo" value="<?=$_SESSION['id_sucursal']; ?>" required />
                            <?php }else{ ?>
                            <div class="row form-group">
                                <div class="col col-md-3">
                                    <label class="form-control-label" for="id_tipo_falla">Empresa</label>
                                </div>
                                <div class="col-md-8 col-12">
                                    <select name="id_sucursal" class="form-control" id="empresa">
                                <?php 
                                $empresas = $db->buscar_sucursales();
                                foreach ($empresas as $empresa)
                                { ?>
                                    <option value=<?=$empresa["id_sucursal"]; ?> ><?=$empresa["nombre"]; ?></option>
                                <?php } ?>
                                    </select>
                                </div>
                            </div>
                        <?php } ?>

                            <div class="row form-group">
                                <div class="col col-md-3">
                                    <label class="form-control-label" for="descripcion">Nombre&nbsp;<b class="text-danger">*</b></label>
                                </div>
                                <div class="col-12 col-md-8">
                                    <input id="descripcion-mod" name="descripcion" type="text" class="form-control input-md" required>
                                </div>
                            </div>

                            <div class="form-group text-center">
                              <div class="col-md-12 pt-3">
                                  <button type="submit" name="btn_ingresar" class="btn btn-success loading" id="btn-modificar"
                                  data-loading-text="<i class='fa fa-spinner fa-spin '></i> Modificando categoría...">Modificar Categoría</button>
                              </div>
                            </div>
                        </fieldset>
                    </form>
                </div>
                <div class="modal-footer">
                    <a href="#" data-dismiss="modal" class="btn btn-secondary">Cerrar</a>
                </div>
            </div>
        </div>
    </div>
    <!--fin modal modificar categoria-->

    <!--modal eliminar categoria-->
    <div class="modal fade" id="myModalEliminar">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <div class="mr-2"><img src="assets/img/warning.svg" width="40"></div>
                    <h5 class="modal-title text-danger mt-2">Eliminar Categoría</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                        <i class="fa fa-times-circle"></i>
                    </button>
                </div>
                <div class="modal-body text-center">
                    <form method="post" action="inc/categorias/eliminar_categoria.php">
                        <input type="hidden" name="id_categoria" class="oculto_id_categoria">
                        <div class="alert alert-danger py-3">¿Seguro que quieres eliminar esta categoría?</div>
                        <button type="submit" class="btn btn-danger loading" id="btn-eliminar"
                        data-loading-text="<i class='fa fa-spinner fa-spin '></i> Eliminando categoría...">Eliminar</button>
                    </form>
                </div>
                <div class="modal-footer">
                    <a href="#" data-dismiss="modal" class="btn btn-secondary">Cancelar</a>
                </div>
            </div>
        </div>
    </div>
    <!--fin modal eliminar categoria-->

<!--Div que viene de header_admin2-->
</div>

<?php include 'inc/const.php' ?>

<script>
$(document).ready(function() 
{
    var table = $('#tabla-categorias').DataTable({
        order: [[1, 'asc']],
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

    //limpiar modal despues de cerrarlo
    $('#myModaleditar').on('hidden.bs.modal', function()
    {
        $(this).find('form')[0].reset();
    });

    $('#tabla-categorias tbody').on( 'click', 'tr', function() 
    {
        if ( $(this).hasClass('selected') ) 
            $(this).removeClass('selected');
        else 
        {
            table.$('tr.selected').removeClass('selected');
            $(this).addClass('selected');
        }
        var fila_seleccionada = table.row(this).data();
        var id_categoria = fila_seleccionada[0];
        console.log(id_categoria);
        $('.oculto_id_categoria').attr('value', id_categoria);
    } );
});

//loading actions
$('.loading').on('click', function() 
{
    if(this.id == 'btn-agregar')
    {
        if ($('#descripcion').val()) 
        {
            var $this = $(this);
            $this.button('loading');
            setTimeout(function() 
            {
               $this.button('reset');
           }, 600000);
        }
    }
    else if(this.id == 'btn-modificar')
    {
        if ($('#descripcion-mod').val()) 
        {
            var $this = $(this);
            $this.button('loading');
            setTimeout(function() 
            {
               $this.button('reset');
            }, 600000);
        }
    }
    else 
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