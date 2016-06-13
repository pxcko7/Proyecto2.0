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
	<title>Reporte Reservaciones</title>
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
 
  
  <div class="jumbotron">
<div class="container-fluid">
      <div class="row">
  



        <?php

require_once('conexion.php');
$conn = Conectarse();
$sql = 'SELECT * FROM tb_reservacion inner join tb_habitaciones on tb_reservacion.id_habitacion=tb_habitaciones.id_habitacion inner join 
empleado on tb_reservacion.id_empleado=empleado.id_Empleado inner join tb_cliente on tb_reservacion.id_cliente=tb_cliente.id_cliente ';
$result = $conn->query($sql);
$t='r';

$rows = $result->fetchAll();
?>
 <h2 class="sub-header">Reservaciones</h2>
 <div class="table-responsive">
 <table class="table table-hover">
<thead>
 <th>ID</th>
     <th>Cod/habitación</th>
    <th>Fecha/Reserva</th>
    <th>Empleado</th>
    <th>Cliente</th>
    <th>Inicio/Reserva</th>
    <th>Fin/reserva</th>

</thead>
<tbody>
  <?php
  foreach ($rows as $row) {
     

  ?>
  <tr>

    <td><?php echo $row['id_reservacion'];?></td>
    <td><?php echo $row['id_habitacion'];?></td>
    <td><?php echo $row['fecha_reservacion'];?></td>
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
    
    <td><?php echo $row['tiempo_inicio'];?></td>
    <td><?php echo $row['tiempo_final'];?></td>
  </tr>
  <?php
}
?>

<script>window.print();</script>

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