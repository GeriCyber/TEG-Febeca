<?php require_once('inc/header.php'); ?>
<?php require_once('inc/funciones_bd.php'); ?>
<?php $db = new funciones_BD(); ?>

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

                <a href="#myModal" class="ml-3 btn-success btn btn-lg text-white" data-toggle="modal" data-target="#myModalcrear">
                    <i class="fa fa-building-o pl-2"></i>&nbsp;&nbsp;Agregar Empresa
                </a>
                <br>
                
                <div id="overlay">
                    <div class="spinner"></div> 
                </div>

                <div class="panel panel-primary mt-3">
                    <table class="table table-hover table-responsive-sm mb-5" id="tabla-empresas">
                        <thead>
                        <tr>
                            <th class="d-none"></th>
                            <th>Nombre</th>
                            <th>Dirección</th>
                            <th>Teléfono</th>
                            <th>Correo</th>
                            <th>Logo</th>
                            <th>Acciones</th>
                        </tr>
                        </thead>
                        <tbody id="tabla" class="pb-3">
                        <?php
                            $empresas = $db->buscar_sucursales();
                            foreach ($empresas as $empresa)
                            { ?>
                                <tr>
                                    <td class="d-none"><?=$empresa['id_sucursal']; ?></td>
                                    <td style="vertical-align: middle;"><?=$empresa['nombre']; ?>
                                        <?php if($empresa['estatus'] == 0) { ?><span class="badge badge-danger">Inactiva</span><?php } ?></td>
                                    <td style="vertical-align: middle;"><?=$empresa['direccion']; ?></td>
                                    <td style="vertical-align: middle;"><?=$empresa['telefono']; ?></td>    
                                    <td style="vertical-align: middle;"><?=$empresa['correo']; ?></td>
                                    <td style="vertical-align: middle;" width="100">
                                        <?php if (!empty($empresa['logo']))
                                            { ?>
                                                <img width="100" src="uploads/<?=$empresa['logo'] ?>"> <?php } 
                                            else { ?> Sin Logo <?php } ?>
                                    </td>
                                    <td class="text-center" style="vertical-align: middle;">
                                        <a href="#myModal" class="btn btn-sm btn-secondary" data-toggle="modal" data-target="#myModaleditar" id="btn-edit" ><i class="fa fa-pencil text-white"></i></a>&nbsp;
                                        <?php if($empresa['estatus'] == 1) { ?><a href="#myModalDesactivar" class="btn btn-sm btn-danger" data-toggle="modal" data-target="#myModalDesactivar"><i class="fa fa-minus-circle text-white"></i></a><?php } else { ?><a href="#myModalActivar" class="btn btn-sm btn-success" data-toggle="modal" data-target="#myModalActivar"><i class="fa fa-check text-white"></i></a><?php } ?>
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

    <!--modal agregar empresa-->
    <div class="modal fade" id="myModalcrear">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <div class="mr-2"><img src="assets/img/add.svg" width="40"></div>
                    <h5 class="modal-title text-success mt-2">Agregar Empresa</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                        <i class="fa fa-times-circle"></i>
                    </button>
                </div>
                <div class="modal-body">

                    <form class="form-horizontal" enctype="multipart/form-data" method="post" action="inc/empresas/registrar_empresa.php" autocomplete="off">

                        <fieldset>
                            <div class="row form-group">
                                <div class="col col-md-3">
                                    <label class="form-control-label" for="nombre">Nombre <b class="text-danger">*</b></label>
                                </div>
                                <div class="col-12 col-md-8">
                                    <input id="nombre" maxlength="60" name="nombre" type="text" class="form-control input-md" required>
                                </div>
                            </div>
                            <div class="row form-group">
                                <div class="col col-md-3">
                                    <label class="form-control-label" for="direccion">Dirección <b class="text-danger">*</b></label>
                                </div>
                                <div class="col-12 col-md-8">
                                    <input id="direccion" maxlength="125" name="direccion" type="text" class="form-control input-md" required>
                                </div>
                            </div>

                            <div class="row form-group">
                                <div class="col col-md-3">
                                    <label class="form-control-label" for="telefono">Teléfono <b class="text-danger">*</b></label>
                                </div>
                                <div class="col-md-8 col-12">
                                    <input id="telefono" name="telefono" type="text" placeholder="Ej: 04128742563" class="form-control input-md" required>
                                </div>
                            </div>

                            <div class="row form-group">
                                <div class="col col-md-3">
                                    <label class="form-control-label" for="correo">Correo Electrónico <b class="text-danger">*</b></label>
                                </div>
                                <div class="col-md-8 col-12">
                                    <input id="correo" name="correo" type="email" placeholder="enterpriseca@gmail.com" class="form-control input-md" required>
                                </div>
                            </div>

                            <div class="row form-group">
                                <div class="col col-md-3">
                                    <label class="form-control-label" for="logo">Logo</label>
                                </div>
                                <div class="col-md-8 col-12">
                                    <input id="archivo" name="archivo" onchange="return fileValidation('archivo')" type="file" class="btn btn-secondary btn-sm">
                                </div>
                            </div>

                            <div class="form-group text-center">
                              <div class="col-md-12 pt-3">
                                  <button type="submit" name="btn_ingresar" id="btn-agregar" class="btn btn-success loading" 
                                  data-loading-text="<i class='fa fa-spinner fa-spin '></i> Agregando Empresa...">Agregar Empresa</button>
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
    <!--fin modal agregar empresa-->

    <!--modal modificar empresa-->
    <div class="modal fade" id="myModaleditar">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <div class="mr-2"><img src="assets/img/settings.svg" width="40"></div>
                    <h5 class="modal-title text-info mt-2">Modificar Empresa</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                        <i class="fa fa-times-circle"></i>
                    </button>
                </div>
                <div class="modal-body">

                    <form class="form-horizontal" enctype="multipart/form-data" method="post" action="inc/empresas/actualizar_empresa.php" autocomplete="off">

                        <fieldset>
                            <input type="hidden" name="id_sucursal" class="oculto_id_empresa">
                            <div class="row form-group">
                                <div class="col col-md-3">
                                    <label class="form-control-label" for="nombre">Nombre <b class="text-danger">*</b></label>
                                </div>
                                <div class="col-12 col-md-8">
                                    <input id="nombre-mod" maxlength="50" name="nombre" type="text" class="form-control input-md" required>
                                </div>
                            </div>
                            <div class="row form-group">
                                <div class="col col-md-3">
                                    <label class="form-control-label" for="direccion">Dirección <b class="text-danger">*</b></label>
                                </div>
                                <div class="col-12 col-md-8">
                                    <input id="direccion-mod" maxlength="125" name="direccion" type="text" class="form-control input-md" required>
                                </div>
                            </div>

                            <div class="row form-group">
                                <div class="col col-md-3">
                                    <label class="form-control-label" for="telefono">Teléfono <b class="text-danger">*</b></label>
                                </div>
                                <div class="col-md-8 col-12">
                                    <input id="telefono-mod" name="telefono" type="text" placeholder="Ej: 04128742563" class="form-control input-md" required>
                                </div>
                            </div>

                            <div class="row form-group">
                                <div class="col col-md-3">
                                    <label class="form-control-label" for="correo">Correo Electrónico <b class="text-danger">*</b></label>
                                </div>
                                <div class="col-md-8 col-12">
                                    <input id="correo-mod" name="correo" type="email" placeholder="enterpriseca@gmail.com" class="form-control input-md" required>
                                </div>
                            </div>

                            <div class="row form-group">
                                <div class="col col-md-3">
                                    <label class="form-control-label" for="logo">Logo</label>
                                </div>
                                <div class="col-md-8 col-12">
                                    <input id="archivoEdit" onchange="return fileValidation('archivoEdit')" name="archivo" type="file" class="btn btn-secondary btn-sm">
                                </div>
                            </div>

                            <div class="form-group text-center">
                              <div class="col-md-12 pt-3">
                                  <button type="submit" name="btn_ingresar" id="btn-modificar" class="btn btn-success loading" 
                                  data-loading-text="<i class='fa fa-spinner fa-spin '></i> Modificando Empresa...">Modificar Empresa</button>
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
    <!--fin modal modificar empresa-->

    <!--modal activar empresas-->
    <div class="modal fade" id="myModalActivar">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <div class="mr-2"><i class='fa fa-check fa-3x text-success'></i></div>
                    <h5 class="modal-title text-success mt-2">Activar Empresa</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                        <i class="fa fa-times-circle"></i>
                    </button>
                </div>
                <div class="modal-body text-center">
                    <form method="post" action="inc/empresas/activar_empresa.php">
                        <input type="hidden" name="id_sucursal" class="oculto_id_empresa">
                        <div class="alert alert-success py-3">¿Seguro que quieres activar esta empresa?</div>
                        <button type="submit" class="btn btn-success loading" 
                        data-loading-text="<i class='fa fa-spinner fa-spin '></i> Activando Empresa...">Activar</button>
                    </form>
                </div>
                <div class="modal-footer">
                    <a href="#" data-dismiss="modal" class="btn btn-secondary">Cancelar</a>
                </div>
            </div>
        </div>
    </div>
    <!--fin modal activar empresas-->

    <!--modal desactivar empresas-->
    <div class="modal fade" id="myModalDesactivar">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <div class="mr-2"><img src="assets/img/warning.svg" width="40"></div>
                    <h5 class="modal-title text-danger mt-2">Desactivar Empresa</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                        <i class="fa fa-times-circle"></i>
                    </button>
                </div>
                <div class="modal-body text-center">
                    <form method="post" action="inc/empresas/desactivar_empresa.php">
                        <input type="hidden" name="id_sucursal" class="oculto_id_empresa">
                        <div class="alert alert-danger py-3">¿Seguro que quieres desactivar esta empresa?</div>
                        <button type="submit" class="btn btn-danger loading" 
                        data-loading-text="<i class='fa fa-spinner fa-spin '></i> Desactivando Empresa...">Desactivar</button>
                    </form>
                </div>
                <div class="modal-footer">
                    <a href="#" data-dismiss="modal" class="btn btn-secondary">Cancelar</a>
                </div>
            </div>
        </div>
    </div>
    <!--fin modal desactivar empresas-->
<!--Div que viene de header-->
</div>

<?php include 'inc/const.php' ?>

<script>
$(document).ready(function() 
{
    var table = $('#tabla-empresas').DataTable({
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

    $('#tabla-empresas tbody').on( 'click', 'tr', function() 
    {
        if ( $(this).hasClass('selected') ) 
            $(this).removeClass('selected');
        else 
        {
            table.$('tr.selected').removeClass('selected');
            $(this).addClass('selected');
        }
        var fila_seleccionada = table.row(this).data();
        var id_empresa = fila_seleccionada[0];
        var empresa = fila_seleccionada[1];
        /*console.log(empresa);*/
        var direccion = fila_seleccionada[2];
        var telefono = fila_seleccionada[3];
        var correo = fila_seleccionada[4];
        /*console.log(id_empresa);*/
        $('.oculto_id_empresa').attr('value', id_empresa);
        $('#nombre-mod').attr('value', empresa);
        $('#direccion-mod').attr('value', direccion);
        $('#telefono-mod').attr('value', telefono);
        $('#correo-mod').attr('value', correo);
    } );
});

//loading actions
$('.loading').on('click', function() 
{
    if(this.id == 'btn-agregar')
    {
        if ($('#nombre').val() && $('#direccion').val() && $('#correo').val() && $('#telefono').val()) 
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
        if ($('#nombre-mod').val() && $('#direccion-mod').val() && $('#correo-mod').val() && $('#telefono-mod').val()) 
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

//Validacion de tipo de archivo
function fileValidation(archivo)
{
    var fileInput = document.getElementById(archivo);
    var filePath = fileInput.value;
    var allowedExtensions = /(\.png|\.jpeg|\.jpg)$/i;
    if(!allowedExtensions.exec(filePath))
    {
        alert('Por favor adjunta un logo con alguna de las siguientes extensiones: .png .jpeg .jpg');
        fileInput.value = '';
        return false;
    }
}
</script>
<?php } else { ?>
  <div class="container mt-2">
    <div class="alert alert-danger text-center" role="alert">
        <h6>No tienes permisos para ver esto!</h6>
    </div>
  </div> <?php } ?>
</body>
</html>