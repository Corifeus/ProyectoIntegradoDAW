<?php
require_once("db.class.php");
class Juego extends Database{
	function portada(){
		if($c=$this->conectar()){
			//var_dump($c);
			$sentencia="SELECT * FROM `juego` WHERE `Fecha` IS NOT NULL AND `Fecha`<CURDATE() AND `Precio_Original`>0 ORDER BY `Fecha` DESC LIMIT 8";
			if($this->consulta($sentencia)){
				$resultado=$this->consulta($sentencia);
				//var_dump($resultado);
				while($objeto=mysqli_fetch_object($resultado)){
					//var_dump($objeto);
					//echo "Gatitos";
					$array[]=$objeto;
				}
				//var_dump($array);
				$this->desconectar();
				return $array;
			}else{
 				echo "Error con la sentencia";
			}
		}else{
			echo "Error al conectar con la base de datos";
		}
	}

	function mostrarDatos($id){
		$this->conectar();
		$sentencia="";

		if(mysqli_query($c,$sentencia)){
			
		}else{
		 	
		}
		$this->disconnect();

	}
	function mostrarPrecios($id){
		$this->conectar();
		
		$sentencia="";

		if(mysqli_query($c,$sentencia)){
			
 		}else{

 		}
 		 	
		$this->disconnect();
		
	}
	function insertarFotoPerfil(){
		$this->conectar();
		$sql="INSERT INTO usuarios VALUES ('$foto')";
		if($this->consulta($sql)){
			$this->disconnet();
			return true;
		}else{
			$this->disconnet();
			return false;
		}
	}
}

?>