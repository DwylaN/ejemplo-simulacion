<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Adaptacion a pantallas moviles -->
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">    
    <title>Ejemplo | Simulación</title>
    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/bootstrap-theme.min.css">
    <!-- Estilos personales -->
    <link href="css/dashboard.css" rel="stylesheet">
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <!-- Barrita -->
    <nav class="navbar navbar-inverse navbar-fixed-top">
        <div class="container-fluid">
            <div class="navbar-header">
                <a class="navbar-brand" href="#">Sistema</a>
            </div>

        </div>
    </nav>
    <!-- Contenedor principal -->
    <div class="container-fluid">
        <div class="row">
            <div class="main">
                <!-- Contenedor de los mensajes -->
                <div id="mensajes" class="alert alert-info alert-dismissable " style="display:none;">
                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                    <p>mensaje</p>
                </div>
                <h1 class="page-header">Productos</h1>
                <!-- Boton de agregar -->
                <div class="row ">
                   <div class="text-right">
                    <button type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#modal_productos" onclick="guardar_producto();">
                        <span class="glyphicon glyphicon-plus"></span> Agregar
                    </button>
                </div>
            </div>
            <h4 class="sub-header">Listado</h4>
            <!-- Contenedor de la tabla -->
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Codigo</th>
                            <th>Nombre</th>
                            <th>Descripción</th>
                            <th>Precio</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <!-- Cuerpo de la tabla -->
                    <tbody id="cuerpo_tabla_productos">

                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<!-- modals -->
<div class="modal fade" id="modal_productos" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Producto</h4>
      </div>
      <!-- Cuerpo del modal -->
      <div id="product-body" class="modal-body">
        <!-- Formulario para agregar y editar -->
        <form id="edit-form">
            <div class="form-group">
                <label for="code" class="label-product">Codigo:</label>
                <input type="text" class="form-control" id="code" name="code" value="" placeholder="001" required />
            </div>
            <div class="form-group">
                <label for="name" class="label-product">Nombre:</label>
                <input type="text" class="form-control" id="name" name="name" value="" placeholder="Mesa" required />
            </div>
            <div class="form-group">
                <label for="price" class="label-product">Precio:</label>
                <input type="number" class="form-control" id="price" name="price" value="" placeholder="1000.50" min="0" step="0.01" required />
            </div>
            <div class="form-group">
                <label for="description" class="label-product">Descripción:</label>
                <textarea id="description" class="form-control textarea-product" name="description" required></textarea>
            </div>
        </form>
      </div>
      <!-- Botones para cancelar o guardar -->
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
        <button type="button" id="btn-editar" class="btn btn-primary">Guardar</button>
      </div>
    </div>
  </div>
</div>
<!-- end modals -->

<!-- Librerias JSa -->
<script src="js/jquery-2.1.3.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/productos.js"></script>
</body>
</html>