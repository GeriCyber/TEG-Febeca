<?php require_once('inc/header.php'); ?>

<?php
    require_once 'inc/funciones_bd.php';
    $db = new funciones_BD();
    $hoy = date("m-d-Y g:i A");
    $hoy = substr($hoy, 0, -8);
?>

<!--Div que viene de header-->
    <div class="breadcrumbs">
        <div class="col-sm-12">
            <div class="page-header">
                <div class="page-title text-center">
                    <h1 class="text-muted">Reportes</h1>
                </div>
            </div>
        </div>
    </div>

    <div class="content mt-3" id="reporte">
        <div class="animated fadeIn">
            <div class="container">
                <div class="col-md-6 col-lg-4">
                    <div class="card text-white bg-flat-color-1">
                        <div class="card-body pb-0">
                            <div class="dropdown float-right">
                                <button class="btn bg-transparent dropdown-toggle theme-toggle text-light" type="button" id="dropdownMenuButton" data-toggle="dropdown">
                                    <i class="fa fa-cog"></i>
                                </button>
                                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                    <div class="dropdown-menu-content">
                                        <!--<a class="dropdown-item" href="#SeleccionarFecha" data-toggle="modal" data-target="#SeleccionarFecha">Ingresos por fecha</a><-->
                                        <a class="dropdown-item" href="empleados_rango_fecha.php">Filtrar por rango de fechas</a>
                                        <a class="dropdown-item" href="#SeleccionarEmpresa" data-toggle="modal" data-target="#SeleccionarEmpresa">Ingresos por empresa</a>
                                        <a class="dropdown-item" href="registro_total_ingresos.php">Registro total de ingresos</a>
                                    </div>
                                </div>
                            </div>
                            
                            <p class="text-light">Hoy han ingresado</p>
                            <h4 class="mb-4">
                                <span class="count">
                                    <?php 
                                        echo $usuarios = count($db->GetLogsUsersFromDate($hoy)); 
                                    ?>  
                                </span>&nbsp;&nbsp;Empleados&nbsp;<i class="fa fa-user"></i>
                            </h4>

                            <div class="chart-wrapper px-0" style="height:70px;" height="70"/>
                                <canvas id="widgetChart1"></canvas>
                            </div>

                        </div>

                    </div>
                </div>
                <!--/.col-->

                <div class="col-md-6 col-lg-4">
                    <div class="card text-white bg-flat-color-2">
                        <div class="card-body pb-0">
                            <div class="dropdown float-right">
                                <button class="btn bg-transparent dropdown-toggle theme-toggle text-light" type="button" id="dropdownMenuButton" data-toggle="dropdown">
                                    <i class="fa fa-cog"></i>
                                </button>
                                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                    <div class="dropdown-menu-content">
                                        <a class="dropdown-item" href="videos_mas_vistos.php">Vídeos más vistos</a>
                                        <a class="dropdown-item" href="videos_vistas_incompletas.php">Vídeos con vistas imcompletas</a>
                                        <a class="dropdown-item" href="documentos_mas_vistos.php">Documentos más vistos</a>
                                    </div>
                                </div>
                            </div>
                            
                            <?php 
                                $documento = $db->GetMostViewedDocument(1);
                                $doc = '';
                                $val = 0;
                                if(!empty($documento))
                                {
                                    if(strlen($documento[0]['nombre']) > 20) 
                                    {
                                        $doc = substr($documento[0]['nombre'],0,20).'... tiene';
                                        $val = $documento[0]['vistas'];
                                    }
                                        
                                    else 
                                        $doc = $documento[0]['nombre'].' tiene';
                                } else { echo 'Sin visualizaciones'; } ?>
                            <p class="text-light"><?=$doc ?></p>
                            <h4 class="mb-4">
                                <span class="count"><?=$val ?></span>&nbsp;&nbsp;vistas&nbsp;<i class="fa fa-eye"></i>
                            </h4>

                            <div class="chart-wrapper px-0" style="height:70px;" height="70"/>
                                <canvas id="widgetChart2"></canvas>
                            </div>

                        </div>
                    </div>
                </div>
                <!--/.col-->

                <div class="col-md-6 col-lg-4">
                    <div class="card text-white bg-success">
                        <div class="card-body pb-0">
                            <div class="dropdown float-right">
                                <button class="btn bg-transparent dropdown-toggle theme-toggle text-white" type="button" id="dropdownMenuButton" data-toggle="dropdown">
                                    <i class="fa fa-cog"></i>
                                </button>
                                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                    <div class="dropdown-menu-content">
                                        <a class="dropdown-item" href="videos_mas_valorados.php">Vídeos más valorados</a>
                                        <a class="dropdown-item" href="videos_menos_valorados.php">Vídeos menos valorados</a>
                                        <a class="dropdown-item" href="videos_valoracion_neutral.php">Vídeos con valoracion neutral</a>
                                        <a class="dropdown-item" href="reportes_total_valoraciones.php">Registro total de valoraciones</a>
                                    </div>
                                </div>
                            </div>
                            <?php
                                $video = $db->GetMostCommentedVideo(); $vid=''; $val=0;
                                if(!empty($video))
                                {
                                    if(strlen($video['nombre']) > 20) 
                                        $vid = substr($video['nombre'],0,20).'... tiene';
                                    else
                                         $vid = $video['nombre'].' tiene';
                                    $val = $video['comentarios'];
                                } else { echo 'Sin valoraciones'; } ?>
                            <p class="text-light"><?=$vid ?></p>
                            <h4 class="mb-4">
                                <span class="count"><?=$val ?></span>&nbsp;&nbsp;Valoraciones Positivas&nbsp;<i class="fa fa-star"></i>
                            </h4>

                        </div>

                            <div class="chart-wrapper px-0" style="height:70px;" height="70"/>
                                <canvas id="widgetChart3"></canvas>
                            </div>
                    </div>
                </div>

                <div class="col-lg-12 mb-4">
                    <div class="card">
                        <div class="card-body" >
                            <h4 class="mb-sm-3 mb-lg-5 text-muted float-left">Empresas con más empleados activos</h4><button onclick="saveAsPDF('#EmpresasIngresos', 'Empresas con más empleados activos');" class="btn-download btn btn-success float-right" ><i class="fa fa-download"></i> Descargar</button>
                            <canvas id="EmpresasIngresos"></canvas>                         
                        </div>
                    </div>
                </div><!-- /# column -->

                <div class="col-lg-12 mb-4">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="mb-sm-3 mb-lg-5 text-muted float-left">Los 10 Empleados con más ingresos</h4>
                            <button onclick="saveAsPDF('#IngresosUsers', 'Los 10 Empleados con más ingresos');" class="btn-download btn btn-success float-right"><i class="fa fa-download"></i> Descargar</button>
                            <canvas id="IngresosUsers"></canvas>
                        </div>
                    </div>
                </div><!-- /# column -->

                <div class="col-lg-12 mb-4">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="mb-sm-3 mb-lg-5 text-muted float-left">Documentos más vistos</h4>
                            <button onclick="saveAsPDF('#DocumentosViews', 'Documentos más vistos');" class="btn-download btn btn-success float-right"><i class="fa fa-download"></i> Descargar</button>
                            <canvas id="DocumentosViews"></canvas>
                        </div>
                    </div>
                </div><!-- /# column -->

                <div class="col-lg-12 mb-4">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="mb-sm-3 mb-lg-5 text-muted float-left">Los 3 vídeos más vistos</h4>
                            <button onclick="saveAsPDF('#MostViewedVideos', 'Los 3 videos más vistos');" class="btn-download btn btn-success float-right"><i class="fa fa-download"></i> Descargar</button>
                            <canvas id="MostViewedVideos"></canvas>
                        </div>
                    </div>
                </div><!-- /# column -->
            
            </div>
        </div>
    </div>

    <!--modal seleccionar fecha -->
    <!--<div class="modal fade" id="SeleccionarFecha">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <div class="mr-2"><img src="" width="40"></div>
                    <h5 class="modal-title text-success mt-2">Seleccionar Fecha</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                        <i class="fa fa-times-circle"></i>
                    </button>
                </div>
                <div class="modal-body">

                    <form class="form-horizontal" method="GET" action="empleados_por_fecha.php">

                        <fieldset>

                            <div class="row form-group">
                                <div class="col col-md-3">
                                    <label class="form-control-label" for="id_tipo_falla">Fechas Disponibles</label>
                                </div>
                                <div class="col-md-8 col-12">
                                    <select name="fecha" class="form-control">
                                <?php /*
                                $fechas = $db->GetAvailableDates();
                                $disponibles = array_unique($fechas, SORT_REGULAR);
                                ?>
                                <option value="<?php echo $hoy; ?>" >Hoy</option>
                                <?php foreach ($disponibles as $disponible)
                                { ?>
                                    <option value="<?=$disponible["last_date"]; ?>"><?=$disponible["last_date"]; ?></option>
                                <?php } */?>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group text-center">
                              <div class="col-md-12 pt-3">
                                  <button type="submit" name="submit" class="btn btn-success">Enviar</button>
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
    </div><-->
    <!--fin modal seleccionar fecha-->

    <!--modal seleccionar empresa -->
    <div class="modal fade" id="SeleccionarEmpresa">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <div class="mr-2"><img src="" width="40"></div>
                    <h5 class="modal-title text-success mt-2">Seleccionar Empresa</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                        <i class="fa fa-times-circle"></i>
                    </button>
                </div>
                <div class="modal-body">

                    <form class="form-horizontal" method="GET" action="empleados_por_empresa.php">

                        <fieldset>

                            <div class="row form-group">
                                <div class="col col-md-3">
                                    <label class="form-control-label" for="id_tipo_falla">Empresas con ingresos registrados</label>
                                </div>
                                <div class="col-md-8 col-12">
                                    <select name="empresa" class="form-control">
                                <?php 
                                $empresas = $db->GetAvailableEmpresas();
                                foreach ($empresas as $empresa)
                                { ?>
                                    <option value="<?=$empresa["id_sucursal"]; ?>"><?=$empresa["nombre"]; ?></option>
                                <?php } ?>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group text-center">
                              <div class="col-md-12 pt-3">
                                  <button type="submit" name="submit" class="btn btn-success">Enviar</button>
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
    <!--fin modal seleccionar empresa-->

