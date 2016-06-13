<?php 
Session_start();


 if(isset($_SESSION['est']) && ($_SESSION['usu']) && ($_SESSION['est']="ok")){
  

  
  

  ?>
 

<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Ordenar</title>
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
    <script type="text/javascript">
/* Funciones JavaScript
   Versión 0.1
   Autor: César Krall
   Curso: Tutorial básico del programador web: JavaScript desde cero
*/

//Función que muestra mensaje de bienvenida
function funciona(v1,v2) {
  if (v1.checked==true) { 
 
    v2.disabled=false;

};
 if (v1.checked==false) { 
 
    v2.disabled=true;
    v2.value="";

};
 
}
function mayor(c1,c2) {

if (parseFloat(c2.value)<1) {alert('Cantidad invalida!'); 
c2.value="";

};
if (parseFloat(c2.value)>c1.value) {alert('Cantidad sobre pasa los platillos!'); 
c2.value="";
};

}




</script>
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
            <li><a href="ordenar.php"><h4 class="sub-header">Menú</h4></a></li>
            <li><a href="registrar_menu.php">Nuevo</a></li>
            <li><a href="#">Buscar</a></li>
            <li><a href="r_menu.php" target="_blank">Reporte</a></li>
          </ul>
        </div>



 <div class="col-md-4"><h2 class="sub-header">Menu del día</h2></div>


 <div class="col-md-10 col-md-offset-0">
        <?php

require_once('conexion.php');
$conn = Conectarse();
$sql = 'SELECT * FROM plato';
$result = $conn->query($sql);
$t='p';

$rows = $result->fetchAll();
?>
 <div class="table-responsive">
  <?php echo '<form action="pcocina.php?&t='.$t.'" method="POST" >'; ?>

 <table class="table table-hover">
<thead>
  <tr>
    <th>N° platillo</th>
     <th>Descripción</th>
    <th>Precio</th>
    <th>Cantidad</th>
    


    

  </tr>

</thead>
<tbody>
  <?php
$i=3;
  foreach ($rows as $row) {
     
       # code...
     

  ?>
  <tr>

    <td>

<?php echo '<input  name="pla'.$i.'" type="text" class="form-control"  value="'.$row['id_plato'].'" readonly>'; ?> 


    </td>
    <td><?php echo $row['descripcion'];?></td>
    <td><?php echo '<input  name="p'.$i.'" type="text" class="form-control" value="'.$row['precio_unitario'].'" readonly>'; ?></td>
    <td> <?php echo '<input id="cant'.$i.'" name="cant" type="text" class="form-control" value="'.$row['cantidad'].'" readonly>'; ?>  </td>

    <td>  <?php echo '<input id="cb'.$i.'" name="cb'.$i.'" type="checkbox" onclick="funciona(cb'.$i.',cant_o'.$i.')">'; ?>  </td>
    <td>  <?php echo '<input id="cant_o'.$i.'" name="canto'.$i.'" type="text"  onChange="mayor(cant'.$i.',cant_o'.$i.')" class="form-control" disabled>'; ?>   

     </td>


  <td>
 
  
  </tr>
  <?php




$i++;
}
?>
 

</table>
<input type="hidden" name="j" value="<?php echo $i; ?>">
<div class="col-md-3"><input placeholder="Id/cliente"  type="text" name="i_c" class="form-control"></div>

 <input type="submit"class='btn btn-sm btn-primary' value="Ordenar"></td>
 </form>
 </div>
  </div>        



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