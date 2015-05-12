<?php if(!defined("Api_Store_1_0_0_D")) die("Acceso denegado");
	
	//ruta default de la api
	$app->get('/', function(){
		echo 'api rest simulacion';
	});

	//retorna todos los productos dentro de la base de datos
	$app->get('/products',function() use ($app){
		//obtiene la conexion de la base de datos
		$connection = getConnection();
		//prepara la consulta
		$dbh = $connection->prepare("SELECT * FROM products");
		//ejecuta la consulta
		$dbh->execute();
		//obtiene todos los resultados de la consulta
		$products = $dbh->fetchAll(PDO::FETCH_OBJ);
		//se cierra la conexion de la base de datos
		$connection = null;
		//evalua si la consulta retorno datos
		if(count($products) > 0){
			//se define el estado del http
			$app->response->status(200);
			//retorna la respuesta en formato json
			$app->response->body(json_encode($products));
		}else{
			//se define el estado del http
			$app->response->status(200);
			//retorna la respuesta en formato json
			$app->response->body(json_encode(getMessage('products',0)));
		}
	});

?>