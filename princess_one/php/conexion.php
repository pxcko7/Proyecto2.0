<?php 


function Conectarse()
{

	$dbname= "db_prince_one";
	$host="localhost";
	$user="root";
	$password="";

if (!($pdo= new PDO("mysql:dbname=$dbname;host=$host", $user,$password))) {
	# code...
exit();}




return $pdo;



}

 ?>
