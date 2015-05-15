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

	//retorna un solo producto segun el codigo
	$app->get('/products/:codigo',function($code) use ($app){
		//obtiene la conexion de la base de datos
		$connection = getConnection();
		
		$dbh = $connection->prepare("SELECT * FROM products WHERE code = ?");
		$dbh->bindParam(1,$code);
		$dbh->execute();
		
		$products = $dbh->fetchAll(PDO::FETCH_OBJ);
		
		//evalua si la consulta retorno datos
		if(count($products) > 0){		
			$app->response->status(200);		
			$app->response->body(json_encode($products[0]));
		}else{			
			$app->response->status(200);			
			$app->response->body(json_encode(getMessage('products',2)));
		}
	});	

	$app->post('/products/',function() use($app){
		$code = $app->request->post("code");
		$name = $app->request->post("name");
		$description = $app->request->post("description");
		$price = $app->request->post("price");

		try{
			$connection = getConnection();
			$dbh = $connection->prepare("SELECT * FROM products WHERE code = ?");
			$dbh->bindParam(1, $code);
			$dbh->execute();
			$products = $dbh->fetchAll(PDO::FETCH_OBJ);
			$connection = null;

			if(count($products) > 0){
				$app->response->status(200);
				$app->response->body(json_encode(getMessage('products',3)));
			}else{
				$connection = getConnection();
				$dbh = $connection->prepare("INSERT INTO products VALUES(null, ?, ?, ?, ?)");
				$dbh->bindParam(1, $code);
				$dbh->bindParam(2, $name);
				$dbh->bindParam(3, $description);
				$dbh->bindParam(4, $price);
				$dbh->execute();
				$connection = null;

				$app->response->status(200);
				$app->response->body(json_encode(getMessage('products',4)));
			}
		}
		catch(PDOException $e){
			echo "Error:".$e->getMessage();
			$app->response->status(200);
			$app->response->body(json_encode(getMessage('general',0)));
		}
	});

	//Elimina un producto de la db apartir de su codigo
    $app->delete('/products/:codigo', function($code) use ($app) {
  		//Conecta a la db
    	$connection = getConnection();
		
		$dbh = $connection->prepare("SELECT * FROM products WHERE code = ?");
		$dbh->bindParam(1, $code);
		$dbh->execute();

		$products = $dbh->fetchAll(PDO::FETCH_OBJ);
		        
        if(count($products) >0) {
        
            try {
                $dbh = $connection->prepare("DELETE FROM products WHERE code = ?");
                $dbh->bindParam(1, $code);
                $dbh->execute();

                $app->response->status(200);
                $app->response->body(json_encode(getMessage('products',5)));
        
            } catch(PDOException $e) {
            	$app->response->status(200);
                $app->response->body(json_encode(getMessage('products',6)));
            }
        }else{
        	$app->response->status(200);
            $app->response->body(json_encode(getMessage('products',7)));
        }        
        //Limpiamos la conexion a la db
        $connection = null;
    });

	//Actualiza un producto de la db apartir de su codigo
    $app->put('/products/:id', function($id) use ($app) {

    	$code = $app->request->put("code");
		$name = $app->request->put("name");
		$description = $app->request->put("description");
		$price = $app->request->put("price");

  		//Conecta a la db
    	$connection = getConnection();
		
		$dbh = $connection->prepare("SELECT * FROM products WHERE id = ?");
		$dbh->bindParam(1, $id);
		$dbh->execute();
		$products = $dbh->fetchAll(PDO::FETCH_OBJ);

		if(count($products) > 0){						
			try{
				$dbh = $connection->prepare("UPDATE products SET code = ?, name = ?, description = ?, price =? WHERE id =?");
				$dbh->bindParam(1, $code);
				$dbh->bindParam(2, $name);
				$dbh->bindParam(3, $description);
				$dbh->bindParam(4, $price);
				$dbh->bindParam(5, $id);
				$dbh->execute();

				$app->response->status(200);
				$app->response->body(json_encode(getMessage('products',8)));
			} catch(PDOException $e){
				echo "Error:".$e->getMessage();
				$app->response->status(200);
				$app->response->body(json_encode(getMessage('general',0)));
			}
			
		}else{
			$app->response->status(200);
			$app->response->body(json_encode(getMessage('products',2)));
		}

        //Limpiamos la conexion a la db
        $connection = null;
    });

?>