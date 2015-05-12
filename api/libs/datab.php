<?php
	//se comprueba si esta definida la constante en caso contrario no permite el acceso a la funccion 
	if(!defined("Api_Store_1_0_0_D")) die("Acceso denegado");
	//funcion que retorna la conexion de la base de datos
	function getConnection(){
		try{
			//usuario de la base de datos
			$db_username = "root";
			//password de la base de datos
			$db_password = "";
			//se crea una conexion a la base de datos
			//mysql = motor
			//host = direccion de la base de datos
			//dbname = nombre base de datos
			//usuario y contraseña creanos anteriormente
			$conn = new PDO('mysql:host=localhost;dbname=simulacion', $db_username, $db_password);
			//se define el tipo de caracteres a usar
			$conn->exec("set names utf8");
			//se definen los metodos para el retorno de errores al conectarse
			$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		}
		catch(PDOException $ex){
			//en caso de error imprime un mensaje
			echo 'Error: '.$ex->getMessage();
		}
		//retorna la conexion
		return $conn;
	}
?>