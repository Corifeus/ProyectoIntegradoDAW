<?php

require 'app/model/usuario.class.php';
require 'app/model/juego.class.php';
require 'app/model/genero.class.php';
require 'pageGenerator.php';

class mvc_controller {
 
	function principal(){
   		$pagina=load_template('Digital Games - Inicio');
   		var_dump($_SESSION);
		if(isset($_SESSION["nombreusuario"])&&($_SESSION["nombreusuario"])!=null){
			$sesion = load_page('app/views/default/modules/m.menuPerfil.php');
		}else{
			$sesion = load_page('app/views/default/modules/m.menuInicioSesion.php');
		}
   		$css = load_page('app/views/default/modules/m.estiloInicio.php');
   		$logo = load_page('app/views/default/modules/m.logo.php');
		$html = load_page('app/views/default/modules/m.inicio.php');
		$juego1=new Juego;
		$Array=$juego1->portada();
		//var_dump($Array);
	    if($Array!=''){//si existen registros carga el modulo en memoria y rellena con los datos 
			for($i=0;$i<3;$i++){
				$juegos = ob_get_clean();	
				$juegos = '<img class="imgJuego" src="http://cdn.akamai.steamstatic.com/steam/apps/'.$Array[$i]->Id_Juego.'/header.jpg?t='.$Array[$i]->Imagen.'" alt="Juego'.($i+1).'">
					<div class="nombrePrec"><p>'.$Array[$i]->Nombre.'</p><p>Precio de Salida: '.$Array[$i]->Precio_Original.' €</p></div></a>';
				$enlace='<a href="index.php?action=juego&id='.$Array[$i]->Id_Juego.'">';	
				$juegos = $enlace.$juegos;
				$reemplazo='/\#JUEGO'.($i+1).'\#/ms';
				$html = replace_content($reemplazo ,$juegos , $html);
			}
			for($i=3;$i<8;$i++){
				$juegos = ob_get_clean();
				$juegos = '<img class="imgJuego" src="http://cdn.akamai.steamstatic.com/steam/apps/'.$Array[$i]->Id_Juego.'/header.jpg?t='.$Array[$i]->Imagen.'" alt="Juego'.($i+1).'"></a>';
				$enlace='<a href="index.php?action=juego&id='.$Array[$i]->Id_Juego.'">';	
				$juegos = $enlace.$juegos;
				$reemplazo='/\#JUEGO'.($i+1).'\#/ms';
				$html = replace_content($reemplazo ,$juegos , $html);
			}
				
	   	}else{//si no existen datos -> muestra mensaje de error
		  	$html = $html.'<h1>No existen resultados</h1>';	
	   	}
		replace_page($css,$logo,$sesion,$html,$pagina);
	}

	function genero(){
		$pagina=load_template('Digital Games - Géneros');
   		$css = load_page('app/views/default/modules/m.estiloGenero.php');
   		$logo = load_page('app/views/default/modules/m.logo.php');
		$html = load_page('app/views/default/modules/m.genero.php');
		$genero1=new Genero;
		$lista=$genero1->listarGeneros();
		//var_dump($lista);
		$generos='';
		for($i=1;$i<=sizeof($lista);$i++){
			$nombreGenero='<div class="nombreGenero"><p>'.$lista[$i-1]->Nombre.'</p></div><div id="juegos">';
			$generos=$generos.$nombreGenero;
			$popular=$genero1->juegosGenero($i);
			//var_dump($popular);
			for ($j=0;$j<3;$j++){ 
				$juegoPopular=ob_get_clean();
				$juegoPopular='<div class="juego">
					<a href="index.php?action=juego&id='.$popular[$j]->Id_Juego.'">			
					<img class="imgJuego" src="http://cdn.akamai.steamstatic.com/steam/apps/'.$popular[$j]->Id_Juego.'/header.jpg?t='.$popular[$j]->Imagen.'" id="juego4">
					<div class="nombrePrec">
					<p>'. $popular[$j]->Nombre .'</p><p>Precio de Salida: '.$popular[$j]->Precio_Original.' €</p>
					</div></a></div>';
				$generos=$generos.$juegoPopular;
			}
			$generos=$generos."</div>";
		}
		$reemplazo='/\#GENEROS\#/ms';
		$html = replace_content($reemplazo ,$generos , $html);
		replace_page($css,$logo,$sesion,$html,$pagina);
	}

	function buscador(){
		$pagina=load_template('Digital Games - Busqueda');
   		$css = load_page('app/views/default/modules/m.estiloBusqueda.php');
   		$logo = load_page('app/views/default/modules/m.logo.php');
		$html = load_page('app/views/default/modules/m.avanzada.php');
		replace_page($css,$logo,$sesion,$html,$pagina);
	}

