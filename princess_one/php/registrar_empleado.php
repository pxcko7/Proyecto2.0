<?php 
Session_start();


 if(isset($_SESSION['est']) && ($_SESSION['usu']) && ($_SESSION['est']="ok")){
  if (isset($_GET['id'])) {
    # code...
    include_once('conexion.php');

$conn =  Conectarse();

  $id_Empleado = $_GET['id'];



  $sql = "SELECT * FROM empleado where id_Empleado = $id_Empleado";

foreach($conn->query($sql) as $row) {
  $id_Empleado = $row["id_Empleado"];
  $nombres = $row["nombres"];
  $apellidos = $row["apellidos"] ;
  $dui = $row["dui"];
  $direccion = $row["direccion"];
  $telefono = $row["telefono"];
  $correo = $row["correo"];
  }

  }

  ?>
 

<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Empleado</title>
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
            <li><a href="empleado.php?&empleado=1"><h4 class="sub-header">Empleados</h4></a></li>
            <li><a href="registrar_empleado.php">Nuevo</a></li>
            <li><a href="registrar_empleado.php?&empleado_i=1">Inactivos</a></li>
            <li><a href="#">Buscar</a></li>
            <li><a href="r_empleado.php" target="_blank">Reporte</a></li>
          </ul>
        </div>
        <div class="col-md-8">
          
        <form class="form-horizontal" role="form" action="registrar_empleado.php" method="POST">
 
   <div class="form-group">
    <label for="ejemplo_email_3" class="col-lg-2 control-label">Nombre</label>
    <div class="col-lg-10">
      <input type="text" class="form-control" name="nombre"
             placeholder="Nombre"  <?php if (isset($_GET['id'])) { echo "value='".$nombres."'";   } ?>>
    </div>
  </div>
 <div class="form-group">
    <label for="ejemplo_email_3" class="col-lg-2 control-label">Apellido</label>
    <div class="col-lg-10">
      <input type="text" class="form-control" name="apellido"
             placeholder="Nombre" <?php if (isset($_GET['id'])) { echo "value='".$apellidos."'";   } ?>>
    </div>
  </div>
   <div class="form-group">
    <label for="ejemplo_email_3" class="col-lg-2 control-label">Dui</label>
    <div class="col-lg-10">
      <input type="text" class="form-control" name="dui"
             placeholder="DUI"  <?php if (isset($_GET['id'])) { echo "value='".$dui."'";   } ?>>
    </div>
  </div>
   <div class="form-group">
    <label for="ejemplo_email_3" class="col-lg-2 control-label">Dirección</label>
    <div class="col-lg-10">
      <textarea name="direccion" class="form-control" cols="30" rows="3" ><?php if (isset($_GET['id'])) { echo $direccion;} ?></textarea>
  </div>
    </div>
   <div class="form-group">
    <label for="ejemplo_email_3" class="col-lg-2 control-label">Teléfono</label>
    <div class="col-lg-10">
      <input type="text" class="form-control" name="telefono"
             placeholder="Teléfono"  <?php if (isset($_GET['id'])) { echo "value='".$telefono."'";   } ?>>
    </div>
      </div>
   <div class="form-group">
    <label for="ejemplo_email_3" class="col-lg-2 control-label">Correo</label>
    <div class="col-lg-10">
      <input type="email" class="form-control" name="correo"
             placeholder="E-mail"  <?php if (isset($_GET['id'])) { echo "value='".$correo."'";   } ?>>
    </div>
      </div>
      <div class="form-group">
      <div class="col-lg-10">
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

if(isset($_POST['accion']) && ($_POST['bim']=='1')){
try {

  require_once 'conexion.php';
  $conn = Conectarse();
    

    // prepare sql and bind parameters
    $stmt = $conn->prepare("INSERT INTO empleado (id_Empleado, nombres, apellidos, dui, direccion, telefono, correo,estado) VALUES (0, :b, :c, :d, :e, :f, :g,1)");

    $stmt->bindParam(':b', $b);
    $stmt->bindParam(':c', $c);
    $stmt->bindParam(':d', $d);
  $stmt->bindParam(':e', $e);
  $stmt->bindParam(':f', $f);
  $stmt->bindParam(':g', $g);

    // insert a row
   
    $b = $_POST['nombre'];
    $c = $_POST['apellido'];
    $d = $_POST['dui'];
  $e = $_POST['direccion'];
  $f = $_POST['telefono'];
  $g = $_POST['correo'];
    $stmt->execute();

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
}
//aqui se empieza a actualizar

if (isset($_POST['accion']) && ($_POST['bim']==0)) {
  $id_Empleado= $_POST['id'];
  $nombres= $_POST['nombre'];
  $apellidos = $_POST['apellido'];
  $dui = $_POST['dui'];
  $direccion = $_POST['direccion'];
  $telefono = $_POST['telefono'];
  $correo = $_POST['correo'];


try{
require_once 'conexion.php';
  $conn = Conectarse();
  
  $sql = "UPDATE empleado SET nombres='$nombres',apellidos='$apellidos',dui ='$dui', direccion ='$direccion',
  telefono ='$telefono', correo='$correo' WHERE id_Empleado = $id_Empleado";

  $stmt = $conn->prepare($sql);
  $stmt->execute();

    echo "<center><h1>  Actualizando </h1></center>";
      echo "<center><h3>Espere por Favor...</h3></center>";
      echo"<meta http-equiv='refresh' content='5; url=http://localhost/princess_one/php/empleado.php?&empleado=1'/ >";
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