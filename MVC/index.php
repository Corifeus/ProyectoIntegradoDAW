<?php
	error_reporting(E_ERROR | E_WARNING | E_PARSE);
	require 'app/controller/mvc.controller.php';
	require_once "app/model/recaptchalib.php";

     //se instancia al controlador 
	$mvc = new mvc_controller();

	/*
	// tu clave secreta
	$secret = "6Ldk3SATAAAAAFG8sP8PKskk4aC0SPJ5DpvEk-p8";
	 
	// respuesta vacía
	$response = null;
	 
	// comprueba la clave secreta
	$reCaptcha = new ReCaptcha($secret);
	// si se detecta la respuesta como enviada
	if ($_POST["g-recaptcha-response"]) {
		$response = $reCaptcha->verifyResponse(
	        $_SERVER["REMOTE_ADDR"],
	        $_POST["g-recaptcha-response"]
	    );
	}
	if ($response != null && $response->success) {
        echo "Hola " . $_POST["nombre"] . " (" . $_POST["email"] . "), Gracias por registrarte!";
	 } else{
	 	 echo "Error en el registro";
	 }*/

	if( $_GET['action'] == 'inicio' ){
			$mvc->principal();	
	}
	else if( $_GET['action'] == 'genero' ){
			$mvc->genero();	
	}
	else if( $_GET['action'] == 'perfil' ){
			$mvc->perfil();	
	}
	else if( $_GET['action'] == 'registrarse' ){
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