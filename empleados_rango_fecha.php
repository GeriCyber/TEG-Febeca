<?php
require_once('inc/header.php');
require_once('inc/funciones_bd.php');
$db = new funciones_BD();
?>

<!--Div que viene de header-->
<div id="overlay">
    <div class="spinner"></div> 
</div>
<div class="content mt-3">
    <div class="row">
            <div class="col-md-12">
                <br/>

                <div class="panel panel-primary mt-3">
                    <h4 class="mb-5 display-5 text-success text-center">Filtrar por rango de fechas</h4>
                    <div class="container ">
                        <div class="row form-group d-flex justify-content-center">
                            <label class="form-control-label mt-2" for="inicio">Desde: </label> 
                            <div class="col-12 col-md-3">
                                <div class="input-group date">
                                    <input name="inicio" id="inicio" type="text" class="form-control">
                                    <div class="input-group-addon">
                                        <i class="fa fa-calendar text-success"></i>
                                    </div>
                                </div>
                            </div>
                            <label class="form-control-label mt-2" for="fin">Hasta: </label>  
                            <div class="col-12 col-md-3">    
                                <div class="input-group date">
                                    <input name="fin" id="fin" type="text" class="form-control">
                                    <div class="input-group-addon">
                                        <i class="fa fa-calendar text-success"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <table id="tabla_usuarios" class="table table-striped table-bordered table-responsive-sm">
                        <thead>
                            <th>Nombre</th>
                            <th>Apellido</th>
                            <th>Cedula</th>
                            <th>Telefono</th>
                            <th width="20" class="text-center">Correo</th>
                            <th>Empresa</th>
                            <th width="120">Ultimo Ingreso</th>
                            <th width="80" class="text-center"># Ingresos</th>
                        </thead>
                        <tbody id="tabla" class="pb-3">
                            <?php
                            $usuarios = $db->GetAllLogsUsers();
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
            <br/>
            </div>
        </div>
    </div>

<!--Div que viene de header-->
</div>

<?php include 'inc/const.php' ?>
<script src="assets/js/bootstrap-datepicker.js"></script>

<script>
$(document).ready(function() 
{
    $.fn.dataTable.ext.search.push(
    function (settings, data, dataIndex) 
    {
        var inicio = $('#inicio').datepicker("getDate");
        var fin = $('#fin').datepicker("getDate");
        var fecha = data[6];
        fecha = fecha.slice(0, -8);
        var last_login = new Date(fecha);
        if (inicio == null && fin == null)
            return true; 
        if (inicio == null && last_login <= fin)
            return true;
        if(fin == null && last_login >= inicio)
            return true;
        if (last_login <= fin && last_login >= inicio)
            return true;
        return false;
    });
   
    $("#inicio").datepicker({ onSelect: function () { table.draw(); }, changeMonth: true, changeYear: true });
    $("#fin").datepicker({ onSelect: function () { table.draw(); }, changeMonth: true, changeYear: true });
    
    var table = $('#tabla_usuarios').DataTable({
        order: [[7, 'desc']],
        dom: 'Bfrtip',
        paging: true,
        autoWidth: true,
        buttons: [
            {
                extend: 'pdfHtml5',
                className: 'btn btn-danger btn-pdf',
                //download: 'open',
                text: '<i class="fa fa-download"></i>&nbsp;&nbsp;Generar PDF',
                filename: 'Empleados por rango de fechas',
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
                    var now = new Date();
                    var jsDate = now.getDate()+'-'+(now.getMonth()+1)+'-'+now.getFullYear();

                    // Header del PDF
                    doc['header']=(function() {
                        return {
                            columns: [
                                {
                                    alignment: 'center',
                                    fontSize: 16,
                                    text: 'Ingresos por rango de fecha'
                                }
                            ],
                            margin: 20
                        }
                    });

                    // Footer del PDF
                    doc['footer']=(function(page, pages) {
                        return {
                            columns: [
                                'Fecha: '+jsDate,
                                {
                                    // This is the right column
                                    alignment: 'right',
                                    text: ['Página ', { text: page.toString() },  ' de ', { text: pages.toString() }]
                                }
                            ],
                            margin: [10, 0]
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
            },
            {
                extend: 'excelHtml5',
                className: 'btn btn-success btn-pdf',
                text: '<i class="fa fa-download"></i>&nbsp;&nbsp;Generar EXCEL',
                filename: 'Ingresos por rango de fecha'
            },
        ],      
        language:
        {
            "sProcessing":     "Procesando...",
            "sLengthMenu":     "Mostrar _MENU_ registros",
            "sZeroRecords":    "No se encontraron resultados",
            "sEmptyTable":     "Ningún dato disponible en esta tabla",
            "sInfo":           "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
            "sInfoEmpty":      "Mostrando registros del 0 al 0 de un total de 0 registros",
            "sInfoFiltered":   "(filtrado de un total de _fin_ registros)",
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
    // Event listener to the two range filtering inputs to redraw on input
    $('#inicio, #fin').change(function () 
    {
        table.draw();
    });
});

</script>

</body>
