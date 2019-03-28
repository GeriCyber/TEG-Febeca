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
                    <h1 class="text-muted">Auditoría</h1>
                </div>
            </div>
        </div>
    </div>

    <div class="content mt-3">
        <div class="row">
            <div class="col-md-12">
                <br/>
                <div id="overlay">
                    <div class="spinner"></div> 
                </div>

                <div class="panel panel-primary mt-3">
                    <table class="table table-hover table-responsive-sm" id="tabla_videos">
                        <thead>
                        <tr>
                            <th>Usuario</th>
                            <th class="text-center">Empresa</th>
                            <th class="text-center">Acción</th>
                            <th>Elemento</th>
                            <th>Fecha</th>
                        </tr>
                        </thead>
                        <tbody id="tabla" class="pb-3">
                        <?php
                            $elementos = $db->GetAuditoria();
                            foreach ($elementos as $elemento)
                            { ?>
                                <tr>
                                    <td style="vertical-align: middle;"><?=$elemento['usuario'] ?></td>
                                    <td style="vertical-align: middle;" class="text-center">
                                        <?php if(!empty($elemento['empresa'])) { ?><?=$elemento['empresa'] ?> <?php } else {echo '-';} ?>
                                    </td>
                                    <td style="vertical-align: middle;" class="text-center"><?=$elemento['accion'] ?></td>
                                    <td style="vertical-align: middle;"><?=$elemento['elemento'] ?></td>
                                    <td style="vertical-align: middle;"><?=$elemento['fecha'] ?></td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
                <br/>
            </div>
        </div>
    </div>

</div>

<?php include 'inc/const.php' ?>

<script>
$(document).ready(function() 
{
    //inicializando datatble con los datos
    var table = $('#tabla_videos').DataTable({
        order: [[0, 'asc']],
        dom: 'Bfrtip',
        paging: true,
        autoWidth: true,
        buttons: [
            {
                extend: 'pdfHtml5',
                className: 'btn btn-danger btn-pdf',
                //download: 'open',
                text: '<i class="fa fa-download"></i>&nbsp;&nbsp;Generar PDF',
                filename: 'auditoria',
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
                    doc.pageMargins = [60,60,40,40];
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
                                    text: 'Auditoría'
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
                filename: 'Auditoría'
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
<?php } else { ?>
  <div class="container mt-2">
    <div class="alert alert-danger text-center" role="alert">
        <h6>No tienes permisos para ver esto!</h6>
    </div>
  </div> <?php } ?>
</body>
</html>