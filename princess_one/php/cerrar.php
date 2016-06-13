
 <html>
 <head>
 	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
 	<title>cerrando</title>
 	<meta http-equiv="refresh" content="3; url=http://localhost/princess_one/php/sesion.php">
 	 <link href="../css/bootstrap.min.css" rel="stylesheet">
 </head>
 <body style="background: url('../img/PO1.jpg')no-repeat center center fixed;">

  <div class="container">
      <div class="container1">
       
<center><h1>Cerrando la sesion</h1>
<br>
Espere por favor...</center>
     </div>

  </div>








      <script src="../js/bootstrap.min.js"></script>
     <script src="../js/nps.js"></script>


 
 </body>
 </html>

<?php 
Session_start();
$_SESSION["est"]="";
$_SESSION["us"]="";
$_SESSION["tipo"]="";

session_unset(); //barra variables de sesion
session_destroy(); //finaliza sesion

exit();


 ?>