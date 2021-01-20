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
        <a class="nav-link" href="index.html">
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
        
        <div class="card mb-3" >
          <div class="card-body">
            <div class="table-responsive" id="div_servicio">
              <table class="table table-bordered table-hover" id="dataTable" cellspacing="0">
                <thead>
                  <tr>
                    <th># Folio</th>
                    <th>Tipo</th>
                    <th>Chofer</th>
                    <th>Destino</th>
                    <th>Hora salida</th>
                    <th>Duración</th>
                  </tr>
                </thead>
                <tbody id='servicios''>
                  
                </tbody>
              </table>
            </div>
          </div>
        </div>
        
        <hr>
        <div id='div_servicios' class="row">
        <div class="col-md-3">
          
          <select name="c_tipo_grua" class='form-control' id="c_tipo_grua">
            <option value="Grande" selected>Grande</option>
            <option value="Industrial">Industrial</option>
            <option value="Plataforma" >Plataforma</option>
           
          </select>
          <div class="table-responsive">
            <table class="table table-bordered" id="example2" width="100%" cellspacing="0">
              <tbody class='sortable'>
                
              </tbody>
            </table>
            <button id='btn_agregar_chofer' class='btn btn-success'><i class="fas fa-plus"></i> Agregar</button>
            <!--<button class='btn btn-warning' id='btn_candado' style='margin-left: 35px;'><i class="fa fa-lock"></i></button>-->
            <button id='btn_del_chofer' class='btn btn-danger float-right'><i class="fas fa-minus"></i> Eliminar</button>
          </div>
        </div>
        <div class="col-md-5">
          <div class="tabs">
            <div class="tab-button-outer">
              <ul id="tab-button">
                <li><a id='tab_01' href="#tab01">Salidas</a></li>
                <li><a href="#tab02">LLegadas</a></li>
              </ul>
            </div>
            <div class="tab-select-outer">
              <select id="tab-select">
                <option value="#tab01">Salidas</option>
                <option value="#tab02">Llegadas</option>
              </select>
            </div>

            <div id="tab01" class="tab-contents" >
              <div class="panel-body">
                <div class="row">
                  <div class=" col-md-12 col-lg-12 ">
                    <table class="table table-user-information">
                      <tbody>
                        <tr>
                          <td><h4><span class="badge badge-light">Grua:</span></h4></td>
                          <td>
                            <select name="c_tipo_grua_2" id="c_tipo_grua_2" class='form-control'>
                            <option value="Grande" selected>Grande</option>
                            <option value="Industrial">Industrial</option>
                            <option value="Plataforma">Plataforma</option>
                            </select>
                        </td>
                        </tr>
                        <tr>
                          <td><a href="#" id='btn_lock' class='btn btn-warning'><i class="fas fa-fw fa-lock"></i> Chofer:</a></td>
                          <td>
                            
                            <input type="text" class="form-control disabled" id='txt_chofer_siguiente' disabled='disabled'>

                          </td>
                        </tr>
                        <tr>
                          <td><h4><span class="badge badge-light">Folio:</span></td>
                          <td><input type="text" id='txt_folio' class='form-control'></td>
                        </tr>
                        <tr>
                          <td><h4><span class="badge badge-light">Destino:</span></h4></span></td>
                          <td><textarea type="text" class='form-control' id='area_destino'></textarea></td>
                        </tr>
                      </tbody>
                    </table>
                    <button type="button" id='btn_especial' class='btn btn-info float-md-left' name="button">
                      <i class="fas fa-helicopter" aria-hidden="true"></i> Especial
                    </button>
                    <button type="button" id='btn_salida' class='btn btn-success float-md-right' name="button">
                    <i class="fa fa-truck" aria-hidden="true"></i> Dar salida
                  </button>
                  </div>
                </div>
              </div>
            </div>
            <div id="tab02" class="tab-contents">
              <div class="panel-body">
                <div class="row">
                  <div class=" col-md-12 col-lg-12 ">
                    <table class="table table-user-information">
                      <tbody>
                        <tr>
                          <td><h4><span class="badge badge-info">Folio:</span></h4></td>
                          <td><input type="text" id='txt_folio_llegada' class='form-control disabled' readonly></td>
                        </tr>
                        <tr>
                          <td><h4><span class="badge badge-info">Chofer:</span></h4></td>
                          <td><input type="text" id='txt_chofer_llegada' class='form-control disabled' readonly></td>
                        </tr>
                        <tr>
                          <td><h4><span class="badge badge-info">Grua:</span></h4></td>
                          <td><input type="text" id='txt_tipo_grua_llegada' class='form-control disabled' readonly></td>
                        </tr>
                        <tr>
                          <td><h4><span class="badge badge-info">Llegada:</span></h4></td>
                          <td><input type="date" id='txt_fecha_llegada' class='form-control' ><input type="text" id="txt_hora_llegada" name="txt_hora_llegada" class='form-control time_element' required></td>
                        </tr>
                        <tr>
                          <td><h4><span class="badge badge-info">Tipo de servicio:</span></h4></td>
                          <td>
                          <select name="c_tipo_servicio" id="inputc_tipo_servicio" class="form-control">
                            <option value="Normal">Normal</option>
                            <option value="Muerto">Muerto</option>
                          </select>
                          </td>
                        </tr>
                      </tbody>
                    </table>
                    <button type="button" id='btn_llegada' class='btn btn-success float-md-right' name="button">
                    <i class="fa fa-truck fa-flip-horizontal" aria-hidden="true"></i> Recibir
                  </button>
                  </div>
                </div>
              </div>
            </div>
          </div>
         </div>
         <div class="col-md-4">
          <textarea id='observaciones' class="form-control" name="name" rows="25" cols="6" style='font-size: .85em;'></textarea>
          <button id='btn_guardar_notas' type="button" class='btn btn-info btn-block' name="button" style='font-size: 1.5em;'>
            <i class="fa fa-save" aria-hidden="true"></i><strong> Guardar</strong></button>
            <span id='resultado_notas'></span>
         </div>
       
      </div>
      </div>
      </section>
      <!-- /.container-fluid -->
    </div>
    <!-- /.content-wrapper -->
    
    
  </div>
  
  <!-- /#wrapper -->

  <!-- Scroll to Top Button-->
  <a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
  </a>
