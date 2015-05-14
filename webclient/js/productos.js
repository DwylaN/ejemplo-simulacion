$(document).on('ready',function() {
    //Se carga la tabla
    carga_tabla();    
});

//Funcion para consultar y crear una lista de productos existentes en la db
function carga_tabla() {
    //Se realiza la peticion a la api de todos los productos existentes
    $.ajax({
     url: 'http://compras.ipn/api/products',
     type: 'GET',
     dataType: 'json'
    })
    .done(function(data) {
        var table_body = '';
        //limpiamos el la lista
        $('#cuerpo_tabla_productos').html('');
        //Iniciamos la creacion de la lista de productos
        for (var i = 0 ; i <  data.length; i++) {
            //concatenamos el html de cada renglon de la tabla
            table_body += '<tr> \
            <td>' + (i+1) + '</td> \
            <td>' + data[i].code + '</td> \
            <td>' + data[i].name +'</td> \
            <td>' + data[i].description + '</td> \
            <td> $' + data[i].price + '</td> \
            <td> \
            <button id="btn_editar" onclick="detalle_producto(\''+ data[i].code+'\')" type="button" class="btn btn-success btn-sm" > \
            <span class="glyphicon glyphicon-pencil"></span> \
            </button> \
            <button id="btn_eliminar" onclick="eliminar_producto(\''+ data[i].code+'\')"  type="button" class="btn btn-danger btn-sm"> \
            <span class="glyphicon glyphicon-trash"></span> \
            </button> \
            </td> \
            </tr>';
        };
        // Rellenamos el cuerpo de la lista de productos
        $('#cuerpo_tabla_productos').html(table_body);
    })
    .fail(function(data) {
        console.log("error");
        alert('error en la carga de la lista')
    });
}


//Funcion para eliminar un producto apartir de su codigo
function eliminar_producto(code) {
    //Realizo una confirmacion de eliminacion al usuario
    if (confirm('Seguro que desea eliminar el producto con codigo: ' + code )) {
        //Si se confirmo la eliminacion se hace la peticion delete a la api
        $.ajax({
            url: 'http://compras.ipn/api/products/' + code,
            type: 'DELETE',
            dataType: 'json',
        })
        .done(function(data) {
            console.log(data.message);
            carga_tabla();
            muestra_mensaje(data.message);
        })
        .fail(function() {
            console.log("error");
            alert('error en la eliminacion del producto')
        });        
    };
}

function detalle_producto(code) {
    $.ajax({
        url: 'http://compras.ipn/api/products/' + code,
        type: 'GET',
        dataType: 'json',        
    })
    .done(function(data) {        
        console.log(data);

        //Jesus

        $('#modal_productos').modal('show');

    });
}

function actualizar_producto() {}

function guardar_producto() {}

function muestra_mensaje(message) {
    $("#mensajes p ").html('');
    $("#mensajes p ").html(message);

    $("#mensajes").fadeTo(2000, 500).slideUp(500, function(){
        $("#mensajes").hide();
        $("#mensajes p ").html('');
    });
}



