<?php

	/**
	*Funciones para reemplazar contenido y cargar las páginas
	*Estas funciones serán utilizadas por el controlador
	*@author Digital Games
	*@version 1.0
	*/

	function load_template($title='Sin Titulo'){//Carga el titulo de la página
		$pagina = load_page('app/views/default/page.php');
		$pagina = replace_content('/\#TITULO\#/ms' ,$title , $pagina);	
		return $pagina;
	}


    function load_page($page){//Carga la página
		return file_get_contents($page);
	}

	function view_page($html){//Muestra la página
		echo $html;
	}

	function replace_page($css,$logo,$sesion,$contenido,$pagina){//Reemplaza los # por el contenido que se desea
		error_reporting(0);
		$pagina = replace_content('/\#CSS\#/ms' ,$css , $pagina);
		$pagina = replace_content('/\#LOGO\#/ms' ,$logo , $pagina);
		session_start();//Iniciando la sesión aquí no hace falta iniciarla en cada página
		$nombreUsuario=$_SESSION['nombreusuario'];
		$logo = replace_content('/\#NOMBREUSUARIO\#/ms',$nombreUsuario,$logo);
		//Se comprueba si el usuario ha iniciado sesión
		if(isset($_SESSION['nombreusuario']) and $_SESSION['estado'] == 'Logueado') { 
		      $sesion = load_page('app/views/default/modules/m.menuPerfil.php');
		      //echo "Con sesión";
		}else{   
		      $sesion = load_page('app/views/default/modules/m.menuInicioSesion.php');
		      //echo "Sin sesión";
		}
		$pagina = replace_content('/\#SESION\#/ms' ,$sesion , $pagina);		
		$pagina = replace_content('/\#CONTENIDO\#/ms' ,$contenido , $pagina);	
		$pagina = replace_content('/\#NOMBREUSUARIO\#/ms',$nombreUsuario,$pagina);
		view_page($pagina);
	}

	function replace_content($in='/\#CONTENIDO\#/ms', $out,$pagina){//Reemplaza el contenido
		 return preg_replace($in, $out, $pagina);	 	
	}
?>