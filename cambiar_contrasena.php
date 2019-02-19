<?php require_once('inc/header.php'); ?>

<?php
    require_once 'inc/funciones_bd.php';
    $db = new funciones_BD();
?>

<!--Div que viene de header_admin2-->
    <div class="content mt-3">
      <div class="animated fadeIn">
        <?php 
          if(isset($_GET['error']))
          { ?>
            <div class="sufee-alert alert with-close alert-danger alert-dismissible fade show mt-4">
                <span class="badge badge-pill badge-danger">Error</span>
                    <?php echo $_GET['error']; ?>
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
                    
            <?php }
                if(isset($_GET['exito']))
                { ?>
                  <div class="sufee-alert alert with-close alert-success alert-dismissible fade show mt-4">
                      <span class="badge badge-pill badge-success">Éxito</span>
                          <?php echo $_GET['exito']; ?>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                      </button>
                  </div>  
          <?php } ?>
          <div class="row">
              <div class="col-md-12">
                  <br/>

                  <div class="container pb-5">
                    <div class="row h-100 d-flex justify-content-center mt-4">
                      <div class="col-md-6">
                        <h3 class="text-success mb-3 text-center">Cambiar contraseña</h3><br>
                        <form method="post" action="inc/cambio_clave.php">
                          <div class="custom-file">
                              <label class="form-control-label" for="clave">Contraseña antigua</label>
                              <input type="password" id="clave_antigua" name="clave_antigua" class="form-control input-md" required><br>
                              <label class="form-control-label" for="clave">Contraseña nueva</label>
                              <input type="password" id="clave_nueva" name="clave_nueva" class="form-control input-md" required> <br>
                              <label class="form-control-label" for="clave">Confirmar contraseña nueva</label>
                              <input type="password" id="clave_confirmar" name="clave_confirmar" class="form-control input-md" required> <span id='message'></span><br>
                              <button type="submit" id="submit" class="btn btn-success mt-3">Cambiar</button>
                          </div>
                        </form>
                      </div>  
                    </div>
                  </div>
              </div>
          </div>
      </div>
  </div>

<?php include 'inc/const.php' ?>

<script>
  //validacion de clave
  $('#clave_nueva, #clave_confirmar').on('keyup', function () 
  {
      if ($('#clave_nueva').val() != $('#clave_confirmar').val())
      {
        $('#message').html('No concuerdan').css('color', 'red');
        $('#submit').attr("disabled", true);
      }
      else 
      {
        $('#message').html('Concuerdan').css('color', 'green');
        $('#submit').attr("disabled", false);
      }
  });
</script>

</body>

</html>
