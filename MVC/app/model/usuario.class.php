<?php
require_once("db.class.php");
class Usuario extends Database {
	function registrar(){
		if($c=$this->conectar()){
			$tabla="usuario";
			$nombre=$_POST['nombre_usuario'];
			$contrasenya=md5($_POST['contrasenya']);
			$email=$_POST['email'];
			/*$foto=$_POST['foto'];*/
			if ($_POST["idsteam"]!='') {
				$idsteam=$_POST["idsteam"];
			}else{
				$idsteam="No";
			}
			/*$privacidad=$_POST['privacidad'];*/
			if (isset($_POST["privacidad"])) {
				$privacidad="Si";
			}else{
				$privacidad="No";
			}
			$_SESSION=$_POST;

			//echo "$nombre---------$contrasenya----------- $email--------- $idsteam------- $privacidad";
/****** Programación mediante procesos ***********/
			$sentencia="INSERT INTO $tabla (Nombre,Contrasenya,Email,Id_Steam,Privacidad,Administrador) VALUES
				('$nombre','$contrasenya','$email','$idsteam','$privacidad','No')";
			//print $sentencia;
			//var_dump($_POST);
			//var_dump($_SESSION);
			if($this->consulta($sentencia)){
				$this->login();
			}else{
 				print "<br>Se ha producido un error al registrarse en la base de datos<br>";
 	 			print "<br> El error es: " . mysqli_error($c) . "<br>";
 	 			echo 'Se ha producido un error :(,intentelo de nuevo volviendo <a href="inicio.php"> atrás</a>';
			}
			
			$this->desconectar();
		}
	}

	function login(){
		//error_reporting(0);
		if($this->conectar()){
			$tabla="usuario";
			$nombre=$_POST['nombre'];
			$contrasenya=md5($_POST['contrasenya']);
			$sentencia="SELECT * FROM $tabla WHERE Nombre='$nombre' AND Contrasenya='$contrasenya'";
			if($this->consulta($sentencia)){
				//echo "Sentencia correcta";
				$resultado=$this->consulta($sentencia);
				while($objeto=mysqli_fetch_object($resultado)){
					//var_dump($objeto);
					session_start();
					$_SESSION["nombreusuario"]=$objeto->Nombre;
					$_SESSION["contrasenya"]=md5($objeto->Contrasenya);
					$_SESSION["email"]=$objeto->Email;
					$_SESSION["idsteam"]=$objeto->Id_Steam;
					$_SESSION["foto"]=$objeto->Foto;
					$_SESSION["Privacidad"]=$objeto->Privacidad;
					$_SESSION["Administrador"]=$objeto->Administrador;
						/*
						ob_start();
						echo 'espere mientras le redireccionamos a su página de inicio...';
						header('refresh 0; url=../htmlCSS/Inicio.php');
						ob_end_flush();
						*/
					sleep(0);
   					//header ("Location: index.php?action=perfil");
					//var_dump($_SESSION);
	 		 	}
 		 	/*if ($_SESSION["Privacidad"]=='') {
								echo "El nombre de usuario o la contraseña son incorrectos";
							}
							*/
			
		$this->desconectar();
	
		}else{
 			echo "Error al conectar con la base de datos";
		}

	}
	}
	function insertarFotoPerfil(){
		$this->conectar();
		$sql="INSERT INTO usuarios VALUES ('$foto')";
		if($this->consulta($sql)){
			$this->desconectar();
			return true;
		}else{
			$this->desconectar();
			return false;
		}
	}

	function datosPerfil(){
		session_start();
		
		if($_SESSION["nombreusuario"]==false){
			sleep(0);
			//header ("Location: index.php?action=conectarse");
		}
		//echo '<div class="nick2">' . "Nombre Usuario:  " .  $_SESSION["nombreusuario"] . '</div>';
		$nombreUsuario=$_SESSION["nombre"];
		$sentencia='SELECT j.Nombre,j.Imagen,j.Id_Juego FROM favoritos f,usuario u,juego j 
			WHERE f.Id_Usuario=u.Id_Usuario 
			AND j.Id_Juego=f.Id_Juego 
			AND u.Nombre="' . $nombreUsuario. '"';
			if($this->consulta($sentencia)){
				$resultado=$this->consulta($sentencia);
				while($objeto=mysqli_fetch_object($resultado)){
					$arrayFavorito[]=$objeto;
				}
			}
		/*if ($_SESSION["Privacidad"]=="Si") {
			echo '<div class="nick2">';
			echo  "Email:  " . $_SESSION["email"];
			echo '</div>';
			echo '<div class="nick2">';
			echo "Id-Steam:  " . $_SESSION["idsteam"];
			echo '</div>';
		}*/
	}

	function mostrar($array){
		if(sizeof($array)>0){
			foreach ($array as $key => $value){
			error_reporting(0);
		
			$foto=$value->Id_Juego;
			echo '<div><img class="juego" src="http://cdn.akamai.steamstatic.com/steam/apps/'.
			$foto .'/header.jpg?t='.$foto['Imagen'].'" /></div>';
 			}
		}  
	}

	function juegosPerfil(){
		$this->conectar();
		#SACAR LOS FAVORITOS
		$tabla="favoritos";
		$nombreUsuario=$_SESSION["nombreusuario"];
		$sentencia='SELECT j.Nombre,j.Imagen,j.Id_Juego FROM favoritos f,usuario u,juego j 
			WHERE f.Id_Usuario=u.Id_Usuario 
			AND j.Id_Juego=f.Id_Juego 
			AND u.Nombre="' . $nombreUsuario. '"';
		if($this->consulta($sentencia)){
			$resultado=$this->consulta($sentencia);
			while($objeto=mysqli_fetch_object($resultado)){
				$arrayFavorito[]=$objeto;
			}
		}
		echo '<span id="mensajeSeccion"><h1>Lista de juegos favoritos de '.$nombreUsuario.'</h1></span>';
		$this->mostrar($arrayFavorito);

		#SACAR LA BIBLIOTECA
		$tabla="biblioteca";
		$nombreUsuario=$_SESSION["nombreusuario"];
		$sentencia='SELECT j.Nombre,j.Imagen,j.Id_Juego FROM biblioteca b,usuario u,juego j 
			WHERE b.Id_Usuario=u.Id_Usuario 
			AND j.Id_Juego=b.Id_Juego 
			AND u.Nombre="' . $nombreUsuario. '"';
		if($this->consulta($sentencia)){
			$resultado=$this->consulta($sentencia);
			while($objeto=mysqli_fetch_object($resultado)){
						$arrayBiblio[]=$objeto;
			}
		}
		echo '<span id="mensajeSeccion"><h1>Biblioteca de '.$nombreUsuario.'</h1></span>';
		$this->mostrar($arrayBiblio);
		echo '<span id="mensajeSeccion"><h1>Vídeos de '.$nombreUsuario.'</h1></span>';
	}
		
}

?>