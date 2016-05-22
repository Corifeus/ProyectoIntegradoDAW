<?php
require_once("db.class.php");
class Genero extends Database{
	function listarGeneros(){
		if($this->conectar()){
			//var_dump($c);
			$sentencia="SELECT * FROM genero";
			if($this->consulta($sentencia)){
				$resultado=$this->consulta($sentencia);
				//var_dump($resultado);
				while($objeto=mysqli_fetch_object($resultado)){
					//var_dump($objeto);
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

	function juegosGenero($genero){
		$this->conectar();
		if($genero==5){
			$sentencia="SELECT * FROM genero_del_juego g , juego j 
				WHERE g.Id_Juego=j.Id_Juego AND g.Id_Genero=$genero 
				AND j.Precio_Original IS NOT NULL AND j.Imagen IS NOT NULL
				ORDER BY j.Numero_Propietarios DESC LIMIT 3";
		}else{
			$sentencia="SELECT * FROM genero_del_juego g , juego j 
				WHERE g.Id_Juego=j.Id_Juego AND g.Id_Genero=$genero 
				AND j.Precio_Original >0 AND j.Imagen IS NOT NULL
				ORDER BY j.Numero_Propietarios DESC LIMIT 3";
		}
		
		if($this->consulta($sentencia)){
			$resultado=$this->consulta($sentencia);
			//var_dump($resultado);
			if (mysqli_num_rows($resultado)>0){
				while($objeto=mysqli_fetch_object($resultado)){
				//var_dump($objeto);
					$array[]=$objeto;
				}
			}
		}
		$this->desconectar();
		return $array;
	}
	function buscarGenero(){
		error_reporting(0);
		if($this->conectar()){
			$gen=$_GET['id'];
			//var_dump($_GET);
			if($gen==''){
				echo "Error";
			}else{
				$sentencia='SELECT j.Id_Juego,j.Nombre,j.Imagen,j.Precio_Original FROM juego j, genero_del_juego g WHERE Precio_Original IS NOT NULL AND j.Id_Juego=g.Id_Juego AND  Id_Genero='. $gen;
			}
			//var_dump($sentencia);
			if($this->consulta($sentencia)){
				$resultado=$this->consulta($sentencia);
				while($objeto=mysqli_fetch_object($resultado)){
					$array[]=$objeto;
					//echo $resultadoBusqueda;
				}
			}
			//var_dump($array);
			return $array;
			$this->desconectar();
		}
	}

}

?>