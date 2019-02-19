<?php
require_once('inc/header.php');
require_once('inc/funciones_bd.php');
$db = new funciones_BD();
$roles = $db->buscar_rol();
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
                <div class="botones">    
                    <div class="ml-3 float-left">
                        <a href="#myModal" class="btn-success btn text-white" data-toggle="modal" data-target="#myModalcrear">
                        <i class="fa fa-user-plus pl-2"></i>&nbsp;&nbsp;Agregar Usuario
                        </a>
                    </div>
                    <div class="ml-3 float-right btn-delete-right mr-3">
                        <a href="#ModalEliminarVarios" data-toggle="modal" data-target="#ModalEliminarVarios" id="btnEliminar" class="btn btn-danger text-white">
                        <i class="fa fa-trash pl-2 text-white"></i>&nbsp;&nbsp;Eliminar Seleccionados
                        </a>
                    </div>
                </div>
                <br/><br>

                <div id="overlay">
                    <div class="spinner"></div> 
                </div>

                <div class="panel panel-primary mt-3">
                    <table id="tabla_usuarios" class="table table-hover table-responsive-sm">
                        <thead>
                            <tr>
                                <th class="text-left"></th>
                                <th>Nombre</th>
                                <th>Apellido</th>
                                <th>Cedula</th>
                                <th>Telefono</th>
                                <th>Correo</th>
                                <th class="text-center">Empresa</th>
                                <th class="text-center">Rol</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr style="display: flex;justify-content: center;">
                                <th></th>
                                <th>Nombre</th>
                                <th>Apellido</th>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th class="text-center">Empresa</th>
                                <th class="text-center"></th>
                                <th></th>
                            </tr>
                        </tfoot>
                        <tbody id="tabla" class="pb-3">
                            <?php
                            $id_sucursal = !empty($_SESSION['id_sucursal']) ? $_SESSION['id_sucursal'] : 0;
                            $usuarios = $db->buscar_usuarios();
                            ?>

                            <?php foreach ($usuarios as $usuario)
                            { ?>
                                <tr>
                                    <td style="vertical-align: middle;" class="text-left"><?=$usuario['id_usuario']; ?></td>
                                    <td style="vertical-align: middle;"><?=$usuario['nombre']; ?></td>
                                    <td style="vertical-align: middle;"><?=$usuario['apellido']; ?></td>
                                    <td style="vertical-align: middle;"><?=$usuario['cedula']; ?></td>
                                    <td style="vertical-align: middle;"><?=$usuario['telefono']; ?></td>  
                                    <td style="vertical-align: middle;"><?=$usuario['correo']; ?></td>  
                                    <td style="vertical-align: middle;" class="text-center"><?=$usuario['nombre_sucursal']; ?></td>
                                    <td style="vertical-align: middle;" class="text-center"><?=$usuario['nombre_rol']; ?></td>
                                    <td style="vertical-align: middle;" class="text-center">
                                        <a href="#myModaleditar" class="btn btn-sm btn-secondary" data-toggle="modal" data-target="#myModaleditar" id="btn-edit" ><i class="fa fa-pencil text-white"></i></a>&nbsp;
                                        <a href="#myModalEliminar" class="btn btn-sm btn-danger"  data-toggle="modal" data-target="#myModalEliminar"><i class="fa fa-trash text-white"></i></a>
                                    </td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
                 <!--<br><p><b>ID de usuarios seleccionados: </b></p>
                 <pre id="example-console-rows"></pre>-->
            <br/>
            </div>
        </div>
    </div>

    <!--modal agregar usuario-->
    <div class="modal fade" id="myModalcrear">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <div class="mr-2"><img src="assets/img/user-add.svg" width="40"></div>
                    <h5 class="modal-title text-success mt-2">Agregar Usuario</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                        <i class="fa fa-times-circle"></i>
                    </button>
                </div>
                <div class="modal-body">

                    <form class="form-horizontal" method="post" autocomplete="off" action="inc/usuarios/registrar_usuario.php">
                        <fieldset>

                            <?php if (!empty($_SESSION["id_sucursal"])){ ?>
                                <input type="hidden" name="id_sucursal" id="empresa-nuevo" value="<?=$_SESSION['id_sucursal']; ?>" required />
                            <?php }else{ ?>
                                <div class="row form-group">
                                    <div class="col col-md-3">
                                        <label class="form-control-label" for="id_tipo_falla">Empresa</label>
                                    </div>
                                    <div class="col-md-8 col-12">
                                        <select name="id_sucursal" id="id_sucursal_nuevo" class="form-control">
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
                                    <label class="form-control-label" for="nombre">Nombre <b class="text-danger">*</b></label>
                                </div>
                                <div class="col-12 col-md-8">
                                    <input id="nombre_nuevo" maxlength="50" name="nombre" type="text" class="form-control input-md" required>
                                </div>
                            </div>

                            <div class="row form-group">
                                <div class="col col-md-3">
                                    <label class="form-control-label" for="apellido">Apellido <b class="text-danger">*</b></label>
                                </div>
                                <div class="col-md-8 col-12">
                                    <input id="apellido_nuevo" maxlength="50" name="apellido" type="text" class="form-control input-md" required>
                                </div>
                            </div>

                            <div class="row form-group">
                                <div class="col col-md-3">
                                    <label class="form-control-label" for="cedula">Cédula <b class="text-danger">*</b></label>
                                </div>
                                <div class="col-md-8 col-12">
                                    <input id="cedula_nuevo" name="cedula" type="text" placeholder="Ej: 15.698.412" class="form-control input-md" required>
                                </div>
                            </div>

                            <div class="row form-group">
                                <div class="col col-md-3">
                                    <label class="form-control-label" for="telefono">Teléfono <b class="text-danger">*</b></label>
                                </div>
                                <div class="col-md-8 col-12">
                                    <input id="telefono_nuevo" name="telefono" type="text" placeholder="Ej: 04128742563" class="form-control input-md" required>
                                </div>
                            </div>

                            <div class="row form-group">
                                <div class="col col-md-3">
                                    <label class="form-control-label" for="telefono">Correo <b class="text-danger">*</b></label>
                                </div>
                                <div class="col-md-8 col-12">
                                    <input id="correo_nuevo" name="correo" type="email" placeholder="Ej: email@gmail.com" class="form-control input-md" required>
                                </div>
                            </div>

                            <div class="row form-group">
                                <div class="col col-md-3">
                                    <label class="form-control-label" for="id_usuario">Nombre de Usuario&nbsp;<b class="text-danger">*</b></label>
                                </div>
                                <div class="col-md-8 col-12">
                                    <input id="id_usuario_nuevo" maxlength="40" name="id_usuario" type="text" placeholder="Ej: gericyber" class="form-control input-md" required minlength="3" maxlength="10">
                                </div>
                            </div>

                            <div class="row form-group">
                                <div class="col col-md-3">
                                    <label class="form-control-label" for="clave">Contraseña&nbsp;<b class="text-danger">*</b></label>
                                </div>
                                <div class="col-md-8 col-12">
                                    <input type="password" id="clave_nuevo" name="clave" class="form-control input-md" required>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col col-md-3">
                                    <label class="form-control-label" for="radios__rol">Asignar Rol</label>
                                </div>
                                <div class="col-md-9 col-12">

                                <?php $k = 0;
                                    foreach ($roles as $rol)
                                    { 
                                        if ($_SESSION['id_rol'] != "admin" && $rol["id_rol"] == "admin")
                                            continue;
                                ?>
                                    <div class="radio">
                                        <label for="radios_rol-<?= $k; ?>">
                                            <input type="radio" class="form-check-input" name="id_rol" id="radios_rol_nuevo-<?= $k; ?>" value="<?= $rol['id_rol']; ?>" <?= $k==0 ? "checked='true'" : ""; ?>>
                                            <?= $rol['descripcion']; ?>
                                        </label>
                                    </div>
                                <?php
                                    $k++;
                                    } 
                                ?>

                                </div>
                            </div>

                            <div class="form-group text-center">
                              <div class="col-md-12 pt-3">
                                  <button type="submit" class="btn btn-success loading" id="btn-agregar" 
                                  data-loading-text="<i class='fa fa-spinner fa-spin '></i> Agregando usuario...">Agregar Usuario</button>
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
    <!--fin modal agregar usuario-->

    <!--modal editar usuario-->
    <div class="modal fade" id="myModaleditar">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <div class="mr-2"><img src="assets/img/user-edit.svg" width="40"></div>
                    <h5 class="modal-title text-success mt-2">Modificar Usuario</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                        <i class="fa fa-times-circle"></i>
                    </button>
                </div>
                <div class="modal-body">

                <form class="form-horizontal" method="post" autocomplete="off" action="inc/usuarios/actualizar_usuario.php">
                <fieldset>

                    <?php if (!empty($_SESSION["id_sucursal"]))
                        { ?>
                            <input type="hidden" name="id_sucursal" id="empresa" value="<?=$_SESSION['id_sucursal']; ?>" />
                        <?php 
                        } else { ?>
                            <div class="row form-group">
                                <div class="col col-md-3">
                                    <label class="form-control-label" for="id_tipo_falla">Empresa</label>
                                </div>
                                <div class="col-md-8 col-12">
                                    <select id="id_sucursal" name="id_sucursal" class="form-control">
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
                    

                    <input type="hidden" name="id_usuario" class="oculto_id_usuario">

                    <div class="row form-group">
                        <div class="col col-md-3">
                            <label class="form-control-label" for="nombre">Nombre <b class="text-danger">*</b></label>
                        </div>
                        <div class="col-12 col-md-8">
                            <input id="nombre" maxlength="40" name="nombre" type="text" class="form-control input-md" required>
                        </div>
                    </div>

                    <div class="row form-group">
                        <div class="col col-md-3">
                            <label class="form-control-label" for="apellido">Apellido <b class="text-danger">*</b></label>
                        </div>
                        <div class="col-md-8 col-12">
                            <input id="apellido" maxlength="40" name="apellido" type="text" class="form-control input-md" required>
                        </div>
                    </div>

                    <div class="row form-group">
                        <div class="col col-md-3">
                            <label class="form-control-label" for="cedula">Cédula</label>
                        </div>
                        <div class="col-md-8 col-12">
                            <input id="cedula" name="cedula" type="text" placeholder="No se puede modificar" disabled="" class="form-control input-md">
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
                            <label class="form-control-label" for="telefono">Correo <b class="text-danger">*</b></label>
                        </div>
                        <div class="col-md-8 col-12">
                            <input id="correo" name="correo" type="email" placeholder="Ej: email@gmail.com" class="form-control input-md" required>
                        </div>
                    </div>

                    <div class="row form-group">
                        <div class="col col-md-3">
                            <label class="form-control-label" for="id_usuario">Nombre de Usuario</label>
                        </div>
                        <div class="col-md-8 col-12">
                            <input id="id_usuario" maxlength="40" name="id_usuario" type="text" class="form-control input-md" placeholder="No se puede modificar" disabled="">
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col col-md-3">
                            <label class="form-control-label" for="radios__rol">Asignar Rol</label>
                        </div>
                        <div class="col-md-9 col-12">

                        <?php $k = 0;
                            foreach ($roles as $rol)
                            { 
                                if ($_SESSION['id_rol'] != "admin" && $rol["id_rol"] == "admin")
                                    continue;
                        ?>
                            <div class="radio">
                                <label for="radios_rol-<?= $k; ?>">
                                    <input type="radio" class="form-check-input" name="id_rol" id="radios_rol-<?= $k; ?>" value="<?= $rol['id_rol']; ?>" <?= $k==0 ? "checked='true'" : ""; ?>>
                                    <?= $rol['descripcion']; ?>
                                </label>
                            </div>
                        <?php
                            $k++;
                            } 
                        ?>

                        </div>
                    </div>

                    <div class="form-group text-center">
                      <div class="col-md-12 pt-3">
                          <button type="submit" class="btn btn-success loading" id="btn-modificar" 
                          data-loading-text="<i class='fa fa-spinner fa-spin '></i> Modificando usuario...">Modificar Usuario</button>
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

    <!--fin modal editar usuario-->

    <!--modal eliminar usuario-->
    <div class="modal fade" id="myModalEliminar">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                   <div class="mr-2"><img src="assets/img/warning.svg" width="40"></div>
                    <h5 class="modal-title text-danger mt-2">Eliminar Usuario</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                        <i class="fa fa-times-circle"></i>
                    </button>
                </div>
                <div class="modal-body text-center">
                    <form method="post" action="inc/usuarios/eliminar_usuario.php">
                        <input type="hidden" name="id_usuario" class="oculto_id_usuario">
                        <div class="alert alert-danger py-3">¿Seguro que quieres eliminar este usuario?</div>
                        <button type="submit" class="btn btn-danger info loading" id="eliminar-usuario"
                        data-loading-text="<i class='fa fa-spinner fa-spin '></i> Eliminando usuario...">Eliminar</button>
                    </form>
                </div>
                <div class="modal-footer">
                    <a href="#" data-dismiss="modal" class="btn btn-secondary">Cancelar</a>
                </div>
            </div>
        </div>
    </div>
    <!--fin modal eliminar usuario-->

    <!--modal eliminar varios-->
    <div class="modal fade" id="ModalEliminarVarios">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <div class="mr-2"><img src="assets/img/warning.svg" width="40"></div>
                    <h5 class="modal-title text-danger mt-2">Eliminar Usuarios</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                        <i class="fa fa-times-circle"></i>
                    </button>
                </div>
                <div class="modal-body text-center">
                    <form method="post" action="inc/usuarios/eliminacion_masiva.php">
                        <input type="hidden" name="usuariosJSON" id="oculto_usuarios">
                        <div class="alert alert-danger py-3">¿Seguro que quieres eliminar los usuarios seleccionados?</div>
                        <button type="submit" class="btn btn-danger loading" id="eliminar_usuarios"
                        data-loading-text="<i class='fa fa-spinner fa-spin '></i> Eliminando usuarios...">Eliminar</button>
                    </form>
                </div>
                <div class="modal-footer">
                    <a href="#" data-dismiss="modal" class="btn btn-secondary">Cancelar</a>
                </div>
            </div>
        </div>
    </div>
    <!--fin modal eliminar varios-->

<!--Div que viene de header_admin2-->
</div>

<?php include 'inc/const.php' ?>

<script>
$(document).ready(function() 
{
    var table = $('#tabla_usuarios').DataTable({
        columnDefs: [
                {
                    targets: 0,
                    checkboxes: {
                        seletRow: true
                    }
                }
            ],
            select:{
                style: 'multi'
            },
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
            "searchPlaceholder": "Búsqueda General",
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

    $('#tabla_usuarios tfoot th').not(":eq(0),:eq(3),:eq(4),:eq(5),:eq(7),:eq(8)").each( function() 
    {
        var title = $('#tabla_usuarios tfoot th').eq( $(this).index() ).text();
        $(this).html('<div class="mr-3 mb-1"><input type="text" class="form-control input-search" placeholder="Buscar por '+title+'" /></div>');
    } );

    // Apply the search
    table.columns().eq(0).each( function (colIdx) 
    {
        if(colIdx == 0 || colIdx == 3 || colIdx == 4 || colIdx == 5 || colIdx == 7 || colIdx == 8) return; 
        $('input', table.column( colIdx ).footer() ).on( 'keyup change', function() 
        {
            table
                .column(colIdx)
                .search(this.value)
                .draw();
        });
    });
    $('#tabla_usuarios tfoot tr').insertBefore($('#tabla_usuarios'));

    //limpiar modal despues de cerrarlo
    $('#myModaleditar').on('hidden.bs.modal', function()
    {
        $(this).find('form')[0].reset();
     });
 
    $('#tabla_usuarios tbody').on( 'click', 'tr', function() 
    {
        if ( $(this).hasClass('selected') ) 
            $(this).removeClass('selected');
        else 
        {
            table.$('tr.selected').removeClass('selected');
            $(this).addClass('selected');
        }
        var fila_seleccionada = table.row(this).data();
        var id_usuario = fila_seleccionada[0];
        console.log(id_usuario);
        $('.oculto_id_usuario').attr('value', id_usuario);
    });  

    $('#eliminar_usuarios').attr('disabled', true);
    // capturando multiples usuarios a eliminar 
    $('#btnEliminar').click(function(e)
    {
        var datos = [];
        var rows_selected = table.column(0).checkboxes.selected();
        var itemSelected = [];

        // Iterate over all selected checkboxes
        $.each(rows_selected, function(index, rowId)
        {
            datos.push(rowId);
        });
        var itemSelected = JSON.stringify(datos);
        console.log(itemSelected);
        $('#oculto_usuarios').attr('value', itemSelected);
        if($.isEmptyObject(datos))
             $('#eliminar_usuarios').attr('disabled', true);
         else
            $('#eliminar_usuarios').attr('disabled', false);
      
        /* Output form data to a console     
        $('#example-console-rows').text(rows_selected.join(","));*/
           
        // Prevent actual form submission
        e.preventDefault();
   });

});

//loading actions
$('.loading').on('click', function() 
{
    if(this.id == 'btn-agregar')
    {
        if ($('#nombre_nuevo').val() && $('#apellido_nuevo').val() && $('#cedula_nuevo').val() && $('#telefono_nuevo').val() && $('#correo_nuevo').val() && $('#clave_nuevo').val() && $('#id_usuario_nuevo').val()) 
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
        if ($('#nombre').val() && $('#apellido').val() && $('#telefono').val() && $('#correo').val()) 
        {
            var $this = $(this);
            $this.button('loading');
            setTimeout(function() 
            {
               $this.button('reset');
            }, 1000000);
        }
    }
    else 
    {
        var $this = $(this);
        $this.button('loading');
        setTimeout(function() 
        {
           $this.button('reset');
        }, 1000000);
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