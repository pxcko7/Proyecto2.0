<?php session_start()


 ?>
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
  $conn = Conectarse();
if (isset($_GET['t'])) {
if ($_GET['t']=="p") {

if (isset($_REQUEST["i_c"])) {
  # code...
  if ($_REQUEST["i_c"]<>"") {
    # code...
 $idc=$_REQUEST["i_c"];
#buscando Cliente en la base de datos
$buscarc= $conn->prepare('SELECT * FROM tb_cliente where id_cliente='.$idc.'');
$buscarc->execute();

$cuenta=$buscarc->rowCount();
if ($cuenta>0) {
    #buscando Facturas con el id enviado
    $buscarf = $conn->prepare('SELECT * FROM tb_factura where id_cliente='.$idc.'');
    $buscarf->execute();

    $cuenta=$buscarf->rowCount();
    if ($cuenta>0) {
      # code...
                  $sql = "SELECT * FROM tb_factura where id_cliente=$idc";
                  foreach($conn->query($sql) as $row) {
                   $idfa=$row["id_factura"];
                  }
     # echo "<script>alert('Si hay $idfa registros en tb_factura');</script>";



      }else{
    # code...
    echo "<script>alert('NO hay registros en tb_factura');</script>";
        #buscando alojamientos
        $buscara = $conn->prepare('SELECT * FROM tb_alojamiento where id_cliente='.$idc.'');
         $buscara->execute();

          $cuenta=$buscara->rowCount();
          if ($cuenta>0) {
                      $sql = "SELECT * FROM tb_alojamiento where id_cliente=$idc";
                      foreach($conn->query($sql) as $row) {
                       $idalojamiento=$row["id_alojamiento"];
                      }
               #     echo "<script>alert('esta registrado en alojamientos');</script>";
                    

          }else {
                  #  echo "<script>alert('NO esta registrado en alojamientos');</script>";

                      $idalojamiento=0;
          }

          $ie=$_SESSION['ie'];
          $f = date("Y-m-d");
          $stmt = $conn->prepare("INSERT INTO tb_factura VALUES (0, $ie, $idc, $idalojamiento, '$f', 0)");
          $stmt->execute();

           $sql = 'SELECT MAX(id_factura) as idf FROM tb_factura';
          $result = $conn->query($sql);
          $rows = $result->fetchAll();
          foreach ($rows as $row) {

          $idfa=$row["idf"];
          }


          
    }
$pedido=1;

}else{
  # code...

  echo "<script>alert('NO Existe cliente registrado con este código');</script>";
  echo"<meta http-equiv='refresh' content='0; url=http://localhost/princess_one/php/ordenar.php'/ >";
     
$pedido=0;
}

/*
$sql = 'SELECT * FROM tb_alojamiento where id_cliente='.$idc.'';
$result = $conn->query($sql);
$rows = $result->fetchAll();
foreach ($rows as $row) {
$idalojamiento=$row["id_alojamiento"];

}
$ie=$_SESSION['ie'];
$f = date("Y-m-d");
 $stmt = $conn->prepare("INSERT INTO tb_factura VALUES (0, $ie, $idc, $idalojamiento, '$f', 0)");

    $stmt->execute();

  $sql = 'SELECT * FROM tb_factura where id_cliente = '.$idc.'';

$result = $conn->query($sql);
$rows = $result->fetchAll();
foreach ($rows as $row) {
$idfa=$row["id_factura"];
}


}

}else{
  $sql = 'SELECT MAX(id_factura) as idf FROM tb_factura';
$result = $conn->query($sql);
$rows = $result->fetchAll();
foreach ($rows as $row) {
$idfa=$row["idf"];
}
  $idc=0;
  $idalojamiento=0;

}


for ($i=3; $i < $_POST["j"] ; $i++) { 
  # code...
if (isset($_POST["cb$i"])) {
#consultar el precio del plato
$preu=$_REQUEST["p$i"];

 




    #insertar a detalle factura
 $stmt = $conn->prepare("INSERT INTO tb_detalle_factura VALUES (0, :b, :c, :d, :e)");

    $stmt->bindParam(':b', $b);
    $stmt->bindParam(':c', $c);
    $stmt->bindParam(':d', $d);
  $stmt->bindParam(':e', $e);


    // insert a row
   
    $b = $idfa;
    $c = $_REQUEST["pla$i"];
    $d = $_REQUEST['canto'.$i.''];

    $total= $d *$preu;

     $e = $total;
     $stmt->execute();

     $sql1 = "update plato set cantidad=cantidad-$d where id_plato=$c";
     $conn->exec($sql1);


      $sql2 = "update tb_factura set total=total+$total where id_factura=$idfa";
     $conn->exec($sql2);
**/

}else {
      #creando factura sin registro de cliente y sin alojamiento, factura generica
          $ie=$_SESSION['ie'];
          $f = date("Y-m-d");
          $stmt = $conn->prepare("INSERT INTO tb_factura VALUES (0, $ie, 0, 0, '$f', 0)");
          $stmt->execute();

          $sql = 'SELECT MAX(id_factura) as idf FROM tb_factura';
          $result = $conn->query($sql);
          $rows = $result->fetchAll();
          foreach ($rows as $row) {

          $idfa=$row["idf"];

          }




#Creando detalle de Factura para las diferentes opciones

    
$pedido=1;


   }

if ($pedido) {
  
  try{
  $conn = Conectarse();

for ($i=3; $i < $_POST["j"] ; $i++) { 
        if (isset($_POST["cb$i"])) {
          #c precio unitario
          $preu=$_REQUEST["p$i"];
            #insertar a detalle factura
         $stmt = $conn->prepare("INSERT INTO tb_detalle_factura VALUES (0, :b, :c, :d, :e)");

            $stmt->bindParam(':b', $b);
            $stmt->bindParam(':c', $c);
            $stmt->bindParam(':d', $d);
          $stmt->bindParam(':e', $e);
           
            $b = $idfa;
            $c = $_REQUEST["pla$i"];
            $d = $_REQUEST['canto'.$i.''];

            $total= $d *$preu;

             $e = $total;
             $stmt->execute();

            #actualizan la cantidad de platos disponible
             $sql1 = "update plato set cantidad=cantidad-$d where id_plato=$c";
              $conn->exec($sql1);
              
              #actualizando el total a pagar de la factura
             $sql2 = "update tb_factura set total_pagar=total_pagar+$total where id_factura=$idfa";
             $conn->exec($sql2);
        }
}
   


  echo "<center><h3>  Pedidos </h3></center>";
      echo "<center><h3>Espere Por Favor...</h3></center>";

  
     echo"<meta http-equiv='refresh' content='0; url=http://localhost/princess_one/php/ordenar.php'/ >";
     

  }catch(PDOException $e){
  echo $sql. "<br>" . $e->getMessage();


  }
}
$conn = null;
}
}
}


?>



     </div>

  </div>


      <script src="../js/bootstrap.min.js"></script>
     <script src="../js/nps.js"></script>

 </body>
 </html>