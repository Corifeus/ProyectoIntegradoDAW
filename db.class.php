<?php
class Database {
	private $conexion;
	public function conectar(){
		$objeto=new mysqli("localhost","root","","digitalgames");
		return $objeto;
	}
	public function consulta($sentecia){
		$resultado=new mysqli_query("localhost","root","","digitalgames");
		return $resultado;
	}
	function numero_filas($resultado){
		mysqli_num_rows($resultado);
	}
	public function fetch_assoc($resultado){
		mysqli_fetch_assoc($resultado);
	}
	public function desconectar(){
		mysqli_close();
	}
}
?>