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
		$pagina = replace_content('/\#CSS\#/ms' ,$css , $pagina);
		$pagina = replace_content('/\#LOGO\#/ms' ,$logo , $pagina);
		//var_dump($_SESSION);
		if(isset($_SESSION)){
			$sesion = load_page('app/views/default/modules/m.menuPerfil.php');
		}else{
			$sesion = load_page('app/views/default/modules/m.menuInicioSesion.php');
		}
		$pagina = replace_content('/\#SESION\#/ms' ,$sesion , $pagina);		
		$pagina = replace_content('/\#CONTENIDO\#/ms' ,$contenido , $pagina);	
		view_page($pagina);
	}

	function replace_content($in='/\#CONTENIDO\#/ms', $out,$pagina){
		 return preg_replace($in, $out, $pagina);	 	
	}
?>