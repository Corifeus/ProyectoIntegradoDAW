<?php
class Database {
	private $conexion;
	public function conectar(){
		$this->conexion=mysqli_connect("localhost","root","","digitalgamesBD");
		return $this->conexion;
	}
	public function consulta($sentencia){
		$resultado=mysqli_query($this->conexion,$sentencia);
		return $resultado;
	}
	public function numero_filas($resultado){
		mysqli_num_rows($resultado);
	}
	public function fetch_assoc($resultado){
		mysqli_fetch_assoc($resultado);
	}
	public function desconectar(){
		mysqli_close($this->conexion);
	}
}
?>