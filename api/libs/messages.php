<?php if(!defined("Api_Store_1_0_0_D")) die("Acceso denegado");
	function getMessage($option, $message){
		switch ($option) {
			case 'login':
				switch ($message) {
					case 0:
						$messages = array("message"=>"Correo electrónico necesario.");
						break;
					case 1:
						$messages = array("message"=>"Contraseña necesaria.");
						break;
					case 2:
						$messages = array("message"=>"Usuario o contraseña incorrecto.");
						break;
					case 3:
						break;
				}
				break;
			case 'products':
				switch ($message) {
						case 0:
							$messages = array("message"=>"No se encontraron productos.");
							break;
						case 1:
							$messages = array("message"=>"Campos incompletos");
							break;
						case 2:
							$messages = array("message"=>"Producto no encontrado");
							break;
						case 3:
							break;
					}
				break;
			case 'general':
				switch ($message) {
					case 0:
						$messages = array("message"=>"Intentalo nuevamente mas tarde.");
						break;
					case 1:
						$messages = array("message"=>"");
						break;
					case 2:
						$messages = array("message"=>"");
						break;
					case 3:
						break;
				}
				break;
		}
		return $messages;
	}
?>