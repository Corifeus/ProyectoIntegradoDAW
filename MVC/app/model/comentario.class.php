<?php
require_once("db.class.php");
class Comentario extends Database{
	function mostrarComentario($id){
		$this->conectar();
		$sentencia="";

		if(mysqli_query($c,$sentencia)){
			
		}else{
		 	
}		}
		$this->disconnect();

	}
	function insertarComentario($texto){
		$this->conectar();
		
		$sentencia="";

		if(mysqli_query($c,$sentencia)){
			
 		}else{

 		}
 		 	
		$this->disconnect();
		
	}
	function borrarComentario($id){
		$this->conectar();
		$sql="";
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