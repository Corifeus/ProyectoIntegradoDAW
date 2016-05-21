<?php
	error_reporting(E_ERROR | E_WARNING | E_PARSE);
	require 'app/controller/mvc.controller.php';

     //se instancia al controlador 
	$mvc = new mvc_controller();

	if( $_GET['action'] == 'inicio' ){
			$mvc->principal();	
	}
	else if( $_GET['action'] == 'genero' ){
			$mvc->genero();	
	}
	else if( $_GET['action'] == 'perfil' ){
			$mvc->perfil();	
	}
	else if( $_GET['action'] == 'conectarse' ){
			$mvc->registrarse();	
	}
	else if( $_GET['action'] == 'avanzada' ){
			$mvc->buscador();
	}
	else if( $_GET['action'] == 'busqueda' ){
			$mvc->resultadoBusqueda();
	}
	else if( $_GET['action'] == 'juego' ){
			$mvc->paginaJuego();
	}
	/*else if(isset($_SESSION["nombreusuario"])&&($_SESSION["nombreusuario"])!=""){
			$mvc->menuPerfil();
	}
	else if(!isset($_SESSION["nombreusuario"])){
			$mvc->menuInicioSesion();
	*/
	else{	
		$mvc->principal();
	}