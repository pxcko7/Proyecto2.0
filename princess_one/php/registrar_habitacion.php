<?php 
Session_start();


 if(isset($_SESSION['est']) && ($_SESSION['usu']) && ($_SESSION['est']="ok")){
  if (isset($_GET['id'])) {
    # code...
    include_once('conexion.php');

$conn =  Conectarse();

  $id_habitacion = $_GET['id'];



  $sql = "SELECT * FROM tb_habitaciones where id_habitacion = $id_habitacion";

foreach($conn->query($sql) as $row) {
  $id_habitacion = $row["id_habitacion"];
  $estado = $row["estado_h"];
  $tipo = $row["tipo_h"] ;
  $descripcion = $row["descripcion_h"];

  }

  }

  ?>
 

<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Habitacion</title>
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
           <li><a href="habitacion.php?&h=1"><h4 class="sub-header">Habitaciones</h4></a></li>
            <li><a href="registrar_habitacion.php">Nuevo</a></li>
            <li><a href="#">Buscar</a></li>
            <li><a href="habitacion.php?&r=1">Reservadas</a>
             <li><a href="habitacion.php?&a=1">Alojadas</a>
             <li><a href="registrar_habitacion.php">Mantenimiento Especial</a>
            <li><a href="r_habitacion.php" target="_blank">Reporte</a></li>
          </ul>
        </div>
        <div class="col-md-8">
    
        <form class="form-horizontal" role="form" action="registrar_habitacion.php" method="POST">
 
   <div class="form-group">
    <label for="ejemplo_email_3" class="col-lg-2 control-label">Estado</label>
    <div class="col-lg-10">
  <select name="estado" class="form-control" >
    
<?php if (isset($_GET['id'])) {
if ($estado) {
  # code...
  echo "<option value=1>Disponible</option>";
   echo "<option value=0>No disponible</option>";
}else{

   echo "<option value=0>No disponible</option>";
    echo "<option value=1>Disponible</option>";
}

  ?>


<?php  
}else {
echo "<option value=1>Disponible</option>";
   echo "<option value=0>No disponible</option>";

}
      
?>
  </select>

    </div>
  </div>
 <div class="form-group">
    <label for="ejemplo_email_3" class="col-lg-2 control-label">Tipo de habitacion</label>
    <div class="col-lg-10">
      <input type="text" class="form-control" name="tipo"
             placeholder="Tipo" <?php if (isset($_GET['id'])) { echo "value='".$tipo."'";   } ?>>
    </div>
  </div>
   <div class="form-group">
    <label for="ejemplo_email_3" class="col-lg-2 control-label">Descripción</label>
    <div class="col-lg-10">
      <textarea name="descripcion" class="form-control" cols="30" rows="3" ><?php if (isset($_GET['id'])) { echo $descripcion;} ?></textarea>
  </div>
  </div>
   
        <?php  
        if (isset($_GET['id'])) {
          echo "<center><input class='btn btn-primary' TYPE='submit' NAME='accion' VALUE='Guardar'></center>";
         echo "<center><input class='btn btn-primary' TYPE='hidden' NAME='bim' VALUE='0'></center>";
         echo "<center><input class='btn btn-primary' TYPE='hidden' NAME='id' VALUE='$_GET[id]'></center>"; 
         }else {
        # code...
          echo "<center><input class='btn btn-primary' TYPE='submit' NAME='accion' VALUE='Guardar'></center>"; 
     echo "<center><input class='btn btn-primary' TYPE='hidden' NAME='bim' VALUE='1'></center>"; 
     

      }
      ?>



    </div>
          </div>    
        </div>
 <?php

if(isset($_POST['accion']) && ($_POST['bim']==1)){
try {

  require_once 'conexion.php';
  $conn = Conectarse();
    

    // prepare sql and bind parameters
    $stmt = $conn->prepare("INSERT INTO tb_habitaciones VALUES (0, :b, :c, :d )");

    $stmt->bindParam(':b', $b);
    $stmt->bindParam(':c', $c);
    $stmt->bindParam(':d', $d);


    // insert a row
    $b = $_POST['estado'];
    $c = $_POST['tipo'];
    $d = $_POST['descripcion'];

    $stmt->execute();

    // insert another row
    /*$a = "otro";
    $b = "1";
    $c = "Chovi G.L.";
    $d = "Invitado";
    $stmt->execute();
    $stmt->execute();*/
echo "<center>";
    echo "Guardado Correctamente";
    echo "</center>";
    }
catch(PDOException $e)
    {
    echo "<center>Error: " . $e->getMessage()."<center>";
    }
$conn = null;
}

if (isset($_POST['id']) && ($_POST['accion']) && ($_POST['bim']==0)) {
  $id_habitacion= $_POST['id'];
  $estado= $_POST['estado'];
  $tipo = $_POST['tipo'];
  $descripcion = $_POST['descripcion'];



try{
require_once 'conexion.php';
  $conn = Conectarse();
  
  $sql = "UPDATE tb_habitaciones SET estado_h='$estado',tipo_h='$tipo',descripcion_h ='$descripcion'
   WHERE id_habitacion = $id_habitacion";

  $stmt = $conn->prepare($sql);
  $stmt->execute();

    echo "<center><h1>  Actualizando </h1></center>";
      echo "<center><h3>Espere por Favor...</h3></center>";
      echo"<meta http-equiv='refresh' content='5; url=http://localhost/princess_one/php/habitacion.php'/ >";
}catch(PDOException $e){
  echo $sql. "<br>" . $e->getMessage();

}

$conn = null;
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