</div>

<?php include 'inc/const.php' ?>

<script src="assets/js/lib/chart-js/Chart.bundle.js"></script>
<script src="assets/js/widgets.js"></script>
<script src="assets/js/html2canvas.min.js"></script>
<script src="assets/js/jsPDF.min.js"></script>

<script>

    Chart.plugins.register({
    afterDraw: function(chart) 
    {
        if (chart.data.datasets.length === 0) 
        {
            // No data is present
            var ctx = chart.chart.ctx;
            var width = chart.chart.width;
            var height = chart.chart.height
            chart.clear();
          
            ctx.save();
            ctx.textAlign = 'center';
            ctx.textBaseline = 'middle';
            ctx.font = "16px normal 'Quicksand'";
            ctx.fillText('Sin registros...', width / 2, height / 2);
            ctx.restore();
        }
    }  });

    // Top 4 empresas con mas usuarios activos
    var ctx = document.getElementById( "EmpresasIngresos" );
    ctx.height = 100;
    var myChart = new Chart( ctx, {
        type: 'doughnut',
        defaultFontFamily: 'Quicksand',
        data: 
        {
            datasets: [ {
		                data: [ 
		                        <?php
		                            $ingresos = $db->GetMostActiveUsersFromEmpesas();
		                            foreach ($ingresos as $usuarios) 
		                            { ?>
		                                '<?=$usuarios['ingresos'] ?>',
		                            <?php } ?>
		                 		],
		                backgroundColor: [
		                                    "rgba(0, 123, 255,0.9)",
		                                    "#1874c3",
		                                    "rgba(0, 123, 255,0.5)",
		                                    "#dbedf3"
		                                ],
		                hoverBackgroundColor: [
		                                    "rgba(0, 123, 255,0.9)",
		                                    "#1874c3",
		                                    "rgba(0, 123, 255,0.5)",
		                                    "#dbedf3"
		                                ]
                        } ],
            labels: [
                       <?php
                            $empresas = $db->GetMostActiveUsersFromEmpesas();
                            foreach ($empresas as $empresa) 
                            { ?>
                                '<?=$empresa['nombre_sucursal'] ?>',
                            <?php } ?> 
                    ],
        },
        options: {
            responsive: true,
            tooltips: {
                mode: 'index',
                titleFontSize: 12,
                titleFontFamily: 'Quicksand',
                bodyFontFamily: 'Quicksand',
            },
            legend: {
                labels: {
                    usePointStyle: true,
                    fontFamily: 'Quicksand',
                },
            },
        }
    } );

    // Top 10 Ususarios que mas ingresan
    var ctx = document.getElementById("IngresosUsers");
    ctx.height = 100;
    var myChart = new Chart( ctx, {
        type: 'line',
        data: {
            labels: [ 
                <?php
                    $max = $db->GetMaxUsersLogs();
                    foreach ($max as $usuario) 
                    { ?>
                        '<?=$usuario['nombre'] ?>',
                <?php } ?>
            ],
            type: 'line',
            defaultFontFamily: 'Quicksand',
            datasets: [ {
                label: 'Ingresos',
                data: [ 
                    <?php
                        $max = $db->GetMaxUsersLogs();
                        foreach ($max as $usuario) 
                        { ?>
                            '<?=$usuario['cont_logs'] ?>',
                        <?php } ?>
                ],
                backgroundColor: 'transparent',
                borderColor: '#62E18E',
                borderWidth: 3,
                pointStyle: 'circle',
                pointRadius: 5,
                pointBorderColor: 'transparent',
                pointBackgroundColor: '#62E18E',
                    } ]
        },
        options: {
            responsive: true,

            tooltips: {
                mode: 'index',
                titleFontSize: 12,
                titleFontColor: '#000',
                bodyFontColor: '#000',
                backgroundColor: '#fff',
                titleFontFamily: 'Quicksand',
                bodyFontFamily: 'Quicksand',
                cornerRadius: 3,
                intersect: false,
            },
            legend: {
                display: false,
                labels: {
                    usePointStyle: true,
                    fontFamily: 'Quicksand',
                },
            },
            scales: {
                xAxes: [ {
                    display: true,
                    gridLines: {
                        display: false,
                        drawBorder: false
                    },
                    scaleLabel: {
                        display: false,
                        labelString: 'Fecha',
                        fontFamily: 'Quicksand'
                    }
                        } ],
                yAxes: [ {
                    display: true,
                    gridLines: {
                        display: false,
                        drawBorder: false
                    },
                    scaleLabel: {
                        display: true,
                        labelString: '# de Ingresos',
                        fontFamily: 'Quicksand'
                    }
                        } ]
            }
        }
    });

    // Top 4 documentos mas vistos
    var ctx = document.getElementById( "DocumentosViews" );
    ctx.height = 100;
    var myChart = new Chart( ctx, {
        type: 'line',
        data: {
            labels: [ 
                <?php
                    $documentos = $db->GetMostViewedDocument(6);
                    foreach ($documentos as $documento) 
                    { ?>
                        '<?=$documento['nombre'] ?>',
                <?php } ?>
             ],
            type: 'line',
            defaultFontFamily: 'Quicksand',
            datasets: [ {
                data: [ 
                    <?php
                        $max = $db->GetMostViewedDocument(6);
                        foreach ($max as $usuario) 
                        { ?>
                            '<?=$usuario['vistas'] ?>',
                    <?php } ?>
                 ],
                label: "Visualizaciones",
                backgroundColor: 'rgba(0,103,255,.15)',
                borderColor: 'rgba(0,103,255,0.5)',
                borderWidth: 3.5,
                pointStyle: 'circle',
                pointRadius: 5,
                pointBorderColor: 'transparent',
                pointBackgroundColor: 'rgba(0,103,255,0.5)',
                    }, ]
        },
        options: {
            responsive: true,
            tooltips: {
                mode: 'index',
                titleFontSize: 12,
                titleFontColor: '#000',
                bodyFontColor: '#000',
                backgroundColor: '#fff',
                titleFontFamily: 'Quicksand',
                bodyFontFamily: 'Quicksand',
                cornerRadius: 3,
                intersect: false,
            },
            legend: {
                display: false,
                position: 'top',
                labels: {
                    usePointStyle: true,
                    fontFamily: 'Quicksand',
                },

            },
            scales: {
                xAxes: [ {
                    display: true,
                    gridLines: {
                        display: false,
                        drawBorder: false
                    },
                    scaleLabel: {
                        display: false,
                        labelString: 'Documentos'
                    }
                        } ],
                yAxes: [ {
                    display: true,
                    gridLines: {
                        display: false,
                        drawBorder: false
                    },
                    scaleLabel: {
                        display: true,
                        labelString: '# de Vistas'
                    },
                    ticks: {
                          beginAtZero: true,
                          callback: function(value) {if (value % 1 === 0) {return value;}}
                        }
                    } ]
            },
            title: {
                display: false,
            }
        }
    } );

    // Top 3 Videos mas vistos
    var ctx = document.getElementById( "MostViewedVideos" );
    ctx.height = 120;
    var myChart = new Chart( ctx, {
        type: 'polarArea',
        data: {
            datasets: [ {
                data: [ 
                    <?php
                        $videos = $db->GetMostViewedVideos(1,true);
                        foreach ($videos as $video) 
                        { ?>
                            '<?=$video['vistas'] ?>',
                    <?php } ?>
                 ],
                backgroundColor: [
                                    "#1d566e",
                                    "#21aba5",
                                    "#45eba5"
                                ]
                            } ],
            labels: [
                        <?php 
                            $videos = $db->GetMostViewedVideos(1,true);
                            foreach ($videos as $video) 
                            { ?>
                                '<?=$video['nombre'] ?>',
                    <?php } ?> 
                    ]
        },
        options: {
            responsive: true,
            legend: {
                labels: {
                    usePointStyle: true,
                    fontFamily: 'Quicksand',
                },
            },
            tooltips: {
                titleFontFamily: 'Quicksand',
                bodyFontFamily: 'Quicksand'
            },
        }
    } );

    function saveAsPDF(chart, titulo) 
    {
        var canvas = document.querySelector(chart);
        var imgData = canvas.toDataURL('image/png');
        var doc = new jsPDF('landscape');
        var now = new Date();
        var jsDate = now.getDate()+'-'+(now.getMonth()+1)+'-'+now.getFullYear();
        doc.setFontSize(15);
        doc.setFontStyle('normal');
        doc.addImage(imgData, 'PNG', 20, 20);
        doc.text(80,130,titulo+' fecha: '+jsDate);

        doc.save(titulo+'.pdf');
    }
</script>

</body>

</html>