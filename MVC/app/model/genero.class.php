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
		$sentencia="SELECT * FROM genero_del_juego g , juego j 
				WHERE g.Id_Juego=j.Id_Juego AND g.Id_Genero=$genero 
				AND j.Precio_Original>0 AND j.Imagen IS NOT NULL
				ORDER BY j.Numero_Propietarios DESC LIMIT 3";
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

}

?>