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
	<title>Cliente</title>
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
            <li><a href="cliente.php?&cliente=1"><h4 class="sub-header">Clientes</h4></a></li>
            <li><a href="registrar_cliente.php">Nuevo</a></li>
            <li><a href="cliente.php?&cliente_i=1">Inactivos</a></li>
            <li><a href="#">Buscar</a></li>
            <li><a href="r_cliente.php" target="_blank">Reporte</a></li>
          </ul>
        </div>



        <?php

require_once('conexion.php');
$conn = Conectarse();
$sql = 'SELECT * FROM tb_cliente';
$result = $conn->query($sql);
$t='c';

$rows = $result->fetchAll();
?>
 <h2 class="sub-header">Clientes</h2>
 <div class="table-responsive">
 <table class="table table-hover">
<thead>
  <tr>
    <th>ID</th>
    <th>Nombres</th>
    <th>Apellidos</th>
    <th>Dui</th>
    <th>Telefono</th>
    <th>Correo</th>


    

  </tr>

</thead>
<tbody>
  <?php
  foreach ($rows as $row) {
    if($row['estado']){
    if(isset($_GET["cliente"])){
  ?>
  <tr>

    <td><?php echo $row['id_cliente'];?></td>
    <td><?php echo $row['nombre'];?></td>
    <td><?php echo $row['apellido'];?></td>
    <td><?php echo $row['dui'];?></td>
    <td><?php echo $row['telefono'];?></td>
    <td><?php echo $row['correo'];?></td>
    <td><?php
  echo "<a href='borrando.php?id=$row[id_cliente]&t=$t'  class='btn btn-sm btn-danger'>Anular</a>";?></td>
  <td><?php
  echo "<a href='registrar_cliente.php?id=$row[id_cliente]' class='btn btn-sm btn-warning'>EDITAR</a>";?></td>
 <td><?php
  echo "<a href='r_factura.php?&id=$row[id_cliente]' class='btn btn-sm btn-primary' target='_blank'>Facturar</a>";?></td>
 
  
  </tr>
  <?php
} 
}
if ($row['estado']=='0') {
if(isset($_GET["cliente_i"])){
$t="ca"
  # code...

?>
<tr>
 <td><?php echo $row['id_cliente'];?></td>
    <td><?php echo $row['nombre'];?></td>
    <td><?php echo $row['apellido'];?></td>
    <td><?php echo $row['dui'];?></td>
    <td><?php echo $row['telefono'];?></td>
    <td><?php echo $row['correo'];?></td>
    <td><?php
  echo "<a href='borrando.php?id=$row[id_cliente]&t=$t'  class='btn btn-sm btn-primary'>Activar</a>";?></td>
  </tr>
<?php
}
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