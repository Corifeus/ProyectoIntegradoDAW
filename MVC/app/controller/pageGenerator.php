<?php
	function load_template($title='Sin Titulo'){
		$pagina = load_page('app/views/default/page.php');
		$pagina = replace_content('/\#TITULO\#/ms' ,$title , $pagina);	
		return $pagina;
	}


    function load_page($page){
		return file_get_contents($page);
	}

	function view_page($html){
		echo $html;
	}

	function replace_page($css,$logo,$sesion,$contenido,$pagina){
		error_reporting(0);
		$pagina = replace_content('/\#CSS\#/ms' ,$css , $pagina);
		$pagina = replace_content('/\#LOGO\#/ms' ,$logo , $pagina);
		//echo session_name();
		session_start();
		$nombreUsuario=$_SESSION['nombreusuario'];
		//var_dump($nombreUsuario);
		$logo = replace_content('/\#NOMBREUSUARIO\#/ms',$nombreUsuario,$logo);
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

	function replace_content($in='/\#CONTENIDO\#/ms', $out,$pagina){
		 return preg_replace($in, $out, $pagina);	 	
	}
?>