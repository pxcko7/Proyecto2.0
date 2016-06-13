<?php 
Session_start();
include_once('conexion.php');

$conn =  Conectarse();

 if(isset($_SESSION['est']) && ($_SESSION['usu']) && ($_SESSION['est']="ok")){
  if (isset($_GET['id'])) {
    # code...

  $id_usuario = $_GET['id'];

#consulta de la base de datos

  $sql = "SELECT * FROM tb_usuario inner join empleado on tb_usuario.id_empleado=empleado.id_Empleado where id_usuario = $id_usuario";

foreach($conn->query($sql) as $row) {
  $id_usuario= $row["id_usuario"];
  $usuario = $row["usuario"];
  $clave = $row["clave"] ;
  $estado = $row["estado"];
  $tipo_usuario=$row["tipo_usuario"];

  $a=$row["nombres"];
  $b = $row["apellidos"];
  $nombreusuario = $a.' '.$b;

  }

  }

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
            <li><a href="r_habitacion.php" target="_blank">Reporte</a></li>
          </ul>
        </div>
        <div class="col-md-8">
          
        <form class="form-horizontal" role="form" action="registrar_usuario.php" method="POST">
 
   <div class="form-group">
    <label for="ejemplo_email_3" class="col-lg-2 control-label">Tipo de usuario</label>
    <div class="col-lg-10">
  <select name="tipo_u" class="form-control" >
    
<?php if (isset($_GET['id'])) {
if ($tipo_usuario=='Administrador') {
  # code...
  echo "<option value='Administrador'>Administrador</option>";
   echo "<option value='Empleado'>Empleado</option>";
}else{

   echo "<option value='Empleado'>Empleado</option>";
    echo "<option value='Administrador'>Administrador</option>";
}

  ?>


<?php  
}else {
echo "<option value='Administrador'>Administrador</option>";
   echo "<option value='Empleado'>Empleado</option>";

}
      
?>
  </select>

    </div>
  </div>
 <div class="form-group">
    <label for="ejemplo_email_3" class="col-lg-2 control-label">
      Empleado</label>
    <div class="col-lg-10">
    <select name='empleado' class='form-control' >
    
<?php if (isset($_GET['id'])) {

echo "<option value='".$_GET['id']."'>".$nombreusuario."</option>";


  ?>


<?php  
}else {

#consulta de la base de datos

  $sql = "SELECT * FROM empleado order by id_Empleado desc";

foreach($conn->query($sql) as $row) {
  $id_e=$row["id_Empleado"];
  $a=$row["nombres"];
  $b = $row["apellidos"];
  $nombreusuario = $a.' '.$b;
  if ($row['estado']) {
    # code...
    echo "<option value='".$id_e."'>".$nombreusuario."</option>";
  }
 
}
 }     
?>
</select> 
    </div>
  </div>
   <div class="form-group">
    <label for="ejemplo_email_3" class="col-lg-2 control-label">Usuario</label>
    <div class="col-lg-10">
      <input type="text" name="usuario" class="form-control" <?php if (isset($_GET['id'])) { echo "value='".$usuario."'";   } ?>>
  </div>
  </div>
   <div class="form-group">
    <label for="ejemplo_email_3" class="col-lg-2 control-label">Contraseña</label>
    <div class="col-lg-10">
      <input type="password" name="contra1" class="form-control">
  </div>
  </div>
    <div class="form-group">
    <label for="ejemplo_email_3" class="col-lg-2 control-label">Confirmar contraseña</label>
    <div class="col-lg-10">
      <input type="password" name="contra2" class="form-control">
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
if ($_POST['contra1']==$_POST['contra2']){

try {


    // prepare sql and bind parameters
    $stmt = $conn->prepare("INSERT INTO tb_usuario VALUES (0, :b, MD5(:c), :d, :e, 1)");

    $stmt->bindParam(':b', $b);
    $stmt->bindParam(':c', $c);
    $stmt->bindParam(':d', $d);
    $stmt->bindParam(':e', $e);


    // insert a row
    $b = $_POST['usuario'];
    $c = $_POST['contra1'];
    $d = $_POST['empleado'];
    $e = $_POST['tipo_u'];
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
}else {
 echo "<center>Error no coinciden las Contraseñas </center>";
}
}
//actualizando datos de usuario

if (isset($_POST['id']) && ($_POST['accion']) && ($_POST['bim']==0)) {
  if ($_POST['contra1']==$_POST['contra2']){
  $id_usuario= $_POST['id'];
  $usuario= $_POST['usuario'];
  $clave = $_POST['contra1'];
  $tipo_u = $_POST['tipo_u'];



try{
require_once 'conexion.php';
  $conn = Conectarse();
  
  $sql = "UPDATE tb_usuario SET usuario='$usuario',clave=MD5('$clave'),tipo_usuario ='$tipo_u'
   WHERE id_usuario = $id_usuario";

  $stmt = $conn->prepare($sql);
  $stmt->execute();

    echo "<center><h1>  Actualizando </h1></center>";
      echo "<center><h3>Espere por Favor...</h3></center>";
      echo"<meta http-equiv='refresh' content='0; url=http://localhost/princess_one/php/usuario.php'/ >";
}catch(PDOException $e){
  echo $sql. "<br>" . $e->getMessage();

}

$conn = null;
}else {

 echo "<center>Error no coinciden las Contraseñas </center>";
 echo"<meta http-equiv='refresh' content='0; url=http://localhost/princess_one/php/registrar_usuario.php?&id=".$_POST['id']."'/ >";

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