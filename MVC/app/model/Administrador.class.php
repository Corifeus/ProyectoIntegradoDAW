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
	    		$sent="SELECT * FROM juego WHERE Id_Juego=$v1";
	    		$resultado = $this->consulta($sentencia));
				if(mysqli_num_rows($resultado)==0){
		    		$v2=($decodes->{"$i"}->{'name'});//Recoge el nombre
		    		$v3=($decodes->{"$i"}->{'owners'});//Recoge el nº de porpietarios
		    		$v4=($decodes->{"$i"}->{'developer'});//Recoge el desarrollador
		    		//Con siguiente sentencia se introducen los datos en la tabla correspondiente
		     		$sentencia2="INSERT INTO juego (Id_Juego,Nombre,Desarrollador,Numero_Propietarios) VALUES ($v1,'$v2','$v4',$v3)";
					if($this->consulta($sentencia2)){
						echo "Juego $v1 insertado";	
					}else{
						echo "Error al crear juego";
					}
				}
				//Insertar el trigger
				$trigger='DELIMITER$$
						CREATE TRIGGER historico
						AFTER UPDATE ON producto
						FOR EACH ROW
						BEGIN 
							DECLARE precio_historico FLOAT;
							DECLARE fecha_historico DATE;
							DECLARE id_historico INT;
							SELECT Precio INTO precio_historico FROM historico_precios;
							SELECT Fecha INTO fecha_historico FROM historico_precios;
							SELECT Id_Juego INTO id_historico FROM historico_precios;
							IF old.Id_Juego = id_historico AND CURTIME() = fecha_historico THEN
								IF old.Precio < precios_historico THEN
									UPDATE historico_precios SET Id_Juego = old.Id_Juego,
																Fecha = CURTIME(),
																Precio = old.Precio;
								END IF
							ELSE 
								INSERT INTO historico_precios VALUES (old.Id_Juego, CURTIME(),old.Precio);
							END IF
							END;$$';
				$this->consulta($trigger);		
				//Actualizar juegos
				$sentencia3="SELECT Id_Juego FROM juego";
				$res=$this->consulta($sentencia3);
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
						$fechas=str_replace(',', '', $fecha[0]);
						$time = strtotime($fechas);
						$fec = date('Y-m-d',$time);
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
						$sentencia4="UPDATE juego SET Precio_Original=$pre, Fecha='$fec', Imagen=$ima WHERE Id_Juego=$ide;";
						//echo $sentencia . "<br>";
						if($this->consulta($sentencia4)){
							print "Se ha actualizado el juego $ide: $nom<br>";
						}else{
							print "Error al actualizar el juego $ide: $nom<br>";
							print mysqli_error($objeto);
						}
						$info=explode('Genre:</b>',$html)
						$lista=explode('408">',$info[1]);
						for($j=1;$j<(sizeof($lista)-1);$j++){
							$gen=explode('</a>',$lista[$j]);
							//echo $gen[0];
							switch ($gen[0]) {
								case 'Action':
									$genero=1;
									break;
								case 'Adventure':
									$genero=2;
									break;
								case 'Casual':
									$genero=3;
									break;
								case 'Early Access':
									$genero=4;
									break;
								case 'Free To Play'|'Free to Play':
									$genero=5;
									break;
								case 'Indie':
									$genero=6;
									break;
								case 'Massively Multiplayer':
									$genero=7;
									break;
								case 'Racing':
									$genero=8;
									break;
								case 'Simulation':
									$genero=9;
									break;
								case 'Sports':
									$genero=13;
									break;
								case 'Strategy':
									$genero=12;
									break;
								case 'RPG':
									$genero=10;
									break;
								default:
									$genero=11;
									break;
							}
							echo $gen[0]."-".$genero."<br>";
							$sentencia5="INSERT INTO genero_del_juego(Id_Juego,Id_Genero) VALUES (".$i['Id_Juego'].",$genero)";
							$res=$this->consulta($sentencia5);
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