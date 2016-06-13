<?php 
Session_start();
  require_once 'conexion.php';
  $conn = Conectarse();

 if(isset($_SESSION['est']) && ($_SESSION['usu']) && ($_SESSION['est']="ok")){
 if (isset($_GET["id"])) {


$id_reservacion = $_GET['id'];

  $sql = "SELECT * FROM tb_reservacion where id_reservacion = $id_reservacion";

foreach($conn->query($sql) as $row) {
  $id_reservacion = $row["id_reservacion"];
  $id_habitacion = $row["id_habitacion"];
  $id_cliente = $row["id_cliente"];


  }
 
  $sql = "update tb_habitaciones set estado_h=1 where id_habitacion=$id_habitacion";
    

 $conn->exec($sql);
 

 }

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


        <div class="col-md-8">
          
        <form class="form-horizontal" role="form" action="registrar_alojamiento.php" method="POST">
 
   <div class="form-group">
    <label for="ejemplo_email_3" class="col-lg-2 control-label">Habitacion</label>
    <div class="col-lg-10">
     <select name="habitacion" class="form-control">
       <?php 
 

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
            name="cliente" placeholder="Cod/cliente" <?php if(isset($_GET["id"])){echo "value='".$id_cliente."'";}?> >
    </div>
  </div>
   <div class="form-group">
    <label for="ejemplo_email_3" class="col-lg-2 control-label">Combo</label>
    <div class="col-lg-10">
      <select name="combo" class="form-control" >
        <?php  
 $sql = "SELECT * FROM combo";

      foreach($conn->query($sql) as $row) {
     
          echo "<option value='".$row['id_combo']."'>".$row['nombre_combo']."</option>";
      
        }


        ?>



      </select>
    </div>
  </div>
    
      <div class="form-group">
      <div class="col-lg-10">
       
        <center><input class='btn btn-primary' TYPE='submit' NAME='accion' VALUE='Guardar'></center>
       <?php if (isset($_GET["id"])) {
         # code...
        echo '<input type="hidden" name="idd" value="'.$_GET["id"].'">';
       } ?> 


   




   



    </div>
          </div>    
        </div>
 <?php

#alojamientos
if(isset($_POST['accion'])){
  #verificaando cliente
 $buscarc= $conn->prepare('SELECT * FROM tb_cliente where id_cliente='.$_POST['cliente'].'');
$buscarc->execute();

$cuenta=$buscarc->rowCount();
if ($cuenta>0) {
try {
  #buscando alojamiento
   $buscara = $conn->prepare('SELECT * FROM tb_alojamiento where id_cliente='.$_POST['cliente'].'');
         $buscara->execute();

          $cuenta=$buscara->rowCount();
          if ($cuenta>0) {  
           echo "<script>alert('NO puede registrar con este código ¡ya tiene alojamiento');</script>";
              echo"<meta http-equiv='refresh' content='0; url=http://localhost/princess_one/php/registrar_alojamiento.php'/ >";
     



          }
            else{
  require_once 'conexion.php';
  $conn = Conectarse();
    

    // prepare sql and bind parameters
    $stmt = $conn->prepare("INSERT INTO tb_alojamiento VALUES (0, :b, :c, :d, :e, :f,1)");

    $stmt->bindParam(':b', $b);
    $stmt->bindParam(':c', $c);
    $stmt->bindParam(':d', $d);
  $stmt->bindParam(':e', $e);
  $stmt->bindParam(':f', $f);


    // insert a row
   
    $b = $_POST['habitacion'];
    $c = $_SESSION["ie"];
    $d = $_POST['cliente'];
     $e = $_POST['combo'];
  $f = date("Y-m-d");
 
    $stmt->execute();


   $id_habitacion=$_POST['habitacion'];
     $sql = "update tb_habitaciones set estado_h=0 where id_habitacion=$id_habitacion";
     $conn->exec($sql);
 

      #**************************creando factura del alojamiento************************************************************
   
           

      #buscando alojamiento final
      $sql = 'SELECT MAX(id_alojamiento) as idaa FROM tb_alojamiento';
                $result = $conn->query($sql);
                $rows = $result->fetchAll();
                foreach ($rows as $row) {
                $idaa=$row["idaa"];
              }
              #buscando factura
        $buscarf = $conn->prepare('SELECT * FROM tb_factura where id_cliente='.$d.'');
           $buscarf->execute();

     $cuenta=$buscarf->rowCount();
    if ($cuenta>0) {
                    # extrayendo codigo de la factura
                  $sql = "SELECT * FROM tb_factura where id_cliente=$d";
                  foreach($conn->query($sql) as $row) {
                   $idfa=$row["id_factura"];
                  }

              #    echo "<script>alert('Si hay $idfa registros en tb_factura');</script>";

                  #buscando precio del combo
                  $sql = "SELECT * FROM combo where id_combo=$e";
                  $result = $conn->query($sql);
                  $rows = $result->fetchAll();
                  foreach ($rows as $row) {
                      $precioc=$row["precio"];
                  }
            echo "<script>alert('Si precio: $precioc ');</script>";


/*
                  #actualizando la factura
                  $sql2 = "update tb_factura set id_alojamiento=$idaa, total_pagar=total_pagar+$precioc where id_factura=$idfa";
                   $conn->exec($sql2);*/

      }else{
          # code...
        #  echo "<script>alert('Creando nueva factura');</script>";
          #creando factura
  
          $f = date("Y-m-d");
          $stmt = $conn->prepare("INSERT INTO tb_factura VALUES (0, $c, $d, $idaa, '$f', 0)");
          $stmt->execute();

          $sql = 'SELECT MAX(id_factura) as idf FROM tb_factura';
          $result = $conn->query($sql);
          $rows = $result->fetchAll();
          foreach ($rows as $row) {

            $idfa=$row["idf"];
            }


        }

  require_once 'conexion.php';
  $conn = Conectarse();
        #buscando precio del combo
                  $sql = "SELECT precio as p FROM combo where id_combo=1";
                  $result = $conn->query($sql);
                  $rows = $result->fetchAll();
                  foreach ($rows as $row) {
                      $precioc=$row["p"];
                  }
             #     echo "<script>alert('Si precio: $precioc ');</script>";
          #actualizando la factura
        $sql2 = "update tb_factura set id_alojamiento=$idaa, total_pagar=total_pagar+$precioc where id_factura=$idfa";
                   $conn->exec($sql2);
             
              /*
          #buscando alojamiento
          $buscara = $conn->prepare('SELECT * FROM tb_alojamiento where id_cliente='.$d.'');
           $buscara->execute();

          $cuenta=$buscara->rowCount();
          if ($cuenta>0) {
                      $sql = "SELECT * FROM tb_alojamiento where id_cliente=$d";
                      foreach($conn->query($sql) as $row) {
                       $idalojamiento=$row["id_alojamiento"];
                      }
                    echo "<script>alert('esta registrado en alojamientos');</script>";
                    

          }else {
                    echo "<script>alert('NO esta registrado en alojamientos');</script>";

                      $idalojamiento=0;
          }

            #creando factura
  
          $f = date("Y-m-d");
          $stmt = $conn->prepare("INSERT INTO tb_factura VALUES (0, $c, $idc, $idalojamiento, '$f', 0)");
          $stmt->execute();

          $sql = 'SELECT MAX(id_factura) as idf FROM tb_factura';
          $result = $conn->query($sql);
          $rows = $result->fetchAll();
          foreach ($rows as $row) {

          $idfa=$row["idf"];

        */
        echo "Guardado Correctamente";   

}


 
    }
catch(PDOException $e)
    {
    echo "<center>Error: " . $e->getMessage()."<center>";
    }
$conn = null;
if (isset($_POST["idd"])) {
  require_once 'conexion.php';
  $conn = Conectarse();
   $id_reservacion=$_POST["idd"];

     $sql2 = "delete from tb_reservacion where id_reservacion=$id_reservacion";
      $conn->exec($sql2);
    }

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