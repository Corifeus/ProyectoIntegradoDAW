<?php
	error_reporting(E_ERROR | E_WARNING | E_PARSE);
	require 'app/controller/mvc.controller.php';
	require_once 'recaptchalib.php';

	/**
	*Es el archivo principal que se ejecuta al abrir la aplicación
	*Requiere del resto para funcionar correctamente
	*@author Digital Games
	*@version 1.0
	*/
     //se instancia al controlador 
	$mvc = new mvc_controller();

		//Comprobar Captcha en el formulario de registro
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
	$user = new Usuario;

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
		if($response != null && $response->success) {
			$user->registrar();
        	$mvc->perfil();	
		}else{
	 		$user->login();
	 	 	$mvc->registrarse();
		}
	}
	else if( $_GET['action'] == 'avanzada' ){
			$mvc->buscador();
	}
	else if( $_GET['action'] == 'busqueda' ){
			$mvc->resultadoBusqueda();
	}
	else if( $_GET['action'] == 'juego' ){
			$mvc->paginaJuego();
	}else{	
		$mvc->principal();
	}