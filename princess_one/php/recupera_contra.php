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
         $activo=$row["activo"];
         $ide=$row["id_empleado"];
         $tipou=$row["tipo_usuario"];

  }
       # code...
 
include 'clase.php';
$se = new sesion();
$se->set_u($us);
$se->set_p($pss);
$se->set_activo($activo);
$se->set_ide($ide);
$se->set_tipou($tipou);
   $contra=MD5($contra);
 
 if (($usuario1==$se->get_u()) &&($contra==$se->get_p()) && ($se->get_activo()==1)) {
        # code...

       $est='ok';
       $_SESSION["est"]=$est;
       $_SESSION["usu"]=$se->get_u(); 
       $_SESSION["tipou"]=$se->get_tipou();
      $_SESSION["ide"]=$se->get_ide();
      header("Location:http://localhost/princess_one1/php/principal.php");
        exit();

   }else {

    header("Location:http://localhost/princess_one1/php/sesion1.php");
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
<body>


  <div class="container">
      <div class="container1">
        <center>
         <form action="recupera_contra.php" method="POST">

        <br>
        <h3>Ingresa tu correo electronico para mandarte un mensaje de confirmacion.</h3>
        <table>
        <tr>

        <td>Correo: </td>
        <td><input type="email" name="usu" placeholder="ejemplo@hotmail.com" > </td>


        </tr>
        
        <tr>
        <td colspan="2" > <center><input type="submit"  name="accion" value="Enviar"></center></td>
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