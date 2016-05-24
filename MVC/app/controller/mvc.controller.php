<?php

require 'app/model/usuario.class.php';
require 'app/model/juego.class.php';
require 'app/model/genero.class.php';
require 'pageGenerator.php';

class mvc_controller {
 
	function principal(){
   		$pagina=load_template('Digital Games - Inicio');

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
		if(isset($_GET['id'])){
			switch ($_GET['id']) {
				case 1:
					$css = load_page('app/views/default/modules/m.estiloAccion.php');
					break;
				case 2:
					$css = load_page('app/views/default/modules/m.estiloAventura.php');
					break;
				case 3:
					$css = load_page('app/views/default/modules/m.estiloCasual.php');
					break;
				case 4:
					$css = load_page('app/views/default/modules/m.estiloMultijugador.php');
					break;
				case 5:
					$css = load_page('app/views/default/modules/m.estiloGratuito.php');
					break;
				case 6:
					$css = load_page('app/views/default/modules/m.estiloIndie.php');
					break;
				case 7:
					$css = load_page('app/views/default/modules/m.estiloMultijugador.php');
					break;
				case 8:
					$css = load_page('app/views/default/modules/m.estiloCarreras.php');
					break;
				case 9:
					$css = load_page('app/views/default/modules/m.estiloSimulacion.php');
					break;
				case 10:
					$css = load_page('app/views/default/modules/m.estiloRol.php');
					break;
				case 11:
					$css = load_page('app/views/default/modules/m.estiloSimulacion.php');
					break;
				case 12:
					$css = load_page('app/views/default/modules/m.estiloSimulacion.php');
					break;
				case 13:
					$css = load_page('app/views/default/modules/m.estiloDeportes.php');
					break;
				default:
					
					break;
			}
			$arrayJuego=$genero1->buscarGenero();
			$generos='<div><a href="index.php?action=genero&id='.$lista[$i-1]->Id_Genero.'"><p>'.$lista[$i-1]->Nombre.'</p></a></div><div id="juegos"><div class="fila">';
			$j=1;
			//var_dump($arrayJuego);
			if($arrayJuego!=''){
				$filas=sizeof($arrayJuego)/3;
				for($i=0;$i<sizeof($arrayJuego);$i++){
					$generos=$generos.'<div class="juego">
						<a href="index.php?action=juego&id='.$arrayJuego[$i]->Id_Juego.'">			
						<img class="imgJuego" src="http://cdn.akamai.steamstatic.com/steam/apps/'.$arrayJuego[$i]->Id_Juego.'/header.jpg?t='.$arrayJuego[$i]->Imagen.'">
						<div class="nombrePrec">
						<p>'. $arrayJuego[$i]->Nombre .'</p><p>Precio de Salida: '.$arrayJuego[$i]->Precio_Original.' €</p>
						</div></a></div>';
					if($j>($filas)){
						$generos=$generos.'</div><div class="fila">';
						$j=1;
					}else{
						$j++;
					}
				}
				$generos=$generos.'</div>';
			}else{
				$generos='<div class="juego"><p>No se han encontrado juegos</p><p></div>';
			}
		}else{

			$lista=$genero1->listarGeneros();
			//var_dump($lista);
			$generos='';
			for($i=1;$i<=sizeof($lista);$i++){
				$nombreGenero='<div class="nombreGenero"><a href="index.php?action=genero&id='.$lista[$i-1]->Id_Genero.'"><p>'.$lista[$i-1]->Nombre.'</p></a></div><div id="juegos">';
				$generos=$generos.$nombreGenero;
				$juego=$genero1->juegosGenero($i);
				//var_dump($popular);
				for ($j=0;$j<3;$j++){ 
					$juegos=ob_get_clean();
					$juegos='<div class="juego">
						<a href="index.php?action=juego&id='.$juego[$j]->Id_Juego.'">			
						<img class="imgJuego" src="http://cdn.akamai.steamstatic.com/steam/apps/'.$juego[$j]->Id_Juego.'/header.jpg?t='.$juego[$j]->Imagen.'" id="juego4">
						<div class="nombrePrec">
						<p>'. $juego[$j]->Nombre .'</p><p>Precio de Salida: '.$juego[$j]->Precio_Original.' €</p>
						</div></a></div>';
					$generos=$generos.$juegos;
				}
				$generos=$generos."</div>";
			}
			
		}
		$reemplazo='/\#GENEROS\#/ms';
		$html = replace_content($reemplazo,$generos,$html);
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
	    $sesion = load_page('app/views/default/modules/m.menuInicioSesion.php');
   		$css = load_page('app/views/default/modules/m.estiloBusqueda.php');
   		$logo = load_page('app/views/default/modules/m.logo.php');
		$html = load_page('app/views/default/modules/m.resultadoBusqueda.php');
		$juego1=new Juego;
		//var_dump($_POST);
		if(isset($_POST['precioMax'])){
			//echo "Busqueda Avanzada";
			$arrayJuego=$juego1->buscarAvanzado();
		}else{
			$arrayJuego=$juego1->buscar();
			//echo "Busqueda por nombre";
		}
		//
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
			
		}else{
			$encontrados='<div class="juego"><p>No se han encontrado juegos</p><p></div>';
		}
		$reemplazo='/\#RESULTADOS\#/ms';
		$html = replace_content($reemplazo,$encontrados,$html);	
		replace_page($css,$logo,$sesion,$html,$pagina);
	}

	function perfil(){
		error_reporting(0);
		$pagina=load_template('Digital Games - Perfil');
		
   		$css = load_page('app/views/default/modules/m.estiloPerfil.php');
   		$logo = load_page('app/views/default/modules/m.logoPerfil.php');
   		$usuario1=new Usuario;
		$usuario1->login();
		$usuario1->datosPerfil();
		session_start();
		$nombreUsuario=$_SESSION['nombreusuario'];
   		$html = load_page('app/views/default/modules/m.perfil.php');
   		//SACAR LOS FAVORITOS
   		$array=$usuario1->favoritosPerfil();
   		$juegosFavoritos='<span id="mensajeSeccion"><h1>Lista de juegos favoritos de '.$nombreUsuario.'</h1></span>';
		if(sizeof($array)>0){
			foreach ($array as $key => $value){

				$foto=$value->Id_Juego;
				$juegosFavoritos=$juegosFavoritos.'<div id="juego"><img class="juego" src="http://cdn.akamai.steamstatic.com/steam/apps/'.
				$foto .'/header.jpg?t='.$value->Imagen.'" /></div>';
 			}
		}else{
			$juegosFavoritos=$juegosFavoritos."No tienes juegos favoritos";
		}
		$html = replace_content('/\#FAVORITOS\#/ms',$juegosFavoritos,$html);
		//var_dump($arrayFavorito);
		#SACAR LA BIBLIOTECA
		$array=$usuario1->bibliotecaPerfil();
		$juegosBiblioteca='<span id="mensajeSeccion"><h1>Biblioteca de '.$nombreUsuario.'</h1></span>';
		if(sizeof($array)>0){
			foreach ($array as $key => $value){

				$foto=$value->Id_Juego;
				$juegosBiblioteca=$juegosBiblioteca.'<div id="juego"><img class="juego" src="http://cdn.akamai.steamstatic.com/steam/apps/'.
				$foto .'/header.jpg?t='.$value->Imagen.'" /></div>';
 			}
		}else{
			$juegosBiblioteca=$juegosBiblioteca."No tienes juegos en la biblioteca";
		}
		//var_dump($juegosBiblioteca);
		$html = replace_content('/\#BIBLIOTECA\#/ms',$juegosBiblioteca,$html);
		//$usuario1->mostrar($arrayBiblio);
		$array=$usuario1->videosPerfil();
		$videos='<span id="mensajeSeccion"><h1>Videos de '.$nombreUsuario.'</h1></span>';
		if(sizeof($array)>0){
			foreach ($array as $key => $value){
				$foto=$value->Id_Juego;
				$videos=$videosa.'<div id="juego"><img class="juego" src="http://cdn.akamai.steamstatic.com/steam/apps/'.
				$foto .'/header.jpg?t='.$value->Imagen.'" /></div>';
 			}
		}else{
			$videos=$videos."No tienes videos";
		}
		//$array=$usuario1->actualizar();
		$html = replace_content('/\#VIDEOS\#/ms',$videos,$html);
		replace_page($css,$logo,$sesion,$html,$pagina);
	}

	function registrarse(){
		session_start();
		session_destroy();
		error_reporting(0);

		$pagina=load_template('Digital Games - Inicio Sesión');
		
		$css = load_page('app/views/default/modules/m.estiloConectarse.php');
   		$logo = load_page('app/views/default/modules/m.logo.php');
   		$usuario1=new Usuario;
   		#SACAR LOS FAVORITOS
		$usuario1->datosPerfil();
		//var_dump($usuario1);
		$nombreUsuario=$_SESSION["nombreusuario"];
		$html = load_page('app/views/default/modules/m.inicioSesion.php');
		replace_page($css,$logo,$sesion,$html,$pagina);
		return $_SESSION;
	}

	function paginaJuego(){
		session_start();
		$juego1= new Juego;
		$user1= new Usuario;
		$juego=$juego1->mostrarDatos();
		if($juego!=''){
	    	$NombreJuego = ob_get_clean();	
			$NombreJuego = $juego[0]->Nombre;
	    }
		$pagina=load_template('Digital Games - '.$NombreJuego);
   		$css = load_page('app/views/default/modules/m.estiloJuego.php');
   		if(isset($_SESSION['nombreusuario']) and $_SESSION['estado'] == 'Logueado') { 
		      $logo = load_page('app/views/default/modules/m.logoJuegoSesion.php');	
		      //echo "Con sesión";
		}else{   
		      $logo = load_page('app/views/default/modules/m.logoJuego.php');
		      //echo "Sin sesión";
		}
   		$imagen = '<img src="http://cdn.akamai.steamstatic.com/steam/apps/'.$juego[0]->Id_Juego.'/header.jpg?t='.$juego[0]->Imagen.'" id="caratula" alt="caratula">';
   		$precioSalida = $juego[0]->Precio_Original;
   		$usuario=$user1->identificar();
   		$botones='<form action="index.php?action=juego&id='.$_GET["id"].'&add=biblioteca" method="post" id="biblioteca">
               <button type="submit" name"sesion" value="biblioteca"> AÑADIR A BIBLIOTECA </button>
		      </form>
		      <form action="index.php?action=juego&id='.$_GET["id"].'&add=favoritos" method="post" id="favoritos">
        	  <button type="submit" name"sesion" value="favoritos"> AÑADIR A FAVORITOS </button>
		      </form>';
		//var_dump($_POST);  
		//var_dump($_GET);   
		//var_dump($usuario);
		if($_GET['add']!=null){
			//echo "añadiendo juego";
			if($_GET['add']=="biblioteca"){
				$juego1->biblioteca($_GET["id"],$usuario);
			}elseif($_GET['add']=="favoritos"){
				$juego1->favoritos($_GET["id"],$usuario);
			}
		}
		$logo = replace_content('/\#IMAGEN\#/ms',$imagen,$logo);
		$logo = replace_content('/\#NOMBRE\#/ms',$NombreJuego,$logo);
		$logo = replace_content('/\#PRECIO\#/ms',$precioSalida,$logo);
		$logo = replace_content('/\#BOTONES\#/ms',$botones,$logo);
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