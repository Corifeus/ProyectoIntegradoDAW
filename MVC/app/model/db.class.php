<?php
/**
*Clase que interactua con la base de datos
*@author Digital Games
*@version 1.0
*/

class Database {
	/**
	*@var array $conexion guarda la información de la conexión
	*/
	private $conexion;
	/**
	*Realiza la conexion con la base de datos
	*@return array $this->conexion datos de conexion
	*/
	public function conectar(){
		$this->conexion=mysqli_connect("localhost","root","","digitalgamesBD");
		//$this->conexion=mysqli_connect("52.40.90.253:3306","usuario","dg5","digitalgamesbd");
		return $this->conexion;
	}
	/**
	*Realiza una consulta en la base de datos la base de datos
	*@param string $sentencia sentencia en formato sql
	*@return array $resultado devuelve el valor de la consulta
	*/
	public function consulta($sentencia){
		$resultado=mysqli_query($this->conexion,$sentencia);
		return $resultado;
	}
	/**
	*Pide el numero filas obtenido tras una consulta
	*@param array $resultado valor de una consulta
	*/
	public function numero_filas($resultado){
		mysqli_num_rows($resultado);
	}
	/**
	*Devuelve los valores de la consulta
	*/
	public function fetch_assoc($resultado){

		mysqli_fetch_assoc($resultado);
	}
	/**
	*Cierra la conexion con la base de datos
	*/
	public function desconectar(){
		mysqli_close($this->conexion);
	}
}
?>