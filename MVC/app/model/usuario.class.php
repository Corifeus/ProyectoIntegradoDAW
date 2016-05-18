<?php
require_once("db.class.php");
class Usuario extends Database {
	function registrar($nombre,$contrasenya,$email,$idsteam,$foto,$privacidad){
		$this->conectar();
		/*$nombre=$_POST['nombre_usuario'];
		$contrasenya=$_POST['contrasenya'];
		$email=$_POST['email'];
		$idsteam=$_POST['idsteam'];
		$foto=$_POST['foto'];
		$privacidad=$_POST['privacidad'];*/
		//$sentencia="INSERT INTO $tabla (Nombre_usuario,Contrasenya,Email,Id_Steam,Foto,Privacidad) VALUES ('$nombre','$contrasenya','$email','$idsteam','$foto','$privacidad')";
		$sentencia="INSERT INTO $tabla (Nombre_usuario,Contrasenya,Email,Id_Steam,Foto,Privacidad) VALUES (?,?,?,?,?,?)";
		$sentencia->bind_param("ssssss",$nombre,$contrasenya,$email,$idsteam,$foto,$privacidad);

		if(mysqli_query($c,$sentencia)){
			/*print "<br>Se ha registrado correctamente :D<br>";*/
			echo 'Se ha registrado correctemente';
		}else{
		 	/*print "<br>Se ha producido un error al registrarse en la base de datos<br>";
		 	 print "<br> El error es: " . mysqli_error($c) . "<br>";*/
		 	 	echo 'Se ha producido un error';
		}
		$this->desconectar();
	}
	function login(){
		$this->conectar();
		$tabla="usuarios";
		$nombre=$_POST['nombre'];
		$contrasenya=$_POST['contrasenya'];
		$sentencia="select * from $tabla where Nombre_Usuario='$nombre' and Contrasenya='$contrasenya'";

		if(mysqli_query($c,$sentencia)){
			$resultado=mysqli_query($c,$sentencia);
			while($objeto=mysqli_fetch_object($resultado)){
				session_start();
				$_SESSION["nombreusuario"]=$objeto->Nombre_Usuario;
				$_SESSION["contrasenya"]=md5($objeto->Contrasenya);
				$_SESSION["email"]=$objeto->Email;
				$_SESSION["idsteam"]=$objeto->Id_Steam;
				$_SESSION["foto"]=$objeto->Foto;
				$_SESSION["Privacidad"]=$objeto->Privacidad;
				echo 'Bienvenido ' . $_SESSION["nombreusuario"];
				/*var_dump($_SESSION);*/
 		 	}
 		 	if ($_SESSION["Privacidad"]=='') {
				echo "El nombre de usuario o la contraseña son incorrectos";
			}
			$this->desconectar();
			if($this->numero_de_filas($resultado) > 0){
				while($fila=$this->fetch_assoc($resultado)){
					$data[]=$fila;
				}
				return $data;
			}else{
				return '';
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
}

?>