	function resultadoBusqueda(){
		$pagina=load_template('Digital Games - Resultado Busqueda');
   		$css = load_page('app/views/default/modules/m.estiloBusqueda.php');
   		$logo = load_page('app/views/default/modules/m.logo.php');
		$html = load_page('app/views/default/modules/m.resultadoBusqueda.php');
		$juego1=new Juego;
		$arrayJuego=$juego1->buscar();
		//$arrayJuego=$juego1->buscarAvanzado();
		$encontrados='<div class="fila">';
		$j=1;
		//var_dump($arrayJuego);
		if($arrayJuego!=''){
			$filas=sizeof($arrayJuego)/3;
			for($i=0;$i<sizeof($arrayJuego);$i++){
				$encontrados=$encontrados.'<div class="juego">
					<a href="index.php?action=juego&id='.$arrayJuego[$i]->Id_Juego.'">			
					<img class="imgJuego" src="http://cdn.akamai.steamstatic.com/steam/apps/'.$arrayJuego[$i]->Id_Juego.'/header.jpg?t='.$arrayJuego[$i]->Imagen.'">
					<div class="nombrePrec">
					<p>'. $arrayJuego[$i]->Nombre .'</p><p>Precio de Salida: '.$arrayJuego[$i]->Precio_Original.' €</p>
					</div></a></div>';
				if($j>($filas)){
					$encontrados=$encontrados.'</div><div class="fila">';
					$j=1;
				}else{
					$j++;
				}
			}
			$encontrados=$encontrados.'</div>';
			$reemplazo='/\#RESULTADOS\#/ms';
			$html = replace_content($reemplazo,$encontrados,$html);
			
		}
		replace_page($css,$logo,$sesion,$html,$pagina);
	}

	function perfil(){
		error_reporting(0);
		$pagina=load_template('Digital Games - Perfil');
		var_dump($_SESSION);
		if(isset($_SESSION["nombreusuario"])&&($_SESSION["nombreusuario"])!=null){
			$sesion = load_page('app/views/default/modules/m.menuPerfil.php');
		}else{
			$sesion = load_page('app/views/default/modules/m.menuInicioSesion.php');
		}
   		$css = load_page('app/views/default/modules/m.estiloPerfil.php');
   		$logo = load_page('app/views/default/modules/m.logoPerfil.php');
   		$usuario1=new Usuario;
		
		$tabla="favoritos";
		$usuario1->login();
		$usuario1->datosPerfil();
		//var_dump($_SESSION);
		$nombreUsuario=$_SESSION['nombreusuario'];
   		$logo = replace_content('/\#NOMBREUSUARIO\#/ms',$nombreUsuario,$logo);
   		$html = load_page('app/views/default/modules/m.perfil.php');
   		$html = replace_content('/\#NOMBREUSUARIO\#/ms',$nombreUsuario,$html);
   		//SACAR LOS FAVORITOS
		$sentencia='SELECT j.Nombre,j.Imagen,j.Id_Juego FROM favoritos f,usuario u,juego j 
			WHERE f.Id_Usuario=u.Id_Usuario 
			AND j.Id_Juego=f.Id_Juego 
			AND u.Nombre="' . $nombreUsuario. '"';
		//var_dump($sentencia);
		if($usuario1->consulta($sentencia)){
			$resultado=$usuario1->consulta($sentencia);
			//echo "gatitos";
			//var_dump($resultado);
			//var_dump($usuario1);
			while($objeto=mysqli_fetch_object($resultado)){
				$arrayFavorito[]=$objeto;
			}
		}else{
			$juegosFavoritos="No tienes juegos favoritos";
		}
		$html = replace_content('/\#FAVORITOS\#/ms',$juegosFavoritos,$html);
		//var_dump($arrayFavorito);
		//$usuario1->mostrar($arrayFavorito);
		#SACAR LA BIBLIOTECA
		$tabla="biblioteca";
		$sentencia='SELECT j.Nombre,j.Imagen,j.Id_Juego FROM biblioteca b,usuario u,juego j 
			WHERE b.Id_Usuario=u.Id_Usuario 
			AND j.Id_Juego=b.Id_Juego 
			AND u.Nombre="' . $nombreUsuario. '"';
		if($usuario1->consulta($sentencia)){
			$resultado=$usuario1->consulta($sentencia);
			while($objeto=mysqli_fetch_object($resultado)){
				$arrayBiblio[]=$objeto;
			}
		}else{
			$juegosBiblioteca="No tienes juegos en la biblioteca";
		}
		$html = replace_content('/\#BIBLIOTECA\#/ms',$juegosBiblioteca,$html);
		//$usuario1->mostrar($arrayBiblio);
		$sentencia='SELECT j.Nombre,j.Imagen,j.Id_Juego FROM videos b,usuario u,juego j 
			WHERE b.Id_Usuario=u.Id_Usuario 
			AND j.Id_Juego=b.Id_Juego 
			AND u.Nombre="' . $nombreUsuario. '"';
		if($usuario1->consulta($sentencia)){
			$resultado=$usuario1->consulta($sentencia);
			while($objeto=mysqli_fetch_object($resultado)){
				$arrayVideos[]=$objeto;
			}
		}else{
			$videos="No tienes videos";
		}
		$html = replace_content('/\#VIDEOS\#/ms',$videos,$html);

		
		replace_page($css,$logo,$sesion,$html,$pagina);
	}

