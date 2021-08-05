<?php
if(!isset($_COOKIE['user'])) {
  header('Location:index.php');
}
else if(isset($_COOKIE['user']) && ($_COOKIE['user'])=="No existe"){
  header('Location:index.php');
}
else if(isset($_COOKIE['user']) && ($_COOKIE['user'])=="Caducada"){
  header('Location:index.php');
}
else if(isset($_COOKIE['user']) && ($_COOKIE['user'])=="Cambio de pass"){
  
}
else{
  $secondsInactive = time() - $_COOKIE['start'];
  
}
          
?>


<!DOCTYPE html>
<html lang="es">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Gruas Vázquez - Dashboard</title>
<?php
  include("links.php");
?>
  <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.css" /> -->
  <script>
    var version = '3.3.4';
</script>
<style>
  /*table thead { display:block; }*/
  #div_servicio { width: 100%; max-height:300px; overflow: auto;}
  .checkbox { /* Double-sized Checkboxes */
  margin-left: 15px;
  -ms-transform: scale(1.2); /* IE */
  -moz-transform: scale(1.2); /* FF */
  -webkit-transform: scale(1.2); /* Safari and Chrome */
  -o-transform: scale(1.2); /* Opera */
  padding: 5px;
  }
  #barChart{
  background-color: white;
  border-radius: 6px;
/*   Check out the fancy shadow  on this one */
  box-shadow: 0 3rem 5rem -2rem rgba(0, 0, 0, 0.6);
}


</style>
</head>

<body id="page-top">
<?php
if(isset($_COOKIE['opcion']) && ($_COOKIE['opcion'])=="primera"){
    echo "<script>alert('Se recomienda cambiar la contraseña en el icono de usuario');</script>";
}
?>

  <nav class="navbar navbar-expand navbar-dark bg-dark static-top">

    <a class="navbar-brand mr-1" href="index.html"><img src="images/logo.png" alt="" width="100px"></a>

    <button class="btn btn-link btn-sm text-white order-1 order-sm-0" id="sidebarToggle" href="#">
      <i class="fas fa-bars"></i>
    </button>

    <!-- Navbar Search -->
    <form class="d-none d-md-inline-block form-inline ml-auto mr-0 mr-md-3 my-2 my-md-0">
       
    </form>

    <div class="dropdown">
  <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
  <i class="fas fa-user-circle fa-fw"></i> <?php echo $_COOKIE['user']?>
  </button>
  <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
  Cambiar contraseña
</button>
    <a class="dropdown-item" href="logout.php">Cerrar Sesión</a>
  </div>
</div>

  </nav>

    <div id="wrapper">
    
    <!-- Sidebar -->
    <?php
    include("menu.php");
    ?>

    <div id="content-wrapper">
      <div class="container-fluid">
        <table class="table">
            <thead>
                <tr>
                    <th></th>
                    <th></th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td scope="row"></td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td scope="row"></td>
                    <td></td>
                    <td></td>
                </tr>
            </tbody>
        </table>
        </div>        
      </div>
    </div>
    

  <!-- Bootstrap core JavaScript-->
  <!--<script src="vendor/jquery/jquery.min.js"></script>-->
  <!-- <script src="js/jquery-3.1.1.min.js"></script> -->
  <script src="https://code.jquery.com/jquery-1.12.4.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="vendor/jquery-easing/jquery.easing.min.js"></script>
  <!--<script src="vendor/datatables/jquery.dataTables.js"></script>-->
  
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
  <script src="js/jquery-confirm.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.1/jquery.validate.min.js"></script>
  <!-- <script src="js/bootstrap/popper.min.js"></script>
  <script src="js/bootstrap/bootstrap.min.js"></script> -->
  <script src="js/Chart.js"></script>
  <!-- <script src="https://cdnjs.com/libraries/Chart.js"></script> -->
  <!-- <script src="https://cdn.jsdelivr.net/gh/emn178/chartjs-plugin-labels/src/chartjs-plugin-labels.js"></script> -->
  <script src="js/time.js"></script>
  <script src="js/reportes.js?v=<?php echo(rand()); ?>"></script>
  <script>
    $(window).on("load", inicio);
  </script>
</body>

</html>
