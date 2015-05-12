<?php
	//permite las llamadas de cualquier sitio web
	header("Access-Control-Allow-Origin: *");
	//inicia la seccion para login
	@session_start();
	//direccion donde esta el microframeword
	require 'Slim/Slim.php';
	//se carla toda la libreria del microframeword
	\Slim\Slim::registerAutoloader();
	//se crea un nuevo objeto de la libreria
	$app = new \Slim\Slim();

	//define una constante por seguridad
	define("Api_Store_1_0_0_D", true);
	//direccion del archivo para la conexion a la base de datos
	require 'libs/datab.php';
	//direccion del archivo para los mensajes generales
	require 'libs/messages.php';
	//direccion del archivo para las rutas de la api
	require 'routes/api.php';

	//se define el tipo de contenido a regresar
	$app->response->headers->set("Content-type","application/json");
	//inicia la aplicacion(objeto) creada anteriormente
	$app->run();
?>