	function registrarse(){
		session_unset($usuario1);
		error_reporting(0);
		$pagina=load_template('Digital Games - Perfil');
   		$css = load_page('app/views/default/modules/m.estiloPerfil.php');
   		$logo = load_page('app/views/default/modules/m.logoPerfil.php');
   		$usuario1=new Usuario;
   		$usuario1->registrar();
		#SACAR LOS FAVORITOS
		$tabla="favoritos";
		//$usuario1->datosPerfil();
		//var_dump($usuario1);
		$nombreUsuario=$_SESSION["nombreusuario"];
		$sentencia='SELECT j.Nombre,j.Imagen,j.Id_Juego FROM favoritos f,usuario u,juego j 
			WHERE f.Id_Usuario=u.Id_Usuario 
			AND j.Id_Juego=f.Id_Juego 
			AND u.Nombre="' . $nombreUsuario. '"';
		if($usuario1->consulta($sentencia)){
			$resultado=$usuario1->consulta($sentencia);
			while($objeto=mysqli_fetch_object($resultado)){
				$arrayFavorito[]=$objeto;
			}
		}
		$usuario1->mostrar($arrayFavorito);
	}

	function menuInicioSesion(){
		$pagina=load_template('Digital Games - Iniciar Sesión');
   		$css = load_page('app/views/default/modules/m.estiloConectarse.php');
   		$logo = load_page('app/views/default/modules/m.logo.php');				
		$html = load_page('app/views/default/modules/m.iniciosesion.php');
		replace_page($css,$logo,$sesion,$html,$pagina);
	}

	function paginaJuego(){
		$juego1= new Juego;
		$juego=$juego1->mostrarDatos();
		if($juego!=''){
	    	$NombreJuego = ob_get_clean();	
			$NombreJuego = $juego[0]->Nombre;
	    }
		$pagina=load_template('Digital Games - '.$NombreJuego);
   		$css = load_page('app/views/default/modules/m.estiloJuego.php');
   		$logo = load_page('app/views/default/modules/m.logoJuego.php');	
   		$imagen = '<img src="http://cdn.akamai.steamstatic.com/steam/apps/'.$juego[0]->Id_Juego.'/header.jpg?t='.$juego[0]->Imagen.'" id="caratula" alt="caratula">';
   		$precioSalida = $juego[0]->Precio_Original;
		$logo = replace_content('/\#IMAGEN\#/ms',$imagen,$logo);
		$logo = replace_content('/\#NOMBRE\#/ms',$NombreJuego,$logo);
		$logo = replace_content('/\#PRECIO\#/ms',$precioSalida,$logo);
		$html = load_page('app/views/default/modules/m.juego.php');
		//var_dump($juego[0]);
		$informacion='';
		$fecha=$juego[0]->Fecha;
		if($fecha!="1970-01-01"){
			$informacion=$informacion.'<div>Fecha de Lanzamiento: '.$fecha.'</div>';
		}
		$desarrollador=$juego[0]->Desarrollador;
		$informacion=$informacion.'<div>Desarrollador: '.$desarrollador.'</div>';
		$desc=$juego[0]->Descripcion;
		if($desc!=null){
			$informacion=$informacion.'<div>Descripción: '.$desc.'</div>';
		}
		$html = replace_content('/\#INFO\#/ms',$informacion,$html);
		$precios=$juego1->mostrarPrecios();
		if($precios!=''){
			for($j=1;$j<5;$j++){
				for($i=0;$i<sizeof($precios);$i++){
					if($precios[$i]->Id_Tienda==$j){
						if($precios[$i]->Id_Tienda==2){
							$precio='<a href=http://www.gamersgate.com/'.$precios[$i]->Url.'><div id="precio"><img id="juego1" src="app/views/default/images/tienda'.$j.'.png">
							<div class="nombrePrec">
							<p>'.$precios[$i]->Precio.' €</p></div></div></a>';
						}else{
							$precio='<a href='.$precios[$i]->Url.'><div id="precio"><img id="juego1" src="app/views/default/images/tienda'.$j.'.png">
							<div class="nombrePrec">
							<p>'.$precios[$i]->Precio.' €</p></div></div></a>';
						}	
						$reemplazo='/\#PRECIO'.$j.'\#/ms';
						$html = replace_content($reemplazo,$precio,$html);
						//break;
					}
				}
			$reemplazo='/\#PRECIO'.$j.'\#/ms';
			$html = replace_content($reemplazo,'',$html);
			}
			
		}
		replace_page($css,$logo,$sesion,$html,$pagina);
	}
		
}
?>