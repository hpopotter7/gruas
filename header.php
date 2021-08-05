<nav class="navbar navbar-expand navbar-dark bg-dark static-top">

    <a class="navbar-brand mr-1" href="index.php"><img src="images/logo.png" alt="" width="100px"></a>

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
  <div class="dropdown-menu" style='width:200px !important;left:-75px !important' aria-labelledby="dropdownMenuButton">
    <!-- <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
  Cambiar contraseña
</button> -->
    <a class="dropdown-item" data-toggle="modal" data-target="#exampleModal" href="#"><i class="fas fa-lock"></i> Cambiar contraseña</a>
    <a class="dropdown-item" href="logout.php"><i class="fas fa-sign-out-alt"></i> Cerrar Sesión</a>
  </div>
</div>

  </nav>