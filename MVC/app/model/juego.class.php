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

	function mostrarDatos(){
		$this->conectar();
		$idJuego=$_GET['id'];
		//var_dump($idJuego);
		$sentencia='SELECT * FROM juego WHERE Id_Juego='.$_GET['id']; 
		if($this->consulta($sentencia)){
			$resultado=$this->consulta($sentencia);
			while($objeto=mysqli_fetch_object($resultado)){
				$juego[]=$objeto;
			}
		}else{
			$juego="";
		}
		//var_dump($juego);
		$this->desconectar();
		return $juego;

	}
	function mostrarPrecios(){
		$this->conectar();
		$idJuego=$_GET['id'];
		//var_dump($idJuego);
		$sentencia='SELECT * FROM producto WHERE Id_Juego='.$_GET['id']; 
		if($this->consulta($sentencia)){
			$resultado=$this->consulta($sentencia);
			while($objeto=mysqli_fetch_object($resultado)){
				$precios[]=$objeto;
			}
		}else{
			$precios="";
		}
		//var_dump($precios);
		$this->desconectar();
		return $precios;
		
	}
	function buscar(){
		//error_reporting(0);
		if($this->conectar()){
			$tabla="juego";
			$nombre=$_POST["nombrejuego"];
			$sentencia='SELECT COUNT(*) as "TotalEncontrados" FROM '.$tabla.' WHERE Nombre LIKE "%' . $nombre . '%" AND Precio_Original IS NOT NULL';
			//Mostrar el total de juegos encontrados
			if($this->consulta($sentencia)){
				$resultado=$this->consulta($sentencia);
				while($objeto=mysqli_fetch_object($resultado)){
					$array[]=$objeto;
					$resultadoBusqueda=$array[0]->TotalEncontrados;
					echo $resultadoBusqueda;
				}
				$sentencia2='SELECT Nombre,Precio_Original FROM ' . $tabla . ' WHERE Nombre LIKE "%' . $nombre . '%" AND Precio_Original IS NOT NULL';
				if($this->consulta($sentencia2)){
					$resultado2=$this->consulta($sentencia2);
					while($objeto2=mysqli_fetch_object($resultado2)){
						$array2[]=$objeto2;
					}
					foreach ($array2 as $key => $value) {
						foreach ($value as $key2 => $value2) {
							/*echo "<br>$key2--->$value2";*/
						}
						/*echo "<br>";*/
					}
					/*var_dump($array2);
					echo "<br><br><br>";
					echo $array2[0]->Nombre;
					echo $array2[0]->Precio_Original;*/
				}

				/*var_dump($array);*/
				$this->desconectar();
			}else{
 				echo "No se han encontrado resultados";
			}	
		}
	}
}

?>