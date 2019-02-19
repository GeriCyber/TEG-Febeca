<?php
	require_once('inc/header.php');
	require_once('inc/funciones_bd.php');
	$db = new funciones_BD();
?>

<?php if(($_SESSION["id_rol"])=='admin') { ?>
<!--Div que viene de header-->
    <div class="breadcrumbs">
        <div class="col-sm-12">
            <div class="page-header">
                <div class="page-title text-center">
                    <h1 class="text-muted">Carga Masiva de Usuarios</h1>
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
	                <div class="sufee-alert alert with-close alert-danger alert-dismissible fade show mb-4">
	                    <span class="badge badge-pill badge-danger">&nbsp;Error</span>
	                        <?php echo $_GET['error']; ?>&nbsp;&nbsp;
	                        <a href="uploads/ErroresCargaMasiva.pdf" download="ErroresCargaMasiva.pdf" class="btn btn-danger btn-sm text-white"><i class="fa fa-download"></i> Descargar</a>
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
	                <div class="container pb-5">
	                	<div class="row h-100 d-flex justify-content-center">
	                		<div class="col-md-9">
	                			<h3 class="text-success mb-3">Subir documento Excel</h3>
	                			<form method="post" action="inc/usuarios/leer_excel.php" enctype="multipart/form-data">
		                			<div class="custom-file text-center">
									 	<input type="file" onchange="return fileValidation()" class="custom-file-input" id="archivo" name="archivo" required>
									  	<label class="custom-file-label text-left" for="customFile">Seleccionar Archivo</label>
									  	<button type="submit" class="btn btn-success mt-3 loading" 
									  	data-loading-text="<i class='fa fa-spinner fa-spin '></i> Cargando documento...">Cargar</button>
									</div>
								</form>
								<div class="alert alert-success mt-5 text-justify">
									El archivo debe ser un documento <span class="badge badge-pill badge-success">EXCEL</span> <b>.xlsx</b> el mismo debe contener el nombre, apellido, cedula, teléfono, correo, empresa, un nombre de usuario, una contraseña y el rol de ese usuario en el sistema.
								</div>
								<button type="button" class="btn btn-success" data-toggle="modal" data-target="#modal-img-example" >Ver ejemplo de documento</button>
	                		</div>	
	                	</div>
	                </div>
	            </div>
	        </div>
	    </div>
	</div>

	<div class="modal fade" id="modal-img-example" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-success">Ejemplo de Archivo Excel de Usuarios</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <img src="assets/img/excel-example.PNG" width="800">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div>

<!--Div que viene de header_admin2-->
</div>
<?php include 'inc/const.php' ?>

<script>

//Validar que el archivo sea excel
function fileValidation()
{
    var fileInput = document.getElementById('archivo');
    var filePath = fileInput.value;
    var allowedExtensions = /(\.xlsx|\.xls|\.csv)$/i;
    if(!allowedExtensions.exec(filePath))
    {
        alert('Por favor adjunta un documento Excel .xlsx .xls .csv');
        fileInput.value = '';
        return false;
    }
    if(fileInput.files[0].size > 100000000)
    {
       alert("El tamaño maximo es de 100 Mb!");
       fileInput.value = "";
    }
}

//loading actions
$('.loading').on('click', function() 
{
    if ($('#archivo').val()) 
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