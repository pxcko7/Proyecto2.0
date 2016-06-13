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
	<title>Alojamiento</title>
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
            <li><a href="alojamiento.php"><h4 class="sub-header">Alojamientos</h4></a></li>
            <li><a href="registrar_alojamiento.php">Nuevo</a></li>
            <li><a href="#">Buscar</a></li>
            <li><a href="r_alojamiento.php" target="_blank">Reporte</a></li>
          </ul>
        </div>



        <?php

require_once('conexion.php');
$conn = Conectarse();
$sql = 'SELECT * FROM tb_alojamiento inner join tb_habitaciones on tb_alojamiento.id_habitacion=tb_habitaciones.id_habitacion inner join 
empleado on tb_alojamiento.id_empleado=empleado.id_Empleado inner join tb_cliente on tb_alojamiento.id_cliente=tb_cliente.id_cliente inner join combo on combo.id_combo = tb_alojamiento.id_combo';
$result = $conn->query($sql);
$t='a';

$rows = $result->fetchAll();
?>
 <h2 class="sub-header">Alojamientos</h2>
 <div class="table-responsive">
 <table class="table table-hover">
<thead>
  <tr>
    <th>ID</th>
     <th>Cod/habitación</th>
    <th>Fecha</th>
    <th>Empleado</th>
    <th>Cliente</th>
    <th>Combo/alojamiento</th>


    

  </tr>

</thead>
<tbody>
  <?php
  foreach ($rows as $row) {
     
 if ($row['estado_a']) {
        # code...
  ?>
  <tr>

    <td><?php echo $row['id_alojamiento'];?></td>
    <td><?php echo $row['id_habitacion'];?></td>
    <td><?php echo $row['fecha_alojamiento'];?></td>
    <td><?php

     $a=$row['nombres'];
      $b = $row['apellidos'];
      echo $a." ".$b ;

      ?>;

   </td>
    <td><?php
   $a=$row['nombre'];
      $b = $row['apellido'];
      echo $a." ".$b ;

     ?></td>
    
    <td><?php echo $row['nombre_combo'];?></td>


  <td><?php
  echo "<a href='r_factura.php?id=$row[id_cliente]' class='btn btn-sm btn-primary'>Facturar</a>";?></td>
 
  
  </tr>
  <?php
} 

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