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
	<title>Reservacion</title>
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
            <li><a href="reservacion.php"><h4 class="sub-header">Reservaciones</h4></a></li>
            <li><a href="registrar_reservacion.php">Nuevo</a></li>
            <li><a href="#">Buscar</a></li>
            <li><a href="r_reservacion.php" target="_blank">Reporte</a></li>
          </ul>
        </div>


        <div class="col-md-8">
          
        <form class="form-horizontal" role="form" action="registrar_reservacion.php" method="POST">
 
   <div class="form-group">
    <label for="ejemplo_email_3" class="col-lg-2 control-label">Habitacion</label>
    <div class="col-lg-10">
     <select name="habitacion" class="form-control">
       <?php 
        require_once 'conexion.php';
  $conn = Conectarse();

    $sql = "SELECT * FROM tb_habitaciones";

      foreach($conn->query($sql) as $row) {
        if ($row['estado_h']){
          echo "<option value='".$row['id_habitacion']."'>".$row['tipo_h']."</option>";
         }
        }


        ?>
     </select>
    </div>
  </div>
  <div class="form-group">
    <label for="ejemplo_email_3" class="col-lg-2 control-label">Código/cliente</label>
    <div class="col-lg-10">
      <input type="text" class="form-control" 
            name="cliente" placeholder="Cod/cliente" >
    </div>
  </div>

   <div class="form-group">
    <label for="ejemplo_email_3" class="col-lg-2 control-label">Fecha/reservada</label>
    <div class="col-lg-10">
      <input type="date" class="form-control" 
            name="fr" placeholder="Inicio/reserva" >
    </div>
    
  
      <div class="form-group">
      <div class="col-lg-10">
       
        <center><input class='btn btn-primary' TYPE='submit' NAME='accion' VALUE='Guardar'></center>
   
      



    </div>
          </div>    
        </div>
 <?php

if(isset($_POST['accion'])){
  $buscarc= $conn->prepare('SELECT * FROM tb_cliente where id_cliente='.$_POST['cliente'].'');
$buscarc->execute();

$cuenta=$buscarc->rowCount();
if ($cuenta>0) {
try {

  require_once 'conexion.php';
  $conn = Conectarse();
    

    // prepare sql and bind parameters
    $stmt = $conn->prepare("INSERT INTO tb_reservacion VALUES (0, :b, :c, :d, :e, :f, 1)");

    $stmt->bindParam(':b', $b);
    $stmt->bindParam(':c', $c);
    $stmt->bindParam(':d', $d);
  $stmt->bindParam(':e', $e);
  $stmt->bindParam(':f', $f);


    // insert a row
   
    $b = $_POST['habitacion'];
    $c = $_SESSION["ie"];
    $d = $_POST['cliente'];
  $e = date("Y-m-d");
  $f =$_POST['fr'];

    $stmt->execute();




   $id_habitacion=$_POST['habitacion'];
     $sql = "update tb_habitaciones set estado_h=0 where id_habitacion=$id_habitacion";
     $conn->exec($sql);
    // insert another row
    /*$a = "otro";
    $b = "1";
    $c = "Chovi G.L.";
    $d = "Invitado";
    $stmt->execute();
    $stmt->execute();*/
 echo "Guardado Correctamente";
   
    }
catch(PDOException $e)
    {
    echo "<center>Error: " . $e->getMessage()."<center>";
    }
$conn = null;
}else{
echo "<script>alert('NO Existe cliente registrado con este código');</script>";
  echo"<meta http-equiv='refresh' content='0; url=http://localhost/princess_one/php/registrar_reservacion.php'/ >";
     

}
}


?> 




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