<!-- 
<section id='notas' class="col-md-4 cambio">
  
  <header><h1>Observaciones</h1></header>
  <article>
    <textarea id='observaciones' class="form-control" name="name" rows="30" cols="8" style='font-size: 1.2em;'></textarea>
    <div class="clearfix"></div>
    <button type="button" class='btn btn-info btn-block' name="button" style='font-size: 1.5em;'>
    <i class="fa fa-save" aria-hidden="true"></i><strong> Guardar</strong></button>
  </article>
  
  </section> -->

  <div class="modal" id='modal_agregar_chofer'>
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Agregar chofer disponible</h5>
          <button type="button" id='btn_cerrar_modal_1' class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form action="agregar_chofer" method="post">
            <select name="c_add_chofer" id="c_add_chofer" class='form-control'>
            </select>
          </form>
        </div>
        <div class="modal-footer">
          <button type="button" id='btn_add_chofer' class="btn btn-success">Agregar</button>
          
        </div>
      </div>
    </div>
  </div>

  <div class="modal" id='modal_eliminar_chofer'>
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Eliminar chofer disponible</h5>
          <button type="button" id='btn_cerrar_modal_2' class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form action="agregar_chofer" method="post">
            <select name="c_del_chofer" id="c_del_chofer" class='form-control'>

            </select>
          </form>
        </div>
        <div class="modal-footer">
          <button type="button" id='btn_borrar_chofer' class="btn btn-danger">Eliminar</button>
        </div>
      </div>
    </div>
  </div>

  <div class="modal" id='modal_catalogo_add_chofer'>
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Catalogo choferes - Agregar</h5>
          <button type="button" id='btn_cerrar_modal_3' class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form id="agregar_chofer_catalogo" method="post">
        <div class="modal-body">
            <div class="input-group mb-3">
              <div class="input-group-prepend">
                <span class="input-group-text"><i class="fa fa-user"></i></span>
              </div>
              <input type="text" class="form-control" id='txt_nombre' name='txt_nombre' required placeholder="Nombre completo">
            </div>
            <div class="input-group mb-3">
              <div class="input-group-prepend">
                <span class="input-group-text"><i class="fa fa-phone"></i></span>
              </div>
              <input type="text" class="form-control" id='txt_phone' name='txt_phone' required placeholder="Teléfono">
            </div>
            <div class="input-group mb-3">              
              <div class="checkbox">
                  <input type="checkbox" value="X" id='check_plataforma' name='check_plataforma' class='checkbox'>
                  <label for='check_plataforma'>Plataforma</label>
                  <input type="checkbox" value="X" id='check_industrial' name='check_industrial' class='checkbox'>
                  <label for='check_industrial'>Industrial</label>
                  <input type="checkbox" value="X" id='check_grande' name='check_grande' class='checkbox'>
                  <label for='check_grande'>Grande</label>
              </div>
              
            </div>
        </div>
        <div class="modal-footer">
          <button type="submit" id='btn_add_chofer_catalogo' class="btn btn-success">Agregar</button>
        </div>
      </div>
      </form>
    </div>
  </div>

  <div class="modal" id='modal_catalogo_del_chofer'>
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Catalogo choferes - Eliminar</h5>
          <button type="button" id='btn_cerrar_modal_4' class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form action="agregar_chofer" method="post">
            <select name="c_del_chofer_catalogo" id="c_del_chofer_catalogo" class='form-control'>
            </select>
          </form>
        </div>
        <div class="modal-footer">
          <button type="button" id='btn_del_chofer_catalogo' class="btn btn-danger">Eliminar</button>
        </div>
      </div>
    </div>
  </div>

  <div class="modal" id='modal_user_add'>
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Catalogo usuarios - Agregar</h5>
          <button type="button" id='btn_cerrar_modal_5' class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form id="form_agregar_usuario" method="post">
        <div class="modal-body">
            <div class="input-group mb-3">
              <div class="input-group-prepend">
                <span class="input-group-text"><i class="fa fa-user"></i></span>
              </div>
              <input type="text" class="form-control" id='txt_nombre' name='txt_nombre' required placeholder="Nombre completo">
            </div>
            <div class="input-group mb-3">
              <div class="input-group-prepend">
                <span class="input-group-text"><i class="fa fa-user"></i></span>
              </div>
              <input type="text" class="form-control" id='txt_user' name='txt_user' required placeholder="Username">
            </div>
        </div>
        <div class="modal-footer">
          <button type="submit" id='btn_add_user' class="btn btn-success">Agregar</button>
        </div>
      </div>
      </form>
    </div>
  </div>

  <div class="modal" id='modal_user_borrar'>
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Catalogo usuarios - Eliminar</h5>
          <button type="button" id='btn_cerrar_modal_6' class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form action="form_borrar_usuario" method="post">
            <select name="c_usuarios" id="c_usuarios" class='form-control'>
            </select>
          </form>
        </div>
        <div class="modal-footer">
          <button type="button" id='btn_borrar_usuario' class="btn btn-danger">Eliminar</button>
        </div>
      </div>
    </div>
  </div>

  
<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Ingresa tu nueva contraseña</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <input type="password" name="" id="txt_nuevo_pass" class="form-control" required="required" title="">
      </div>
      <div class="modal-footer">
        <button id='btn_cerrar_modal' type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
        <button id='btn_guardar_pass' type="button" class="btn btn-primary">Guardar</button>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="exampleModal_lista" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Choferes disponibless</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <select name="c_lista_choferes_disponibles" id="c_lista_choferes_disponibles" class='form-control'></select>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary btn_modal" data-dismiss="modal">Cerrar</button>
        <button id='btn_seleccion_chofer' type="button" class="btn btn-primary">Guardar</button>
      </div>
    </div>
  </div>
</div>

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

  <script src="js/metodos.js"></script>
</body>

</html>
