<?php 
class sub_menu
  {
 


 function set_menu()
{
 echo '<nav class="navbar navbar-default" role="navigation">';


 // <!-- El logotipo y el icono que despliega el menú se agrupan
//       para mostrarlos mejor en los dispositivos móviles -->


  echo '<div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse"
              data-target=".navbar-ex1-collapse">
        <span class="sr-only">Desplegar navegación</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="#"></a>
    </div>';
 
  #<!-- Agrupar los enlaces de navegación, los formularios y cualquier
 #      otro elemento que se pueda ocultar al minimizar la barra -->
 echo '  <div class="collapse navbar-collapse navbar-ex1-collapse">
    <ul class="nav navbar-nav">
      <li ><a href="principal.php">Inicio</a></li>
      <li><a href="#">¿Quienes sómos?</a></li>
      <li class="dropdown">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
          Servicios <b class="caret"></b>
        </a>
        <ul class="dropdown-menu">
          <li><a href="reservacion.php">Reservaciones</a></li>
          <li><a href="alojamiento.php">Alojamientos</a></li>
          <li><a href="ordenar.php">Pedidos a cocina</a></li>
          <li><a href="manto.php">Mantenimiento</a></li>
          <li class="divider"></li>
          <li><a href="cliente.php?&cliente=1">Facturar</a></li>
        
        </ul>
      </li>
    </ul>';

 
  echo  '<ul class="nav navbar-nav navbar-right">
      <li><a href="#">'.$_SESSION['tipou'].'</a></li>
            <li><a href="#"> '.$_SESSION['nombre'].'</a></li>
      <li class="dropdown">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
          Opciones <b class="caret"></b>
        </a>
        <ul class="dropdown-menu">
           <li><a href="habitacion.php?&h=1">Habitaciones</a></li>
          <li ><a href="empleado.php?&empleado=1">Empleados</a></li>
          <li ><a href="cliente.php?&cliente=1">Clientes</a></li>
          <li><a href="#">Reportes</a></li>
          <li class="divider"></li>
          <li ><a href="usuario.php">Usuarios</a></li>
          <li class="divider"></li>
          <li><a href="cerrar.php">Cerrar Sesion</a></li>
        </ul>
      </li>
    </ul>
  </div>
</nav>';
}
}

?>