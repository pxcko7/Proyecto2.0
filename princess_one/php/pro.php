<?php 

public static function menu1()
{
	echo "<ul class='nav navbar-nav>'";
     echo  '<li class="active"><a href="#">Inicio</a></li>';
     echo  '<li><a href="#">¿Quienes sómos?</a></li>';
     echo  '<li class="dropdown">';
      echo   '<a href="#" class="dropdown-toggle" data-toggle="dropdown">';
      echo     'Servicios <b class="caret"></b>';
      echo   '</a>';
       echo  '<ul class="dropdown-menu">';
        echo   '<li><a href="#">Acción #1</a></li>';
        echo   '<li><a href="#">Acción #2</a></li>';
        echo   '<li><a href="#">Acción #3</a></li>';
        echo   '<li class="divider"></li>';
        echo   '<li><a href="#">Acción #4</a></li>';
        echo   '<li class="divider"></li>';
        echo   '<li><a href="#">Acción #5</a></li>';
      echo   '</ul>';
    echo   '</li>';
   echo  '</ul>';
 
   echo  '<form class="navbar-form navbar-left" role="search">';
     echo  '<div class="form-group">';
     echo   ' <input type="text" class="form-control" placeholder="Buscar">';
     echo  '</div>';
    echo   '<button type="submit" class="btn btn-default">Enviar</button>';
  echo   '</form>';
 
   echo  '<ul class="nav navbar-nav navbar-right">';
    echo   '<li><a href="#">Administrador</a></li>';
    echo   '<li class="dropdown">';
     echo    '<a href="#" class="dropdown-toggle" data-toggle="dropdown">';
       echo   ' Opciones <b class="caret"></b>';
      echo   '</a>';
       echo  '<ul class="dropdown-menu">';
         echo  '<li><a href="#">Acción #1</a></li>';
         echo  '<li><a href="#">Acción #2</a></li>';
         echo ' <li><a href="#">Acción #3</a></li>';
         echo  '<li class="divider"></li>';
         echo  '<li><a href="cerrar.php">Cerrar Sesion</a></li>';
      echo   '</ul>';
    echo   '</li>';
   echo  '</ul>';







}





























 ?>