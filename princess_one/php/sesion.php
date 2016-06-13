<?php 
Session_start();


if (isset($_POST["usu"]) && ($_POST["pass"]) && ($_POST["accion"])) {
  # code...


  $usuario1=$_POST["usu"];
  $contra=$_POST["pass"];

  include("conexion.php");
    $pdo = Conectarse();





       $smt = $pdo->query("select * from tb_usuario where usuario='$usuario1' and clave=md5('$contra')");
            //    $smt->bindParam(":u", $usuario);
            //   $smt->bindParam(":p", $contra);  
      $rows= $smt->fetchAll();

    foreach ($rows as $row) {
         $us=$row["usuario"];
         $pss=$row["clave"];
         $activo=$row["estado"];
         $ide=$row["id_empleado"];
         $tipou=$row["tipo_usuario"];

  }
       # code...
#buscando el tipo de empleado
  $sql = 'SELECT *  FROM empleado where id_Empleado='.$ide.'';
            $result = $conn->query($sql);
            $rows = $result->fetchAll();
   foreach ($rows as $row) {
    $te= $row["tipo_e"];
  }



include 'clase.php';
$se = new sesion();
$se->set_u($us);
$se->set_p($pss);
$se->set_activo($activo);

$se->set_tipou($tipou);
   $contra=MD5($contra);
 
 if (($usuario1==$se->get_u()) &&($contra==$se->get_p()) && ($se->get_activo()==1)) {
       $smt = $pdo->query("select nombres, apellidos from empleado where id_Empleado=$ide");
 
      $rows= $smt->fetchAll();

    foreach ($rows as $row) {
      $a=$row["nombres"];
      $b=$row["apellidos"];
      $nom=$a.' '.$b;
  }
  $se->set_ide($nom);

       $est='ok';
       $_SESSION["est"]=$est;
       $_SESSION["usu"]=$se->get_u(); 
       $_SESSION["tipou"]=$se->get_tipou();
      $_SESSION["nombre"]=$se->get_ide();
      $_SESSION["ie"]=$ide;
      $_SESSION["te"]=$te;
      header("Location:http://localhost/princess_one/php/principal.php");
        exit();

   }else {

    header("Location:http://localhost/princess_one/php/sesion.php");
        exit();

   }

   


    


}



 ?>



<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<title>INICIO</title>
	 <!-- CSS de Bootstrap -->
    <link href="../css/bootstrap.min.css" rel="stylesheet">
 
    <!-- librerías opcionales que activan el soporte de HTML5 para IE8 -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>

    <![endif]-->
</head>
<body style="background: url('../img/PO1.jpg')no-repeat center center fixed;"  >


  <div class="container">
      <div class="container1">
        <center>
         <form action="sesion.php" method="POST" class="form">

        <h1>INICIANDO SESIÓN:</h1>
        <br><br>

        <table>
        <tr>

        <td>Usuario: </td>
        <td><input type="text" name="usu" placeholder="usuario" > </td>


        </tr>
        <tr>
        <td>Contraseña: </td>
        <td><input type="password"  name="pass" placeholder="password" > </td>


        </tr>

        <tr>
        <td colspan="2" > <input type="submit"  name="accion" value="Entrar"></td>
        </tr>

        <tr>
        <td colspan="2" > <center><a href="enviarpass.php">Recuperar contraseña...</a></center>   </td>
        </tr>
        </table>  


         </form>
        </center>

     </div>

  </div>








      <script src="../js/bootstrap.min.js"></script>
     <script src="../js/nps.js"></script>
</body>
</html>