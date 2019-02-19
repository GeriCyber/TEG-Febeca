<?php
require_once('inc/header.php');
require_once('inc/funciones_bd.php');
$db = new funciones_BD();
$fecha = $_GET['fecha'];
?>

<!--Div que viene de header_admin2-->
<div id="overlay">
    <div class="spinner"></div> 
</div>

    <div class="breadcrumbs">
        <div class="col-sm-12">
            <div class="page-header">
                <div class="page-title text-center">
                    <h1 class="text-muted">Ingresos del <?=$fecha ?></h1>
                </div>
            </div>
        </div>
    </div>

    <div class="content mt-3">
        <div class="row">
            <div class="col-md-12">
                <br/>

                <div class="panel panel-primary mt-3">
                    <table id="tabla_usuarios" class="table table-striped table-bordered table-responsive-sm">
                        <thead>
                            <th>Nombre</th>
                            <th>Apellido</th>
                            <th>Cedula</th>
                            <th>Telefono</th>
                            <th>Correo</th>
                            <th>Sucursal</th>
                            <th width="120">Ultimo Ingreso</th>
                            <th width="80" class="text-center"># Ingresos</th>
                        </thead>
                        <tbody id="tabla" class="pb-3">
                            <?php
                            $usuarios = $db->GetLogsUsersFromDate($fecha);
                            ?>

                            <?php foreach ($usuarios as $usuario)
                            { ?>
                                <tr>
                                    <td style="vertical-align: middle;"><?=$usuario['nombre']; ?></td>
                                    <td style="vertical-align: middle;"><?=$usuario['apellido']; ?></td>
                                    <td style="vertical-align: middle;"><?=$usuario['cedula']; ?></td>
                                    <td style="vertical-align: middle;"><?=$usuario['telefono']; ?></td>  
                                    <td style="vertical-align: middle;"><?=$usuario['correo']; ?></td>  
                                    <td style="vertical-align: middle;"><?=$usuario['nombre_sucursal']; ?></td>
                                    <td style="vertical-align: middle;"><?=$usuario['last_date']; ?></td>
                                    <td style="vertical-align: middle;" class="text-center"><?=$usuario['cont_logs']; ?></td>
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

<!--Div que viene de header_admin2-->
</div>

<?php include 'inc/const.php' ?>

<script>
$(document).ready(function() 
{
    var table = $('#tabla_usuarios').DataTable({
        order: [[7, 'desc']],
        dom: 'Bfrtip',
        paging: true,
        autoWidth: true,
        buttons: [
            {
                extend: 'pdfHtml5',
                className: 'btn btn-success btn-pdf',
                //download: 'open',
                text: '<i class="fa fa-download"></i>&nbsp;&nbsp;Generar PDF',
                filename: 'empleados_por_fecha',
                orientation: 'landscape', //portrait
                pageSize: 'A4',
                exportOptions: {
                    columns: ':visible',
                    search: 'applied',
                    order: 'applied'
                },
                customize: function (doc) {
                    //Remove the title created by datatTables
                    doc.content.splice(0,1);
                    doc.pageMargins = [25,60,20,40];
                    doc.styles.tableHeader.fontSize = 10;
                    doc['header']=(function() {
                        return {
                            columns: [
                                {
                                    alignment: 'center',
                                    fontSize: 16,
                                    text: 'Ingresos por fecha'
                                }
                            ],
                            margin: 20
                        }
                    });

                    var objLayout = {};
                    objLayout['hLineWidth'] = function(i) { return .5; };
                    objLayout['vLineWidth'] = function(i) { return .5; };
                    objLayout['hLineColor'] = function(i) { return '#aaa'; };
                    objLayout['vLineColor'] = function(i) { return '#aaa'; };
                    objLayout['paddingLeft'] = function(i) { return 4; };
                    objLayout['paddingRight'] = function(i) { return 4; };
                    doc.content[0].layout = objLayout;
                }
            }
        ],        
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

});

</script>

</body>
