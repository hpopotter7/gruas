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
      <?php
        if($_COOKIE['perfil']=="ADMIN"){
          ?>
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
      <?php
        }
      ?>
      
     
    </ul>