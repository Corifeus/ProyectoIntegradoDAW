<?php
include("mysqli.inc.php");


if($c = mysqli_connect($cfg_servidor,$cfg_usuario,$cfg_password,$cfg_basephp1)){
 /*print "<br>La conexión con el servidor de bases de datos mediante procesos se ha realizado con
exito<br>";*/


$tabla="usuarios";

$nombre=$_POST['nombre_usuario'];
$contrasenya=$_POST['contrasenya'];
$email=$_POST['email'];
$idsteam=$_POST['idsteam'];
$foto=$_POST['foto'];
$privacidad=$_POST['privacidad'];


/****** Programación mediante procesos ***********/
$sentencia="INSERT INTO $tabla (Nombre_usuario,Contrasenya,Email,Id_Steam,Foto,Privacidad) VALUES
('$nombre','$contrasenya','$email','$idsteam','$foto','$privacidad')";


if(mysqli_query($c,$sentencia)){
	/*print "<br>Se ha registrado correctamente :D<br>";*/
	echo '
		<html>
			<head>
				<title>Felicidades</title>
				<link rel="stylesheet" href="registro.css">
			</head>
			<body id="ok">
				<span>
					Se ha registrado correctemente
					</span>
			</body>
		</html>
	';
}else{
 	/*print "<br>Se ha producido un error al registrarse en la base de datos<br>";
 	 print "<br> El error es: " . mysqli_error($c) . "<br>";*/
 	 	echo '
		<html>
			<head>
				<title>Felicidades</title>
				<link rel="stylesheet" href="registro.css">
			</head>
			<body id="okno">
				<span>
					Se ha producido un error :(,intentelo de nuevo volviendo <a href="registro.html"> atrás</a>
					</span>
			</body>
		</html>
	';
}


if(mysqli_close($c)){
 print "<br>Se ha cerrado la conexión<BR>";
} 
}else{
	print "No se ha podido realizar la conexión :(";
}
?>