
 <html>
 <head>
 	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
 	<title>Procesando</title>
 	 <link href="../css/bootstrap.min.css" rel="stylesheet">
 </head>
 <body style="background: url('../img/PO1.jpg')no-repeat center center fixed;">

  <div class="container">
      <div class="container1">
       <?php
  require_once 'conexion.php';
if (isset($_GET['id'])&&($_GET['t'])) {
if ($_GET['t']=="e") {
  # code...

    $id_Empleado=$_GET['id'];
     $sql = "update empleado set estado=0 where id_Empleado=$id_Empleado";


    }

if ($_GET['t']=="c") {
    $id_cliente=$_GET['id'];

      $sql = "update tb_cliente set estado=0 where id_cliente=$id_cliente";
    
    }
  if ($_GET['t']=="ca") {
    $id_cliente=$_GET['id'];

      $sql = "update tb_cliente set estado=1 where id_cliente=$id_cliente";
    
    }
    if ($_GET['t']=="ea") {
    $id_Empleado=$_GET['id'];

      $sql = "update empleado set estado=1 where id_Empleado=$id_Empleado";
    
    }
      if ($_GET['t']=="a") {
    $id_Empleado=$_GET['id'];

      $sql = "update alojamiento set estado=1 where id_Empleado=$id_Empleado";
    
    }

    if ($_GET['t']=="r") {
    $id_reservacion=$_GET['id'];
      $id_h=$_GET['id_h'];  
      $sql = "delete from tb_reservacion where id_reservacion=$id_reservacion";
 

    $conn = Conectarse();

    $sql1 = "update tb_habitaciones set estado_h=1 where id_habitacion=$id_h";
     $conn->exec($sql1);
    
    }
    if ($_GET['t']=="mr") {
    $idh=$_GET['id'];
  $conn = Conectarse();

$sql1 = "update tb_manto set estado=0 where id_habitacion=$idh";
     $conn->exec($sql1);

     $sql = "update tb_habitaciones set estado_h=1 where id_habitacion=$idh";




    
    }

  if ($_GET['t']=="m") {
    $id_h=$_GET['id'];

echo '<form class="form-horizontal" role="form" action="borrando.php?&t='.$_GET['t'].'&id='.$_GET['id'].'" method="POST">';
echo '<div class="form-group">
    <label for="ejemplo_email_3" class="col-lg-2 control-label">Descripción</label>
    <div class="col-lg-10">
      <textarea name="descripcion" class="form-control" cols="30" rows="3" ></textarea>
  </div>
  </div>';
  echo "<center>
<input type='hidden' name='idh' value='".$id_h."'>
  <input class='btn btn-primary' TYPE='submit' NAME='accion' VALUE='Guardar'></center>
    
  </div>";
if (isset($_POST["idh"])) {
  # code...
  $idh=$_POST["idh"];
  $descripcion=$_POST["descripcion"];
  $f=date("Y-m-d");
 $sql = "insert into tb_manto values(0,'".$f."',".$idh.",'".$descripcion."',1)";
  

  $conn = Conectarse();
  $conn->exec($sql);

$sql1 = "update tb_habitaciones set estado_h=0 where id_habitacion=$idh";
     $conn->exec($sql1);


 echo"<meta http-equiv='refresh' content='0; url=http://localhost/princess_one/php/habitacion.php?&h=1'/ >";


}

     
    }
if ($_GET['t']<>"m") {
  # code..

  try{
   
  $conn = Conectarse();
  
#  $sql = "DELETE FROM  empleado WHERE id_Empleado = $id_Empleado";
 


  $conn->exec($sql);

  echo "<center><h1>  Actualizando </h1></center>";
      echo "<center><h3>Espere Por Favor...</h3></center>";

      if ($_GET['t']=="c" || $_GET['t']=="ca") {
        # code...
        echo"<meta http-equiv='refresh' content='0; url=http://localhost/princess_one/php/cliente.php?&cliente=1'/ >";
      }
      if ($_GET['t']=="e" || $_GET['t']=="ea") {
        # code...
      
      echo"<meta http-equiv='refresh' content='0; url=http://localhost/princess_one/php/empleado.php?&empleado=1'/ >";
      }
      if ($_GET['t']=="r") {
        # code...
         echo"<meta http-equiv='refresh' content='0; url=http://localhost/princess_one/php/reservacion.php'/ >";
    
      }
   if ($_GET['t']=="mr") {
     # code...
         echo"<meta http-equiv='refresh' content='0; url=http://localhost/princess_one/php/habitacion.php?&h=1'/ >";
    
      }

  }catch(PDOException $e){
  echo $sql. "<br>" . $e->getMessage();


  }

$conn = null;

}
}


?>
















     </div>

  </div>


      <script src="../js/bootstrap.min.js"></script>
     <script src="../js/nps.js"></script>

 </body>
 </html>