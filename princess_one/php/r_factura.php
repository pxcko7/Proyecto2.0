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
	<title>Factura</title>
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
  <img src="../img/pologo.png" alt="princess_one" width="300">

        <?php

require_once('conexion.php');
$conn = Conectarse();
$idc=$_GET["id"];
$sql = 'SELECT * FROM tb_detalle_factura inner join tb_factura on tb_detalle_factura.id_factura=tb_factura.id_factura inner join plato on plato.id_plato=tb_detalle_factura.id_plato where tb_factura.id_cliente='.$idc.'';
$result = $conn->query($sql);


$rows = $result->fetchAll();
?>

   <h2 class="sub-header">Factura  N° 
    <?php 
    $sql2 = 'SELECT *  FROM tb_factura where id_cliente='.$idc.'';
            $result2 = $conn->query($sql2);
            $rows2 = $result2->fetchAll();
   foreach ($rows2 as $row2) {
    echo $row2["id_factura"];
  }
     ?>  
       </h2>
 
  

  
  <div class="jumbotron">
<div class="container-fluid">
      <div class="row">
  




 <div class="table-responsive">
  <div class="form-group">
<label  class="col-md-7 col-md-offset-7"><h4>Empleado:   

         <?php 
            $sql1 = 'SELECT *  FROM empleado where id_Empleado='.$_SESSION["ie"].'';
            $result1 = $conn->query($sql1);
            $rows1 = $result1->fetchAll();
          
           foreach ($rows1 as $row1) {
            $a=$row1["nombres"]; $b=$row1["apellidos"]; $c="  ".$a." ".$b;  echo $c;
          }?> 
            </div>
            
        
 </h4></label>  
</div>
<div class="form-group">
<label  class="col-md-7 col-md-offset-7"><h4>Cliente:

        <?php 
            $sql1 = 'SELECT tb_cliente.nombre as nc, tb_cliente.apellido as ac FROM tb_cliente where id_cliente='.$idc.'';
            $result1 = $conn->query($sql1);
            $rows1 = $result1->fetchAll();
           foreach ($rows1 as $row1) {
            $a=$row1["nc"]; $b=$row1["ac"]; $c="  ".$a." ".$b;  echo $c;
          }?> 



</h4></label>
            
        
   
</div>
<?php   

            $sql5 = 'SELECT * FROM tb_alojamiento inner join combo on tb_alojamiento.id_combo=combo.id_combo inner join tb_factura on tb_alojamiento.id_alojamiento=tb_factura.id_alojamiento inner join tb_habitaciones on tb_alojamiento.id_habitacion=tb_habitaciones.id_habitacion where tb_alojamiento.id_cliente='.$idc.'';
            $result5 = $conn->query($sql5);
            $rows5 = $result5->fetchAll();

 ?>

 <table class="table table-hover">
<thead>
  <tr>
    <th> # </th>
   <th>Habitacion</th>
    <th>Descripción</th>
    <th>Combo</th>
     
     <th>Total</th>

  </tr>

</thead>
<tbody>


  <?php

  foreach ($rows5 as $row5) {
  ?>
  <tr>

    <td>1</td>
    <td><?php echo $row5['tipo_h'];?></td>
    <td><?php echo $row5['descripcion'];?></td>
    <td><?php echo $row5['nombre_combo'];?></td>
    <td><?php echo $row5['precio'];?></td>

   
  </tr>
  <?php
$ih=$row5['id_habitacion'];
$ia=$row5['id_alojamiento'];
}
#Volviendo a activar la habitacion
  $sql6 = "update tb_habitaciones set estado_h=1 where id_habitacion=$ih";
             $conn->exec($sql6);
   #desactivar el alojamiento como disponible
  $sql6 = "update tb_alojamiento set estado_a=0 where id_alojamiento=$ia";
             $conn->exec($sql6);

?>


</table>



 <table class="table table-hover">
<thead>
  <tr>
    <th> # </th>
   
    <th>Descripción</th>
    <th>Cantidad</th>
     <th>Precio unitario</th>


  </tr>

</thead>
<tbody>


  <?php
$i=2;

  foreach ($rows as $row) {
  ?>
  <tr>

    <td><?php echo $i; ?></td>
    <td><?php echo $row['descripcion'];?></td>
    <td><?php echo $row['cantidad_o'];?></td>
    <td><?php echo $row['precio_unitario'];?></td>
    <td><?php echo $row['total'];?></td>

   
  </tr>
  <?php
  $i++;
}
?>


</table>
<div class="form-group">
<label  class="col-md-7 col-md-offset-7"><h4>Total a Pagar:

        <?php 
            $sql1 = 'SELECT * FROM tb_factura where id_cliente='.$idc.'';
            $result1 = $conn->query($sql1);
            $rows1 = $result1->fetchAll();
           foreach ($rows1 as $row1) {
            $a=$row1["total_pagar"]; echo $a;
          }?> 



</h4></label>
            
        
   
</div>
 </div>
          



    </div>
    <!-- Todos los plugins JavaScript de Bootstrap (también puedes
         incluir archivos JavaScript individuales de los únicos
         plugins que utilices) -->
        <script src="../js/jquery.min.js"></script>
    <script src="../js/bootstrap.js"></script>

<!---->


<script>window.print();</script>

<?php
}else{
  header("Location:http://localhost/princess_one/php/sesion.php");
  exit();
  }
?>

</body>


</html>