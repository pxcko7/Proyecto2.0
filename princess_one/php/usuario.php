<?php 
Session_start();


 if(isset($_SESSION['est']) && ($_SESSION['usu']) && ($_SESSION['est']="ok")){
  

  ?>
 

<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Usuario</title>
	 <!-- CSS de Bootstrap -->
    <link href="../css/bootstrap.min.css" rel="stylesheet">
   <script src="../js/ie-emulation-modes-warning.js"></script>
     <script src="../../assets/js/ie-emulation-modes-warning.js"></script>
    <!-- librerías opcionales que activan el soporte de HTML

    <! Custom styles for this template -->
    <link href="jumbotron.css" rel="stylesheet">

    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>

    <![endif]-->
</head>
<body>
<div class="container">
  <img src="../img/pologo.png" class="img-responsive" alt="princess_one">
<?php 
require_once('sub_menu.php');

$menu= new sub_menu;
$menu->set_menu();


 ?>
  
  <div class="jumbotron">
<div class="container-fluid">
      <div class="row">
        
      <div class="col-sm-3 col-md-2 sidebar">
          <ul class="nav nav-sidebar">
            <li><a href="usuario.php"><h4 class="sub-header">Usuarios</h4></a></li>
            <li><a href="registrar_usuario.php">Nuevo</a></li>
            <li><a href="#">Buscar</a></li>
            <li><a href="r_usuario.php" target="_blank">Reporte</a></li>
          </ul>
        </div>



        <?php

require_once('conexion.php');
$conn = Conectarse();

$sql = "SELECT * FROM tb_usuario inner join empleado on tb_usuario.id_empleado=empleado.id_empleado";
$result = $conn->query($sql);


$rows = $result->fetchAll();
?>
 <h2 class="sub-header">Usuarios</h2>
 <div class="table-responsive">
 <table class="table table-hover">
<thead>
  <tr>
    <th>ID</th>
    <th>Nombre empleado</th>
    <th>Usuario</th>
    <th>Clave</th>
    <th>Tipo de Usuario</th>
    <th>Estado</th>
    <th>Editar</th>
    

  </tr>

</thead>
<tbody>
  <?php
  foreach ($rows as $row) {
  ?>
  <tr>

    <td><?php echo $row['id_usuario'];?></td>
    <td><?php 
      $a=$row["nombres"];
      $b=$row["apellidos"];
      $nombrec=$a.' '.$b;
      echo $nombrec;


    ?></td>
    <td><?php echo $row['usuario'];?></td>
    <td><?php echo $row['clave'];?></td>
    <td><?php echo $row['tipo_usuario'];?></td>
    <td><?php
    if ($row['estado']) {
      # code...
      echo "Activo";
    }else{
      echo "Inactivo";
    }
    

     ?></td>
  <td>
 <a href='registrar_usuario.php?&id=<?php echo $row['id_usuario']; ?>' class='btn btn-warning'>EDITAR</a></td>
 
  
  </tr>
  <?php
}
?>



</table>
 </div>
          



    </div>
    <!-- Todos los plugins JavaScript de Bootstrap (también puedes
         incluir archivos JavaScript individuales de los únicos
         plugins que utilices) -->
        <script src="../js/jquery.min.js"></script>
    <script src="../js/bootstrap.js"></script>





<?php
}else{
  header("Location:http://localhost/princess_one/php/sesion.php");
  exit();
  }
?>

</body>


</html>