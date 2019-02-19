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
                    <a href="#myModal" class="btn-success btn btn-lg text-white" data-toggle="modal" data-target="#myModalcrear"><i class="fa fa-file"></i>&nbsp;&nbsp;Ingresar Documento</a> 
                <div id="overlay">
                    <div class="spinner"></div> 
                </div>

                <div class="panel panel-primary mt-3">
                    <table class="table table-hover table-responsive-sm" id="tabla_documentos">
                        <thead>
                            <tr>
                                <th class="d-none"></th>
                                <th class="d-none"></th>
                                <th>Nombre</th>
                                <th class="text-center">Empresas</th>
                                <th class="text-center">Categorías</th>
                                <th>Descripción</th>
                                <th class="text-center">Documento</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody id="tabla">
                            <?php
                                $documentos = $db->listar_documentos();
                                foreach ($documentos as $documento) 
                                {  ?>
                                <tr>
                                    <td class="d-none"><?=$documento['id_documento']; ?></td>
                                    <td class="d-none"><?=$documento['etiqueta']; ?></td>
                                    <td style="vertical-align: middle;"><?=$documento['nombre']; ?>
                                    <?php if($documento['etiqueta'] == 'Si') 
                                    {  
                                        $date = substr($documento['fecha_caducidad'], 0, -8);
                                        $date = str_replace('/', '-', $date); ?>
                                        &nbsp;&nbsp;<br><span class="badge badge-danger text-left disabled">Valido hasta:<br>
                                        <i class="fa fa-clock-o text-white"></i>&nbsp;<?=$date ?></span> 
                                    <?php } ?></td>
                                    <td style="vertical-align: middle;" class="text-center">
                                        <?php $asignados = $db->documentos_asignados($documento['id_documento']); 
                                        if(count($asignados) > 0)
                                        {
                                            $empresa='';
                                            foreach ($asignados as $asignado) 
                                            { 
                                                if($empresa != $db->GetEmpresaName($asignado['id_sucursal'])) 
                                                {
                                                    $empresa = $db->GetEmpresaName($asignado['id_sucursal']);
                                                    echo $empresa;
                                                    if ($asignado !== end($asignados)) 
                                                    { ?><div class="pb-1"></div><?php }
                                                } 
                                            }
                                        }
                                        else 
                                        { ?> <span class="badge badge-success">Sin asignar</span> <?php } ?>
                                    </td>
                                    <td style="vertical-align: middle;" class="text-center">
                                        <?php $asignados = $db->documentos_asignados($documento['id_documento']); 
                                        if(count($asignados) > 0)
                                        {
                                            foreach ($asignados as $asignado) 
                                            { 
                                                $categoria = $db->GetCategoryName($asignado['id_categoria']); 
                                                echo $categoria;
                                                if ($asignado !== end($asignados)) 
                                                { ?><div class="pb-1"></div><?php }
                                            }
                                        }
                                        else 
                                        { ?> <span class="badge badge-success">Sin asignar</span>  <?php } ?>
                                    </td>
                                    </td>
                                    <td style="vertical-align: middle;"><?=$documento['descripcion']; ?></td>
                                    <td style="vertical-align: middle;" class="text-center">
                                        <?php
                                            $ext = $documento['archivo'];
                                            $tipo = pathinfo($ext, PATHINFO_EXTENSION); 
                                            if($tipo == 'doc' || $tipo == 'docx') {
                                        ?>
                                        <img src="assets/img/word.svg" width="100"> <?php } else { ?>
                                        <object width="260" height="200" data="<?='uploads/'.$documento['archivo']; ?>"></object><?php } ?>
                                    </td>                  
                                    <td style="vertical-align: middle;" class="text-center">
                                        <a class="btn btn-sm btn-success mb-2" href="<?='uploads/'.$documento['archivo']; ?>" download="<?=$documento['archivo_mostrar']; ?>"><i class="fa fa-download text-white"></i></a><br>
                                        <a href="#myModaleditar" class="btn btn-sm btn-secondary mb-2" data-toggle="modal" data-target="#myModaleditar" id="btn-edit"><i class="fa fa-tags text-white"></i></a><br>
                                        <a href="#myModalEliminar" class="btn btn-sm btn-danger" data-toggle="modal" data-target="#myModalEliminar">
                                        <i class="fa fa-trash text-white"></i></a>
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

    <!--modal agregar documento-->
    <div class="modal fade" id="myModalcrear">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <div class="mr-2"><img src="assets/img/add-document.svg" width="40"></div>
                    <h5 class="modal-title text-success mt-2">Agregar Documento</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                        <i class="fa fa-times-circle"></i>
                    </button>
                </div>
                <div class="modal-body">

                    <form class="form-horizontal" enctype="multipart/form-data" method="post" autocomplete="off" action="inc/documentos/registrar_documento.php">
                        <fieldset>

                            <div class="row form-group">
                                <div class="col col-md-3">
                                    <label class="form-control-label" for="nombre">Nombre del Documento&nbsp;<b class="text-danger">*</b></label>
                                </div>
                                <div class="col-12 col-md-8">
                                    <input name="nombre" maxlength="50" id="nombre" type="text" class="form-control input-md" required>
                                </div>
                            </div>

                            <div class="row form-group">
                                <div class="col col-md-3">
                                    <label class="form-control-label" for="descripcion">Descripción del Documento&nbsp;<b class="text-danger">*</b></label>
                                </div>
                                <div class="col-md-8 col-12">
                                    <input id="descripcion" maxlength="130" name="descripcion" type="text" class="form-control input-md" required>
                                </div>
                            </div>

                            <div class="row form-group" id="div_video_nuevo">
                                <div class="col col-md-3">
                                    <label class="form-control-label" for="documento">Adjuntar Documento&nbsp;<b class="text-danger">*</b></label>
                                </div>
                                <div class="col-md-8 col-12">
                                    <input id="archivo" onchange="return fileValidation('archivo')" name="archivo" type="file" class="btn btn-secondary btn-sm" required>
                                </div>
                            </div>

                            <div class="form-group text-center">
                              <div class="col-md-12 pt-3">
                                  <button type="submit" class="btn btn-success loading" id="btn-agregar"
                                data-loading-text="<i class='fa fa-spinner fa-spin '></i> Agregando documento...">Agregar Documento</button>
                              </div>
                            </div>

                        </fieldset>
                    </form>
                </div>
                <div class="modal-footer">
                    <a href="#" data-dismiss="modal" class="btn btn-secondary">Cancelar</a>
                </div>
            </div>
        </div>
    </div>
    <!--Fin modal agregar documento-->

    <!--modal asignar documento-->
    <div class="modal fade" id="myModaleditar">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <div class="mr-2"><img src="assets/img/edit-document.svg" width="40"></div>
                    <h5 class="modal-title text-info mt-2">Asignar/Desasignar Documento</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                        <i class="fa fa-times-circle"></i>
                    </button>
                </div>
                <div class="modal-body">

                    <form class="form-horizontal" method="post" autocomplete="off" enctype="multipart/form-data" action="inc/documentos/asignar_documento.php">
                    <fieldset>

                        <input type="hidden" name="id_documento" class="oculto_id_documento">
                        <input type="hidden" name="etiqueta_hidden" id="etiqueta_hidden">

                        <div class="row form-group">
                            <div class="col col-md-3">
                                <label class="form-control-label" for="nombre">Asignar Empresas</label>
                            </div>
                            <div class="col-12 col-md-8">
                                <select data-placeholder="Seleccionar" multiple class="form-control standardSelect" id="empresas">
                                    <option value=""></option>
                                    <?php 
                                    if (empty($_SESSION["id_sucursal"])) {
                                        $empresas = $db->buscar_sucursales();
                                        foreach ($empresas as $empresa)
                                        { 
                                            if(!empty($db->buscar_categoria($empresa["id_sucursal"]))) { ?>
                                            <option value=<?=$empresa["id_sucursal"]; ?> ><?=$empresa["nombre"]; ?></option>
                                            <?php } 
                                        } 
                                    } else { ?>
                                        <option value=<?=$_SESSION["id_sucursal"]; ?> ><?=$db->GetEmpresaName($_SESSION["id_sucursal"]); ?></option>
                                    <?php } ?>
                                    <input type="hidden" name="empresas" id="op_seleccionadas">
                                </select>
                                <span class="help-block text-muted">Dejar vacío para desasignsar</span>
                            </div>
                        </div>

                        <div class="row form-group" id="cat-box">
                            <div class="col col-md-3">
                                <label class="form-control-label" for="nombre">Categorías</label>
                            </div>
                            <div class="col-12 col-md-8">
                                <select data-placeholder="Seleccionar" name="categorias" multiple class="standardSelect" tabindex="5" id="categorias">
                                <option value=""></option>
                                <input type="hidden" name="cats" id="cats">
                              </select>
                              <?php if(empty($db->buscar_categoria($_SESSION["id_sucursal"])) && !empty($_SESSION["id_sucursal"]) ) { ?><span class="help-block text-danger"><?=$db->GetEmpresaName($_SESSION["id_sucursal"])?> no tiene categorías</span> <?php } else { ?>
                              <span class="help-block text-muted">Dejar vacío para desasignsar</span> <?php } ?>
                            </div>
                        </div>

                        <div class="row form-group">
                            <div class="col col-md-3">
                                <label class="form-control-label" id="label-etiq" for="etiqueta"></label>
                            </div>
                            <div class="col-md-8 col-12">
                                <input type="checkbox" class="custom-checkbox" id="checkbox_etiqueta2" name="checkbox_etiqueta">
                                <label for="checkbox_etiqueta2" id="label-fecha"></label>
                                <br>
                                <div class="input-group date" id="datetimepicker3" data-target-input="nearest">
                                    <input type="text" name="fecha_caduc" class="form-control datetimepicker-input" id="fecha_caduc2" placeholder="Seleccionar fecha" data-target="#datetimepicker3"/>
                                    
                                    <div class="input-group-append" data-target="#datetimepicker3" data-toggle="datetimepicker">
                                    <div class="input-group-text"><i class="fa fa-calendar text-success"></i></div>
                                    </div>
                                </div>
                            </div>
                            <input type="hidden" name="cambiar_fecha" id="cambiar_fecha">
                        </div>

                        <div class="form-group text-center">
                          <div class="col-md-12 pt-3">
                              <button type="submit" class="btn btn-success loading" id="btn-asignar"
                              data-loading-text="<i class='fa fa-spinner fa-spin '></i> Aplicando...">Asignar Documento</button>
                          </div>
                        </div>

                        </fieldset>
                    </form>
                </div>
                <div class="modal-footer">
                    <a href="#" data-dismiss="modal" class="btn btn-secondary">Cancelar</a>
                </div>
            </div>
        </div>
    </div>
    <!--Fin modal asignar documento-->

    <!--modal eliminar documento-->
    <div class="modal fade" id="myModalEliminar">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <div class="mr-2"><img src="assets/img/warning.svg" width="40"></div>
                    <h5 class="modal-title text-danger mt-2">Eliminar Documento</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                        <i class="fa fa-times-circle"></i>
                    </button>
                </div>
                <div class="modal-body text-center">
                    <form method="post" action="inc/documentos/eliminar_documento.php">
                        <input type="hidden" name="id_documento" class="oculto_id_documento">
                        <div class="alert alert-danger py-3">¿Seguro que quieres eliminar este documento?</div>
                        <button type="submit" class="btn btn-danger loading" id="btn-eliminar"
                        data-loading-text="<i class='fa fa-spinner fa-spin '></i> Eliminando documento...">Eliminar</button>
                    </form>
                </div>
                <div class="modal-footer">
                    <a href="#" data-dismiss="modal" class="btn btn-secondary">Cancelar</a>
                </div>
            </div>
        </div>
    </div>
    <!--fin modal eliminar documento-->
<!--Div que viene de header-->
</div>
    
<?php include 'inc/const.php' ?>
<script src="assets/js/lib/chosen/chosen.jquery.min.js"></script>
<script src="assets/js/moment_locale.js"></script>

<script>
$(document).ready(function() 
{
    var table = $('#tabla_documentos').DataTable({
        order: [[2, 'asc']],
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
 
    $('#tabla_documentos tbody').on( 'click', 'tr', function() 
    {
        if ( $(this).hasClass('selected') ) 
            $(this).removeClass('selected');
        else 
        {
            table.$('tr.selected').removeClass('selected');
            $(this).addClass('selected');
        }
        var fila_seleccionada = table.row(this).data();
        var id_documento = fila_seleccionada[0];
        var etiqueta = fila_seleccionada[1];
        $('.oculto_id_documento').attr('value', id_documento);
        if(etiqueta == 'Si')
        {
            $('#label-etiq').html('Etiquetado');
            $('#label-fecha').html('&nbsp;&nbsp;Cambiar fecha de caducidad');
        }
        else
        {
            $('#label-etiq').html('Etiquetar');
            $('#label-fecha').html('&nbsp;&nbsp;Agregar fecha de caducidad');
        }
    } );  

    //limpiar modal despues de cerrarlo
    $('#myModaleditar').on('hidden.bs.modal', function()
    {
        $(this).find('form')[0].reset();
        $('#datetimepicker3').hide();
        $('.standardSelect').val('').trigger('chosen:updated');
        $('#cat-box').hide();
        $('#cambiar_fecha').attr('value', 'No');
        //$('#btn-asignar').attr("disabled", true);
    });

    //Validacion de checkbox etiqueta
    //$('#btn-asignar').attr("disabled", true);
    $('#datetimepicker3').hide();
    $('#cambiar_fecha').attr('value', 'No');
    $('input[id="checkbox_etiqueta2"]').on('click', function () 
    {
        if ($(this).prop('checked')) 
        {
            $('#datetimepicker3').fadeIn();
            $('#fecha_caduc2').attr('required', 'true');
            $('#cambiar_fecha').attr('value', 'Si');
            //$('#btn-asignar').attr("disabled", false);
        }
        else 
        {
            $('#datetimepicker3').hide();
            $('#fecha_caduc2').removeAttr('required');
            $('#cambiar_fecha').attr('value', 'No');
            //$('#btn-asignar').attr("disabled", true);
        }
    });
    moment.locale('es');
    $('#datetimepicker3').datetimepicker({
        locale: 'es',
        widgetPositioning: {
            vertical: 'bottom'
        }
    });

    jQuery(".standardSelect").chosen({
        disable_search_threshold: 10,
        no_results_text: "No se encontro nada!",
        width: "100%"
    });
    
    $("#empresas").chosen().change(function(e, params)
    {
        values = $("#empresas").chosen().val();
        var seleccionadas = JSON.stringify(values);
        $('#op_seleccionadas').attr('value', seleccionadas);
        console.log(seleccionadas);
    });

    $("#categorias").chosen().change(function(e, params)
    {
        values = $("#categorias").chosen().val();
        var seleccionadas = JSON.stringify(values);
        $('#cats').attr('value', seleccionadas);

        /*if(jQuery.isEmptyObject(values))
            $('#btn-asignar').attr("disabled", true);
        else
            $('#btn-asignar').attr("disabled", false);*/
    });

    //Llenando las categorias mediante ajax
    var categorias = $('#categorias');
    $('#cat-box').hide();
    //Ejecutar accion al cambiar de opcion en el select de las empresas
    $('#empresas').change(function()
    {
      var empresas = $('#op_seleccionadas').val(); 
      //console.log(empresas);
      if($.isEmptyObject(empresas) != true)          
      { 
        $('#cat-box').show(500);
        /*Inicio de llamada ajax*/
        $.ajax({
            data: 
            {
                empresas:empresas
            }, 
            dataType: 'html', 
            type: 'POST', 
            url: 'inc/obtener_categorias.php' 
        }).done(function(data)
        {          
            categorias.html(data);
            console.log(data);              
            categorias.trigger("chosen:updated");
        });
      }
      else 
        $('#cat-box').hide();
    });
});

//Validacion del tipo de archivo
function fileValidation(archivo)
{
    //console.log(archivo);
    var fileInput = document.getElementById(archivo);
    var filePath = fileInput.value;
    var allowedExtensions = /(\.pdf|\.doc|\.docx|\.txt|\.png|\.jpeg|\.jpg)$/i;
    if(!allowedExtensions.exec(filePath))
    {
        alert('Por favor adjunta un documento con alguna de las siguientes extensiones .pdf .doc .docx .txt .png');
        fileInput.value = '';
        return false;
    }
    if(fileInput.files[0].size > 50000000)
    {
       alert("El tamaño maximo es de 50 Mb!");
       fileInput.value = "";
    }
}

//loading actions
$('.loading').on('click', function() 
{
    if(this.id == 'btn-agregar')
    {
        if ($('#archivo').val() && $('#nombre').val() && $('#descripcion').val()) 
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