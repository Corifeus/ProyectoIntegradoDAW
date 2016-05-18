<?php
require_once("db.class.php");
class Video extends Database{
	function mostrarVideo($id){
		$this->conectar();
		$sentencia="";

		if(mysqli_query($c,$sentencia)){
			
		}else{
		 	
}		}
		$this->disconnect();

	}
	function insertarVideo($enlace){
		$this->conectar();
		
		$sentencia="";

		if(mysqli_query($c,$sentencia)){
			
 		}else{

 		}
 		 	
		$this->disconnect();
		
	}
	function borrarVideo($id){
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