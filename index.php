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
			$mvc->conectarse();	
	}
	else if( $_GET['action'] == 'avanzada' ){
			$mvc->buscador();
	}
	else if(isset($_SESSION["nombreusuario"])&&($_SESSION["nombreusuario"])!=""){
			$mvc->menuPerfil();
	}
	else if(!isset($_SESSION["nombreusuario"])){
			$mvc->menuInicioSesion();
	}
	else if( isset($_POST['facultad']) && 
			 isset($_POST['nombre']) &&
			 isset($_POST['apellido1']) &&
			 isset($_POST['apellido2']) &&
			 isset($_POST['dni'])){
		$mvc->insertar($_POST['nombre'], $_POST['apellido1'], $_POST['apellido2'], $_POST['dni'], $_POST['facultad'] );
	}
	else if(isset($_POST['facultad'])){
			$mvc->buscar( $_POST['facultad']);
	}
	else{	
		$mvc->principal();
	}