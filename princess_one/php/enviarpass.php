<?php
if (isset($_POST['accion'])) {

	include('conexion.php');

	$conn = Conectarse();

	$correo = $_POST['correo'];

		$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

	$qg = $conn->prepare("SELECT * FROM empleado  where correo = '$correo'");
			$qg->execute();


			$em = $qg->fetch(PDO::FETCH_ASSOC)['correo'];


			$sql = 'SELECT * FROM empleado where correo="'.$correo.'"';
			$result = $conn->query($sql);
			$rows = $result->fetchAll();
			foreach ($rows as $row) {

				$i_em=$row['id_Empleado'];
			}




			if ($em== $correo) {


				//generar contraseña aleatoria

			function passs_randow($length = 6){

				$charset ="ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijkemnopqrstuvwxyz0123456789%$/()#?";
				$password= "";

				for ($i=0; $i < $length; $i++) {

				$rand = rand()%strlen($charset);
				$password .= substr($charset, $rand,1);
		
				}
					return $password;
			} 
				$newpass = passs_randow(5);
				    $conn = Conectarse();
				$squery = 'update tb_usuario SET clave = MD5("'.$newpass.'") where id_empleado = '.$i_em.'';

					 $conn->exec($squery);


					
				echo "<script>alert('Su nueva contraseña ha ".$i_em." sido enviada a su correo electrónico.')</script>";

				echo  "<script>alert('mail(Destinatario.  ".$correo.", Asunto.  Estimado usuario Su nueva contraseña es:  ".$newpass."".".  Mensaje. Esta es una prueba de mail con php".")')</script>";

				echo"<meta http-equiv='refresh' content='0; url=http://localhost/princess_one/php/sesion.php'/ >";

			}else{

			echo "<script>alert('Este correo electronico es incorrecto. No puede generarse su password')</script>";
			echo"<meta http-equiv='refresh' content='0; url=http://localhost/princess_one/php/sesion.php'/ >";

			}

}


?>


<!DOCTYPE html>

<html lang="es">
<head>
	<meta charset="UTF-8">
	
	<title>Olvido su contraseña</title>
	 <!-- CSS de Bootstrap -->
    <link href="../css/bootstrap.min.css" rel="stylesheet">
 
    <!-- librerías opcionales que activan el soporte de HTML5 para IE8 -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>

    <![endif]-->
</head>
<body>
<body style="background: url('../img/PO1.jpg')no-repeat center center fixed;"  >


  <div class="container">
      <div class="container1">
    
<center><p class="alert alert-danger"  >¿Necesita recuperar su contraseña?</p></center><br><br>

<form action="enviarpass.php" method="POST">
	<center ><table><tr><td>

	
<font color ="black" ><label>Digite Su correo Electrónico:</label></font><input type="email" name="correo" 
class="form-control" placeholder="Ingrese su correo" required ><br></td></tr><tr><td>

	<input type="submit" value="RECUPEARAR CONTRASEÑA" class="btn btn-primary" name="accion">
	<a href="sesion.php" class = "btn btn-primary" >Atras</a>
	
</td></tr>
	</table></center>
</form>
</div>
</div>

</body>
</html>