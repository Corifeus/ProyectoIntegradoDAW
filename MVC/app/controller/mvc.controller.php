<?php

require 'app/model/usuario.class.php';
require 'app/model/juego.class.php';
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
					<div class="nombrePrec"><p>'.$Array[$i]->Nombre.'</p><p>Precio:'.$Array[$i]->Precio_Original.'€</p></div>';
				$reemplazo='/\#JUEGO'.($i+1).'\#/ms';
				$html = replace_content($reemplazo ,$juegos , $html);
			}
			for($i=3;$i<8;$i++){
				$juegos = ob_get_clean();
				$juegos = '<img class="imgJuego" src="http://cdn.akamai.steamstatic.com/steam/apps/'.$Array[$i]->Id_Juego.'/header.jpg?t='.$Array[$i]->Imagen.'" alt="Juego'.($i+1).'">';
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
		replace_page($css,$logo,$sesion,$html,$pagina);
	}

	function buscador(){
		$pagina=load_template('Digital Games - Busqueda');
   		$css = load_page('app/views/default/modules/m.estiloBuscador.php');
   		$logo = load_page('app/views/default/modules/m.logo.php');
		$html = load_page('app/views/default/modules/m.buscador.php');
		replace_page($css,$logo,$sesion,$html,$pagina);
	}

	function perfil(){
		$pagina=load_template('Digital Games - Perfil');
   		$css = load_page('app/views/default/modules/m.estiloPerfil.php');
   		$logo = load_page('app/views/default/modules/m.logoPerfil.php');		
		$html = load_page('app/views/default/modules/m.perfil.php');
		replace_page($css,$logo,$sesion,$html,$pagina);
	}

	function conectarse(){
		$pagina=load_template('Digital Games - Iniciar Sesión');
   		$css = load_page('app/views/default/modules/m.estiloConectarse.php');
   		$logo = load_page('app/views/default/modules/m.logo.php');				
		$html = load_page('app/views/default/modules/m.iniciosesion.php');
		replace_page($css,$logo,$sesion,$html,$pagina);
	}

	function menuInicioSesion(){
		$pagina=load_template('Digital Games - Iniciar Sesión');
   		$css = load_page('app/views/default/modules/m.estiloConectarse.php');
   		$logo = load_page('app/views/default/modules/m.logo.php');				
		$html = load_page('app/views/default/modules/m.iniciosesion.php');
		replace_page($css,$logo,$sesion,$html,$pagina);
	}

	function paginaJuego(){
		$pagina=load_template('Digital Games');
   		$css = load_page('app/views/default/modules/m.estiloJuego.php');
   		$logo = load_page('app/views/default/modules/m.logoJuego.php');				
		$html = load_page('app/views/default/modules/m.juego.php');
		replace_page($css,$logo,$sesion,$html,$pagina);
	}
	

		
}
?>