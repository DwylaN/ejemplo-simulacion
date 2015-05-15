<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Ejemplo | Simulación</title>
    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/bootstrap-theme.min.css">
    <!-- Custom styles for this template -->
    <link href="css/dashboard.css" rel="stylesheet">
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <nav class="navbar navbar-inverse navbar-fixed-top">
        <div class="container-fluid">
            <div class="navbar-header">
                <a class="navbar-brand" href="#">Sistema</a>
            </div>

        </div>
    </nav>

    <div class="container-fluid">
        <div class="row">
            <div class="main">
                <div id="mensajes" class="alert alert-info alert-dismissable " style="display:none;">
                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                    <p>mensaje</p>
                </div>
                <h1 class="page-header">Productos</h1>
                <div class="row ">
                   <div class="text-right">
                    <button type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#modal_productos" onclick="guardar_producto();">
                        <span class="glyphicon glyphicon-plus"></span> Agregar
                    </button>
                </div>
            </div>

            <h4 class="sub-header">Listado</h4>
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
      <div id="product-body" class="modal-body">
        <form id="edit-form">
            <label for="code">Codigo:</label>
            <input type="text" id="code" name="code" value="" placeholder="001" required />
            <label for="name">Nombre:</label>
            <input type="text" id="name" name="name" value="" placeholder="Mesa" required />
            <label for="price">Precio:</label>
            <input type="number" id="price" name="price" value="" placeholder="1000.50" min="0" step="0.01" required />
            <label for="description">Descripción:</label>
            <textarea id="description" name="description" required></textarea>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
        <button type="button" id="btn-editar" class="btn btn-primary">Guardar</button>
      </div>
    </div>
  </div>
</div>

<!-- end modals -->

<script src="js/jquery-2.1.3.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/productos.js"></script>
</body>
</html>