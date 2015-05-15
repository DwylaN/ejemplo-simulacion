$(document).on('ready',function() {
    //Se carga la tabla
    carga_tabla();
});

//Funcion para consultar y crear una lista de productos existentes en la db
function carga_tabla() {
    //Se realiza la peticion a la api de todos los productos existentes
    $.ajax({
     url: 'http://localhost/ejemplo-simulacion/api/products',
     type: 'GET',
     dataType: 'json'
    })
    .done(function(data) {
        var table_body = '';
        //limpiamos el la lista
        $('#cuerpo_tabla_productos').html('');
        if (data.length > 0 ) {
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
    }else{
        muestra_mensaje('NO EXISTEN PRODUCTOS REGISTRADOS.');
    }
        // Rellenamos el cuerpo de la lista de productos
        $('#cuerpo_tabla_productos').html(table_body);
    })
    .fail(function(data) {
        console.log("error");
        muestra_mensaje('Error en la carga de la lista.');
    });
}


//Funcion para eliminar un producto apartir de su codigo
function eliminar_producto(code) {
    //Realizo una confirmacion de eliminacion al usuario
    if (confirm('Seguro que desea eliminar el producto con codigo: ' + code )) {
        //Si se confirmo la eliminacion se hace la peticion delete a la api
        $.ajax({
            url: 'http://localhost/ejemplo-simulacion/api/products/' + code,
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
            muestra_mensaje('Error en la eliminacion del producto.');
        });        
    };
}

function detalle_producto(code) {
    $.ajax({
        url: 'http://localhost/ejemplo-simulacion/api/products/' + code,
        type: 'GET',
        dataType: 'json',        
    })
    .done(function(data) {        
        console.log(data);
        //se asignan valores
        $("#code").val(data.code);
        $("#name").val(data.name);
        $("#price").val(data.price);
        $("#description").val(data.description);
        //se elimina evento click del boton
        $("#btn-editar").unbind('click');
        //se agrega envento click al boton
        $("#btn-editar").click(function(){ actualizar_producto(data.id); });
        //se muestra la ventana modal
        $('#modal_productos').modal('show');
    });
}

function actualizar_producto(id) {
    $.ajax({
        url: 'http://localhost/ejemplo-simulacion/api/products/' + id,
        type: 'PUT',
        dataType: 'json',
        data : $("#edit-form").serialize()
    }).done(function(data){
        $('#modal_productos').modal('hide');
        console.log(data.message);
        carga_tabla();
        muestra_mensaje(data.message);
    }).fail(function(){
        console.log("error");
        muestra_mensaje('No se pudo actualizar el producto.');
    });
}

function guardar_producto() {
    $("#code").val('');
    $("#name").val('');
    $("#price").val('');
    $("#description").val('');
    //se elimina evento click del boton
    $("#btn-editar").unbind('click');
    //se agrega envento click al boton
    $("#btn-editar").click(function(){ agregar_producto() });
}

function agregar_producto(){
    $.ajax({
        url: 'http://localhost/ejemplo-simulacion/api/products/',
        type: 'POST',
        dataType: 'json',
        data : $("#edit-form").serialize()
    }).done(function(data){
        $('#modal_productos').modal('hide');
        console.log(data.message);
        carga_tabla();
        muestra_mensaje(data.message);
    }).fail(function(){
        console.log("error");
        muestra_mensaje('No se pudo actualizar el producto.');
    });
}

function muestra_mensaje(message) {
    $("#mensajes p ").html('');
    $("#mensajes p ").html('<center><strong>'+ message + '</strong></center>');

    $("#mensajes").fadeTo(2000, 500).slideUp(500, function(){
        $("#mensajes").hide();
        $("#mensajes p ").html('');
    });
}



