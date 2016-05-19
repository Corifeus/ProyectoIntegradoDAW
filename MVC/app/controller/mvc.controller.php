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
		$lista=$genero1->listarGeneros();
		//var_dump($lista);
		$generos='';
		for($i=1;$i<=sizeof($lista);$i++){
			$nombreGenero='<div class="nombreGenero"><p>'.$lista[$i-1]->Nombre.'</p></div>';
			$generos=$generos.$nombreGenero;
			$popular=$genero1->juegosGenero($i);
			//var_dump($popular);
			for ($j=0;$j<3;$j++){ 
				$juegoPopular=ob_get_clean();
				$juegoPopular='<div class="genero"><div class="generoJuego'.($j+1).'">	
					<a href="index.php?action=juego&id='.$popular[$j]->Id_Juego.'">			
					<img class="imgGenero" src="http://cdn.akamai.steamstatic.com/steam/apps/'.$popular[$j]->Id_Juego.'/header.jpg?t='.$popular[$j]->Imagen.'" id="juego4">
					</div><div class="nombreGenero">
					<p>'. $popular[$j]->Nombre .'</p><p>Precio de Salida: '.$popular[$j]->Precio_Original.' €</p>
					</div></a></div>';
				$generos=$generos.$juegoPopular;
			}
		}
		$reemplazo='/\#GENEROS\#/ms';
		$html = replace_content($reemplazo ,$generos , $html);
		replace_page($css,$logo,$sesion,$html,$pagina);
	}

	function buscador(){
		$pagina=load_template('Digital Games - Busqueda');
   		$css = load_page('app/views/default/modules/m.estiloBusqueda.php');
   		$logo = load_page('app/views/default/modules/m.logo.php');
		$html = load_page('app/views/default/modules/m.buscador.php');
		replace_page($css,$logo,$sesion,$html,$pagina);
	}

	function perfil(){
		$pagina=load_template('Digital Games - Perfil');
   		$css = load_page('app/views/default/modules/m.estiloPerfil.php');
   		$logo = load_page('app/views/default/modules/m.logoPerfil.php');
   		$usuario1=new Usuario;
   		$usuario1->juegosPerfil();
		#SACAR LOS FAVORITOS
		$tabla="favoritos";
		$nombreUsuario=$_SESSION["nombreusuario"];
		$sentencia='SELECT j.Nombre,j.Imagen,j.Id_Juego FROM favoritos f,usuario u,juego j 
			WHERE f.Id_Usuario=u.Id_Usuario 
			AND j.Id_Juego=f.Id_Juego 
			AND u.Nombre="' . $nombreUsuario. '"';
		if($this->consulta($sentencia)){
			$resultado=$this->consulta($sentencia);
			while($objeto=mysqli_fetch_object($resultado)){
				$arrayFavorito[]=$objeto;
			}
		}
		mostrar($arrayFavorito);

		#SACAR LA BIBLIOTECA
		$tabla="biblioteca";
		$nombreUsuario=$_SESSION["nombreusuario"];
		$sentencia='SELECT j.Nombre,j.Imagen,j.Id_Juego FROM biblioteca b,usuario u,juego j 
			WHERE b.Id_Usuario=u.Id_Usuario 
			AND j.Id_Juego=b.Id_Juego 
			AND u.Nombre="' . $nombreUsuario. '"';
		if($this->consulta($sentencia)){
			$resultado=$this->consulta($sentencia);
			while($objeto=mysqli_fetch_object($resultado)){
						$arrayBiblio[]=$objeto;
			}
		}
		
		mostrar($arrayBiblio);
			

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
						$precio='<a href='.$precios[$i]->Url.'><div id="precio"><img id="juego1" src="app/views/default/images/tienda'.$j.'.png">
						<div class="nombrePrec">
						<p>'.$precios[$i]->Precio.' €</p></div></div></a>';
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