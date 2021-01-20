<?php

   $bandera=0;

    if(isset($_COOKIE['user']) && ($_COOKIE['user'])=="Cambio de pass"){
      $bandera=1;
    }
    else if(isset($_COOKIE['user']) && ($_COOKIE['user'])=="Caducada"){
      $bandera=2;
      echo '<script>alert("La sesíon ha caducado, inicie sesión de nuevo")</script>';
    }
    else if(isset($_COOKIE['user']) && ($_COOKIE['user'])=="No existe"){
        $bandera=3;
      $credenciales="<script>window.setTimeout(function() {
        $('.mensaje').fadeTo(500, 0);
    }, 4000);</script>
    <div class='alert alert-danger mensaje' role='alert'>Credenciales incorrectas</div>";
    }
    else if(isset($_COOKIE['user']) && ($_COOKIE['user'])=="Modificada"){
      
      $bandera=4;
    }
    
          
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <title>Gruas vazques</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
  <meta http-equiv='cache-control' content='no-cache'>
  <meta http-equiv='expires' content='0'>
  <meta http-equiv='pragma' content='no-cache'>
  <link href="css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">

<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<style>
    body {
  margin: 0;
  padding: 0;
  background-color: #2c2c2c;
  /* Permalink - use to edit and share this gradient: https://colorzilla.com/gradient-editor/#474747+0,111111+51,131313+100 */
background: rgb(71,71,71); /* Old browsers */
background: -moz-linear-gradient(top,  rgba(71,71,71,1) 0%, rgba(17,17,17,1) 51%, rgba(19,19,19,1) 100%); /* FF3.6-15 */
background: -webkit-linear-gradient(top,  rgba(71,71,71,1) 0%,rgba(17,17,17,1) 51%,rgba(19,19,19,1) 100%); /* Chrome10-25,Safari5.1-6 */
background: linear-gradient(to bottom,  rgba(71,71,71,1) 0%,rgba(17,17,17,1) 51%,rgba(19,19,19,1) 100%); /* W3C, IE10+, FF16+, Chrome26+, Opera12+, Safari7+ */
filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#474747', endColorstr='#131313',GradientType=0 ); /* IE6-9 */

  height: 100vh;
}
#login .container #login-row #login-column #login-box {
  /*margin-top: 120px;*/
  /*max-width: 600px;*/
  width: 100%;
  margin: auto;
  height: 320px;
  border: 1px solid #9C9C9C;
  background-color: #EAEAEA;
}
#login .container #login-row #login-column #login-box #login-form {
  padding: 20px;
}
#login .container #login-row #login-column #login-box #login-form #register-link {
  margin-top: -85px;
}

</style>
</head>


     
 
  
  <body styel='background-color:black'>
 
  <div id='div_login' class="container" >
    <div class="row" id="pwd-container" style="top:50px">    
      <div class="col-md-12 col-md-offset-6">
        <div id="login">
        <h3 class="text-center text-white pt-5"><img src="images/logo.png" alt=""></h3>
        <div class="container">
            <div id="login-row" class="row justify-content-center align-items-center">
                <div id="login-column" class="col-md-4">
                    <div id="login-box" class="col-md-12">
                        <form id="login-form" class="form" action="loguin.php" method="post">
                            <h3 class="text-center">Inicio de sesión</h3>
                            <div class="form-group">
                                <label for="usuario">Usuario:</label><br>
                                <input type="text" name="user" id="user" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="pass" >Contraseña:</label><br>
                                <input type="password" name="pass" id="pass" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <input type="submit" name="submit" class="btn btn-info btn-md" value="Entrar"><?php echo $credenciales?>
                            </div>
                            
                        </form>
                    </div>
                </div>
            </div>
        </div>
      </div>
    </div>  
  </div>
</body>
<?php 
if($bandera==3){
     /* echo "<script>swal({
        type: 'warning',
        text:  'Los datos ingresados son incorrectos',
      });</script>";
      */

      echo '<script>window.setTimeout(function() {
        $(".mensaje").fadeTo(500, 0) 
    }, 4000);</script>';
      
    }
    ?>
    <?php 
if($bandera==4){
      echo "<script>swal({
        title: 'Contraseña actualizada',
        type: 'success',
        text:  'Inicia sesión de nuevo',
      });</script>";
      
    }
    ?>

</body>
<script>

</script>
</html>