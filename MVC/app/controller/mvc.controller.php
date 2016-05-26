<?php

require 'app/model/usuario.class.php';
require 'app/model/juego.class.php';
require 'app/model/genero.class.php';
require 'pageGenerator.php';

/**
*Clase controlador
*Relaciona el modelo con las vistas
*Es el nucleo de la carga de cada una de las paginas
*@author Digital Games
*@version 1.0
*/

class mvc_controller {
	/**
	*Carga los componentes de la pagina de inicio
	*/
 	
	function principal(){
		
   		$pagina=load_template('Digital Games - Inicio');
   		$css = load_page('app/views/default/modules/m.estiloInicio.php');
   		$logo = load_page('app/views/default/modules/m.logo.php');
		$html = load_page('app/views/default/modules/m.inicio.php');
		//Se crea un objeto de la clase Juego de la que se obtendrán los juegos de la portada con la funcíón portada()
		$juego1=new Juego;
		$Array=$juego1->portada();
		//var_dump($Array);
	    if($Array!=''){//si existen registros carga el modulo en memoria y rellena con los datos 
			for($i=0;$i<3;$i++){//Aquí se cargan los juegos que aparecen en la parte inferior de la pantalla
				$juegos = ob_get_clean();	
				$juegos = '<img class="imgJuego" src="http://cdn.akamai.steamstatic.com/steam/apps/'.$Array[$i]->Id_Juego.'/header.jpg?t='.$Array[$i]->Imagen.'" alt="Juego'.($i+1).'">
					<div class="nombrePrec"><p>'.$Array[$i]->Nombre.'</p><p>Precio de Salida: '.$Array[$i]->Precio_Original.' €</p></div></a>';
				$enlace='<a href="index.php?action=juego&id='.$Array[$i]->Id_Juego.'">';	
				$juegos = $enlace.$juegos;
				$reemplazo='/\#JUEGO'.($i+1).'\#/ms';
				$html = replace_content($reemplazo ,$juegos , $html);
			}
			for($i=3;$i<8;$i++){//Aquí se cargan los juegos que aparecen en el slider
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
	   	//Finalmente se cargan todos los componentes de la página usando una función de pageGenerator.php
		replace_page($css,$logo,$sesion,$html,$pagina);
	}
	/**
	*Carga los componentes de genero
	*/

	function genero(){
		
		$pagina=load_template('Digital Games - Géneros');
	   	$css = load_page('app/views/default/modules/m.estiloGenero.php');
	   	$logo = load_page('app/views/default/modules/m.logo.php');
	   	$html = load_page('app/views/default/modules/m.genero.php');
	   	//Se crea un objeto de clase Genero
	   	$genero1=new Genero;
	   	if(isset($_GET['id'])){//Se cargará la página de un genero en concreto
			switch ($_GET['id']) {//Dependiendo del tipo de genero se carga un fondo de pantalla diferente
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
			$arrayJuego=$genero1->buscarGenero();//Esta función buscará todos los juegos del genero seleccionado
			$generos='<div><a href="index.php?action=genero&id='.$lista[$i-1]->Id_Genero.'"><p>'.$lista[$i-1]->Nombre.'</p></a></div><div class="juegos"><div class="fila">';
			$j=1;
			//var_dump($arrayJuego);
			if($arrayJuego!=''){
				$filas=sizeof($arrayJuego)/3;
				for($i=0;$i<sizeof($arrayJuego);$i++){
					$generos=$generos.'<div class="juego">
						<a href="index.php?action=juego&id='.$arrayJuego[$i]->Id_Juego.'">			
						<img class="imgJuego" src="http://cdn.akamai.steamstatic.com/steam/apps/'.$arrayJuego[$i]->Id_Juego.'/header.jpg?t='.$arrayJuego[$i]->Imagen.'">
						<div>
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
		}else{//Se cargará la página general de generos, desde dónde se puede acceder a cada uno de los generos.
			$lista=$genero1->listarGeneros();//Esta función permite obtener cada tipo de genero existente
			//var_dump($lista);
			$generos='';//Esta variable contendrá todo el contenido a reemplazar en el contenido de la página
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
						<div>
						<p>'. $juego[$j]->Nombre .'</p><p>Precio de Salida: '.$juego[$j]->Precio_Original.' €</p>
						</div></a></div>';
					$generos=$generos.$juegos;
				}
				$generos=$generos."</div>";
			}
		}
		$reemplazo='/\#GENEROS\#/ms';
		$html = replace_content($reemplazo,$generos,$html);
		//Finalmente se cargan todos los componentes de la página usando una función de pageGenerator.php
		replace_page($css,$logo,$sesion,$html,$pagina);
	}

	/**
	*Carga el buscador avanzado
	*/
	function buscador(){
		$pagina=load_template('Digital Games - Busqueda');
		$css = load_page('app/views/default/modules/m.estiloBusqueda.php');
   		$logo = load_page('app/views/default/modules/m.logo.php');
		$html = load_page('app/views/default/modules/m.avanzada.php');
		//Se cargan todos los componentes de la página usando una función de pageGenerator.php
		replace_page($css,$logo,$sesion,$html,$pagina);
	}

	/**
	*Carga el resultado de una busqueda (por nombre o avanzada)
	*/

	function resultadoBusqueda(){
		$pagina=load_template('Digital Games - Resultado Busqueda');
	    $sesion = load_page('app/views/default/modules/m.menuInicioSesion.php');
   		$css = load_page('app/views/default/modules/m.estiloBusqueda.php');
   		$logo = load_page('app/views/default/modules/m.logo.php');
		$html = load_page('app/views/default/modules/m.resultadoBusqueda.php');
		$juego1=new Juego;//Se crea un objeto de clase Juego
		//var_dump($_POST);
		if(isset($_POST['precioMax'])){//Se comprueba si se ha definido el precio máximo para averiguar de que tipo de busqueda se trata
			//echo "Busqueda Avanzada";
			$arrayJuego=$juego1->buscarAvanzado();//Se llama a una función que busca juegos por varias características
		}else{
			$arrayJuego=$juego1->buscar();//Llama a una función que realiza una búsqueda por nombre
			//echo "Busqueda por nombre";
		}
		//Aquí se cargará el contenido de la busqueda realizada
		$encontrados='<div class="fila">';
		$j=1;
		if($arrayJuego!=''){
			$filas=(sizeof($arrayJuego)/3)+1;
			//echo $filas;
			//var_dump(sizeof($arrayJuego));
			for($i=0;$i<sizeof($arrayJuego);$i++){
				$encontrados=$encontrados.'<div class="juego">
						<a href="index.php?action=juego&id='.$arrayJuego[$i]->Id_Juego.'">			
						<img class="imgJuego" src="http://cdn.akamai.steamstatic.com/steam/apps/'.$arrayJuego[$i]->Id_Juego.'/header.jpg?t='.$arrayJuego[$i]->Imagen.'">
						<div>
						<p>'. $arrayJuego[$i]->Nombre .'</p><p>Precio de Salida: '.$arrayJuego[$i]->Precio_Original.' €</p>
						</div></a></div>';
					if($j>($filas-1)){
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
		//Finalmente se cargan todos los componentes de la página usando una función de pageGenerator.php
		replace_page($css,$logo,$sesion,$html,$pagina);
	}

	/**
	*Carga el perfil del usuario registrado
	*/
	function perfil(){
		error_reporting(0);
		$pagina=load_template('Digital Games - Perfil');
   		$css = load_page('app/views/default/modules/m.estiloPerfil.php');
   		$logo = load_page('app/views/default/modules/m.logoPerfil.php');
   		$usuario1=new Usuario;//Se carga un objeto de clase Usuario
		$usuario1->login();
		$usuario1->datosPerfil();//Se obtienen los datos del usuario
		session_start();//Se inicia sesión para no perder los datos de $_SESSION
		if($_SESSION['administrador']=='Si'){//Si se trata de un administrador se cargarán las fucnionalidades de este
			$logo = load_page('app/views/default/modules/m.logoAdministrador.php');
		}else{
			$logo = load_page('app/views/default/modules/m.logoPerfil.php');
		}
		$nombreUsuario=$_SESSION['nombreusuario'];
   		$html = load_page('app/views/default/modules/m.perfil.php');
   		//SACAR LOS FAVORITOS
   		$array=$usuario1->favoritosPerfil();
   		$juegosFavoritos='<span class="mensajeSeccion"><h1>Lista de juegos favoritos de '.$nombreUsuario.'</h1></span>';
		if(sizeof($array)>0){
			foreach ($array as $key => $value){
				$foto=$value->Id_Juego;
				$juegosFavoritos=$juegosFavoritos.'<a href="index.php?action=juego&id='.$value->Id_Juego.'">
				<div id="juego"><img class="juego" src="http://cdn.akamai.steamstatic.com/steam/apps/'.
				$foto .'/header.jpg?t='.$value->Imagen.'" /></div></a>';
 			}
		}else{
			$juegosFavoritos=$juegosFavoritos.'<div class="mensaje">No tienes juegos favoritos</div>';
		}
		$html = replace_content('/\#FAVORITOS\#/ms',$juegosFavoritos,$html);
		//var_dump($arrayFavorito);
		#SACAR LA BIBLIOTECA
		$array=$usuario1->bibliotecaPerfil();
		$juegosBiblioteca='<span class="mensajeSeccion"><h1>Biblioteca de '.$nombreUsuario.'</h1></span>';
		if(sizeof($array)>0){
			foreach ($array as $key => $value){

				$foto=$value->Id_Juego;
				$juegosBiblioteca=$juegosBiblioteca.'<a href="index.php?action=juego&id='.$value->Id_Juego.'">
				<div id="juego"><img class="juego" src="http://cdn.akamai.steamstatic.com/steam/apps/'.
				$foto .'/header.jpg?t='.$value->Imagen.'" /></div></a>';
 			}
		}else{
			$juegosBiblioteca=$juegosBiblioteca.'<div class="mensaje">No tienes juegos en la biblioteca</div>';
		}
		//var_dump($juegosBiblioteca);
		$html = replace_content('/\#BIBLIOTECA\#/ms',$juegosBiblioteca,$html);
		//$usuario1->mostrar($arrayBiblio);
		//SACAR LOS VIDEOS
		$array=$usuario1->videosPerfil();
		$videos='<span class="mensajeSeccion"><h1>Videos de '.$nombreUsuario.'</h1></span>';
		if(sizeof($array)>0){
			foreach ($array as $key => $value){
				$foto=$value->Id_Juego;
				$videos=$videosa.'<div id="juego"><img class="juego" src="http://cdn.akamai.steamstatic.com/steam/apps/'.
				$foto .'/header.jpg?t='.$value->Imagen.'" /></div>';
 			}
		}else{
			$videos=$videos.'<div class="mensaje">No tienes videos</div>';
		}
		//$array=$usuario1->actualizar();
		$html = replace_content('/\#VIDEOS\#/ms',$videos,$html);
		//Finalmente se cargan todos los componentes de la página usando una función de pageGenerator.php
		replace_page($css,$logo,$sesion,$html,$pagina);
	}

	/**
	*Carga el formulario de registro y de inicio de sesión
	*/
	function registrarse(){
		session_start();
		//Si se accede aquí, no debe existir ninguna sesión
		session_destroy();//Hay que asegurarse de que no se mantenga ninguna sesión anterior
		error_reporting(0);
		$pagina=load_template('Digital Games - Inicio Sesión');
		$css = load_page('app/views/default/modules/m.estiloConectarse.php');
   		$logo = load_page('app/views/default/modules/m.logo.php');
   		$usuario1=new Usuario;//Se crea un objeto de clase Usuario
		$usuario1->datosPerfil();//Se cargan los datos del nuevo usuario
		//var_dump($usuario1);
		$nombreUsuario=$_SESSION["nombreusuario"];
		$html = load_page('app/views/default/modules/m.inicioSesion.php');
		replace_page($css,$logo,$sesion,$html,$pagina);
		return $_SESSION;//La función devuelve los datos de la nueva sesión
	}

	/**
	*Carga la pagina del juego con sus caracteristicas y precios
	*/
	function paginaJuego(){
		session_start();//Se inicia sesión
		$juego1= new Juego;//Se crea un objeto de clase Juego
		$user1= new Usuario;//Se crea un objeto de clase Usuario
		$juego=$juego1->mostrarDatos();
		if($juego!=''){
	    	$NombreJuego = ob_get_clean();	
			$NombreJuego = $juego[0]->Nombre;//Se guarda el nombre del juego
	    }
		$pagina=load_template('Digital Games - '.$NombreJuego);//Se carga el nombre del juego en el titulo de la página
   		$css = load_page('app/views/default/modules/m.estiloJuego.php');
   		//Se comprueba si existe una sesión para habilitar las opciones del usuario registrado
   		if(isset($_SESSION['nombreusuario']) and $_SESSION['estado'] == 'Logueado') { 
		      $logo = load_page('app/views/default/modules/m.logoJuegoSesion.php');	
		      //echo "Con sesión";
		}else{   
		      $logo = load_page('app/views/default/modules/m.logoJuego.php');
		      //echo "Sin sesión";
		}
		//Se cargan los datos del juego en el contenido de la página
   		$imagen = '<img src="http://cdn.akamai.steamstatic.com/steam/apps/'.$juego[0]->Id_Juego.'/header.jpg?t='.$juego[0]->Imagen.'" id="caratula" alt="caratula">';
   		$precioSalida = $juego[0]->Precio_Original;
   		$usuario=$user1->identificar();
   		$botones='<form action="index.php?action=juego&id='.$_GET["id"].'&add=biblioteca" method="post" id="biblioteca">
               <button type="submit" name"sesion" value="biblioteca"> AÑADIR A BIBLIOTECA </button>
		      </form>
		      <form action="index.php?action=juego&id='.$_GET["id"].'&add=favoritos" method="post" id="favoritos">
        	  <button type="submit" name"sesion" value="favoritos"> AÑADIR A FAVORITOS </button>
		      </form>';
		if($_GET['add']!=null){
			//echo "añadiendo juego";
			if($_GET['add']=="biblioteca"){
				$juego1->biblioteca($_GET["id"],$usuario);//Esta función añade una línea en la tabla biblioteca
			}elseif($_GET['add']=="favoritos"){
				$juego1->favoritos($_GET["id"],$usuario);//Esta función añade una línea en la tabla favoritos
			}
		}
		//Se reemplazan cada uno de los componentes de la página
		$logo = replace_content('/\#IMAGEN\#/ms',$imagen,$logo);
		$logo = replace_content('/\#NOMBRE\#/ms',$NombreJuego,$logo);
		$logo = replace_content('/\#PRECIO\#/ms',$precioSalida,$logo);
		$logo = replace_content('/\#BOTONES\#/ms',$botones,$logo);
		$html = load_page('app/views/default/modules/m.juego.php');
		//var_dump($juego[0]);
		$informacion='';
		$fecha=$juego[0]->Fecha;
		if($fecha!="1970-01-01"){//La fecha con la se compara es la que se obtiene por defecto si no la encuentra 
			$informacion=$informacion.'<div>Fecha de Lanzamiento: '.$fecha.'</div>';
		}
		$desarrollador=$juego[0]->Desarrollador;
		$informacion=$informacion.'<div>Desarrollador: '.$desarrollador.'</div>';
		$desc=$juego[0]->Descripcion;
		if($desc!=null){//Sólo algunos juegos contienen descripción
			$informacion=$informacion.'<div>Descripción: '.$desc.'</div>';
		}
		$html = replace_content('/\#INFO\#/ms',$informacion,$html);
		$precios=$juego1->mostrarPrecios();
		//Se obtienen y se cargan los distintos precios del juego
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
		//Finalmente se cargan todos los componentes de la página usando una función de pageGenerator.php
		replace_page($css,$logo,$sesion,$html,$pagina);
	}
		
}
?>