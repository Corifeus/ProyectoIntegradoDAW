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
			$nombre=$_POST["nombre"];
			//var_dump($nombre);
			$sentencia='SELECT COUNT(*) as "TotalEncontrados" FROM '.$tabla.' WHERE Nombre LIKE "%' . $nombre . '%" AND Precio_Original IS NOT NULL';
			//Mostrar el total de juegos encontrados
			if($this->consulta($sentencia)){
				$resultado=$this->consulta($sentencia);
				while($objeto=mysqli_fetch_object($resultado)){
					$array[]=$objeto;
					$resultadoBusqueda=$array[0]->TotalEncontrados;
					//echo $resultadoBusqueda;
				}
				$sentencia2='SELECT Id_Juego,Nombre,Imagen,Precio_Original FROM '. $tabla .' WHERE Nombre LIKE "%' . $nombre . '%" AND Precio_Original IS NOT NULL';
				if($this->consulta($sentencia2)){
					$resultado2=$this->consulta($sentencia2);
					while($objeto2=mysqli_fetch_object($resultado2)){
						$array2[]=$objeto2;
					}
					//var_dump($array2);
				}
				/*var_dump($array);*/
				$this->desconectar();
			}else{
 				echo "No se han encontrado resultados";
			}	
		}
		return $array2;
	}
	function buscarAvanzado(){
		error_reporting(0);
		if($this->conectar()){
			$gen=$_POST["nombregenero"];
			if($gen==''){
				$sentencia='SELECT Id_Juego,Nombre,Imagen,Precio_Original FROM juego WHERE Precio_Original>0';	
			}else{
				$sentencia='SELECT Id_Juego,Nombre,Imagen,Precio_Original FROM juego j, genero_del_juego g WHERE Precio_Original>0 AND Id_Genero='. $gen;
			}
			$letra=$_POST["letras"];
			if($letra!=''){
				$sentencia=$sentencia.' AND Nombre LIKE "'. $letra .'%"';
			}
			$max=$_POST["precioMax"];
			$sentencia=$sentencia.' AND Precio_Original <='. $max ;
			$des=$_POST["desarrollador"];
			if($des!=''){
				$sentencia=$sentencia.' AND Desarrollador LIKE"'. $des.'"' ;
			}
			if($this->consulta($sentencia)){
				$resultado=$this->consulta($sentencia);
				while($objeto=mysqli_fetch_object($resultado)){
					$array[]=$objeto;
					//echo $resultadoBusqueda;
				}
			}
			return $array;
			$this->desconectar();
		}
	}	
}

?>