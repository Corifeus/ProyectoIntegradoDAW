<?php
require_once("db.class.php");
require_once("juego.class.php");
class Administrador extends Juego{
	function actualizar(){
		$this->conectar();
		$tabla="juego";
		$api=('http://steamspy.com/api.php?request=all');
		$info=@file_get_contents($api);//Recoge las apis en la variable $info
		$k=0;//$k es un contandor de juegos
		$decodes=json_decode($info);
		for($i=10;$i<700000;$i=$i+10) {
	    	if(isset($decodes->{"$i"})){
	    		$k++;
	    		$v1=($decodes->{"$i"}->{'appid'});//Recoge el id
	    		$sent="SELECT * FROM $tabla WHERE id=$v1";
	    		$resultado = mysqli_query($objeto, $sentencia);
				if(mysqli_num_rows($resultado)==0){
		    		$v2=($decodes->{"$i"}->{'name'});//Recoge el nombre
		    		$v3=($decodes->{"$i"}->{'owners'});//Recoge el nº de porpietarios
		    		$v4=($decodes->{"$i"}->{'developer'});//Recoge el desarrollador
		    		//Con siguiente sentencia se introducen los datos en la tabla correspondiente
		    		$sentencia="INSERT INTO $tabla (Id_Juego,Nombre,Desarrollador,Numero_Propietarios) VALUES ($v1,'$v2','$v4',$v3)";
					if($objeto->query($sentencia)){
						echo "Juego $v1 insertado";	
					}else{
						echo "Error al crear juego";
					}
					$sentencia="SELECT id FROM $tabla";
					$res=mysqli_query($objeto, $sentencia);
					print "Se han obtenido $res->num_rows resultados en la consulta<br>";
					foreach($res as $i){
						$url='http://store.steampowered.com/app/'.$i['id'];
						echo $url;
						if($url!='http://store.steampowered.com/'){
							$html = @file_get_contents($url);
							$infoNombre=explode('<div class="apphub_AppName">',$html);
							$nombre=explode('</div>',$infoNombre[1]);
							$infoId=explode('appid=',$html);
							$id=explode('"',$infoId[1]);
							$infoFecha=explode('<span class="date">',$html);
							$fecha=explode('</span>',$infoFecha[1]);
							$infoPrecio=explode('<meta itemprop="price" content="',$html);
							if(sizeof($infoPrecio)==1){
								$infoPrecio=explode('price">',$html);
								if(sizeof($infoPrecio)==1){
									$precio[0]='0.00';
								}
							}else{
								$precio=explode('">',$infoPrecio[1]);
							}	
							$infoImagen=explode('header.jpg?t=',$html);
							$imagen=explode('">',$infoImagen[1]);
							$pre=str_replace(',', '.', $pre);
							$pre=str_replace('Free To Play', '0.00', $pre);
							$pre=str_replace('Free to Play', '0.00', $pre);
							$sentencia="UPDATE $tabla SET precioSalida=$pre, fechaSalida='$fec', imagen=$ima WHERE id=$ide;";
							//echo $sentencia . "<br>";
							if(mysqli_query($objeto, $sentencia)){
								print "Se ha actualizado el juego $ide: $nom<br>";
							}else{
								print "Error al actualizar el juego $ide: $nom<br>";
								print mysqli_error($objeto);
							}
							$info=explode('Género:</b>',$html);
							$lista=explode('408">',$info[1]);
							for($j=1;$j<sizeof($lista);$j++){
								$gen=explode('</a>',$lista[$j]);
								//echo $gen[0];
							}
						}
					}
				}
			}
		}	
		$this->disconnect();

	}
	function modificarOfertas($id,$precio){
		$this->conectar();
		
		$sentencia="UPDATE";

		if(mysqli_query($c,$sentencia)){
			
 		}else{

 		}
 		 	
		$this->disconnect();
		
	}

}

?>