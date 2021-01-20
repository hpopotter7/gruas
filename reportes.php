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

  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="css/sb-admin.css" rel="stylesheet">
  
  <link href="css/estilos.css" rel="stylesheet">
  <link href="css/dataTables.bootstrap.css" rel="stylesheet"/>
  <link href="css/dataTables.bootstrap4.css" rel="stylesheet"/> 
  <link href="css/slate.css" rel="stylesheet"/>
  <link href="css/time.css" rel="stylesheet"/>

     
  <link rel="stylesheet"  href="css/jquery-confirm.css"/>
  <link rel="stylesheet"  href="css/demo.css">
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
    <ul class="sidebar navbar-nav">
      <li class="nav-item active">
        <a class="nav-link" href="inicio.php">
          <i class="fas fa-fw fa-tachometer-alt"></i>
          <span>Dashboard</span>
        </a>
      </li>
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="pagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <i class="fas fa-fw fa-truck"></i>
          <span>Choferes</span>
        </a>
        <div class="dropdown-menu" aria-labelledby="pagesDropdown">
          <button id='menu_add_chofer_catalogo' class="dropdown-item" ><i class="fas fa-plus"></i> Agregar</button>
          <button id='menu_del_chofer_catalogo' class="dropdown-item" ><i class="fas fa-trash"></i> Eliminar</button>
          <!--<button id='menu_edit_chofer_catalogo' class="dropdown-item" ><i class="fas fa-edit"></i> Modificar</button>-->
        </div>
      </li>
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="pagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <i class="fas fa-fw fa-users"></i>
          <span>Usuarios</span>
        </a>
        <div class="dropdown-menu" aria-labelledby="pagesDropdown">
          <button id='menu_add_user' class="dropdown-item"><i class="fas fa-plus"></i> Agregar</button>
          <button id='menu_borrar_user' class="dropdown-item"><i class="fas fa-trash"></i> Eliminar</button>
        </div>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="reportes.php">
          <i class="fas fa-fw fa-table"></i>
          <span>Reportes</span></a>
      </li>
    </ul>

    <div id="content-wrapper">

      <div class="container-fluid">
        <!-- DataTables Example -->
        <div class="row">
        <div class="col-md-2">
        <div class="form-group">
            <label for="exampleSelect"><h4>Selecciona un reporte</h4></label>
            <select class="form-control" id="exampleSelect">
                <option>1</option>
                <option>2</option>
                <option>3</option>
            </select>
            
        </div>
        </div>
        
        </div>
        </div>
        
        
      </div>
     
      <!-- /.container-fluid -->
    </div>
    <!-- /.content-wrapper -->
    
    
  </div>
  
  <!-- /#wrapper -->

  <!-- Scroll to Top Button-->
  <a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
  </a>

  <!-- Bootstrap core JavaScript-->
  <!--<script src="vendor/jquery/jquery.min.js"></script>-->
  <script src="js/jquery-1.11.2.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="vendor/jquery-easing/jquery.easing.min.js"></script>
  <!--<script src="vendor/datatables/jquery.dataTables.js"></script>-->
  
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
  <script src="js/demo/datatables-demo.js"></script>
  <script src="js/jquery-confirm.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.1/jquery.validate.min.js"></script>
  <script src="js/time.js"></script>

  <script src="js/reportes.js"></script>
</body>

</html>
