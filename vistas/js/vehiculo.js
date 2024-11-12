//Cargar lista de modelos de vehiculo segun marca seleccionada
$('#idMarcaVehiculo').on('change', function(){

    var idMarca = $("#idMarcaVehiculo").val();

    $('#idModeloVehiculo').empty();
    $('#idModeloVehiculo').append('<option value="">- Modelo Vehiculo -</option>');

    var datos = new FormData();
    datos.append("accion", "listarModelos");
    datos.append("marcaVehiculo", idMarca);

    $.ajax({
        url: "ajax/modelo.ajax.php",
        method: "POST",
        data: datos,
        cache: false,
        contentType: false,
        processData: false,
        dataType: "json",
        success: function(respuesta){

            //console.log("respuesta:", respuesta);

            respuesta.forEach(function(row) {

				$('#idModeloVehiculo').append('<option value="'+row.ID_MODELO+'">'+row.NOMBRE_MODELO+'</option>');

			});

        }

    });

});


//Cargar lista de modelos de vehiculo segun marca seleccionada para Editar
$('#idMarcaVehiculoEditar').on('change', function(){

    var idMarca = $("#idMarcaVehiculoEditar").val();

    $('#idModeloVehiculoEditar').empty();
    $('#idModeloVehiculoEditar').append('<option value="">- Modelo Vehiculo -</option>');

    var datos = new FormData();
    datos.append("accion", "listarModelos");
    datos.append("marcaVehiculo", idMarca);

    $.ajax({
        url: "ajax/modelo.ajax.php",
        method: "POST",
        data: datos,
        cache: false,
        contentType: false,
        processData: false,
        dataType: "json",
        success: function(respuesta){

            //console.log("respuesta:", respuesta);

            respuesta.forEach(function(row) {

				$('#idModeloVehiculoEditar').append('<option value="'+row.ID_MODELO+'">'+row.NOMBRE_MODELO+'</option>');

			});

        }

    });

});


//Verificar que el usuario ingresado no exista en BD
$('#nuevoPlacaVehiculo').blur(function(){

    var placaVehiculo = $("#nuevoPlacaVehiculo").val();
    
    if(placaVehiculo == ""){

        $("#nuevoPlacaVehiculo").removeClass("is-valid");
        $("#nuevoPlacaVehiculo").removeClass("is-invalid");
        $("#spExistePlaca").text("");
        $('#btnRegistrarVehiculo').attr('disabled', false);
        return; 
        
    }

    var datos = new FormData();
    datos.append("accion", "buscarVehiculoPlaca");
    datos.append("placaVehiculo", placaVehiculo);

    $.ajax({
        url: "ajax/vehiculo.ajax.php",
        method: "POST",
        data: datos,
        cache: false,
        contentType: false,
        processData: false,
        dataType: "json",
        success: function(respuesta){

            //console.log("respuesta:", respuesta);

            if(respuesta){

                $("#spExistePlaca").text("La placa ya ha sido registrado");
                $('#btnRegistrarVehiculo').attr('disabled', true);
                $("#nuevoPlacaVehiculo").removeClass("is-valid");
                $("#nuevoPlacaVehiculo").addClass("is-invalid");
                $("#nuevoPlacaVehiculo").focus()

            }else{

                $("#spExistePlaca").text("");
                $("#nuevoPlacaVehiculo").removeClass("is-invalid");
                $("#nuevoPlacaVehiculo").addClass("is-valid");
                $('#btnRegistrarVehiculo').attr('disabled', false);

            }

        }

    });

});


//Mostrar ventana para editar Vehiculo
$(document).on("click", ".editarVehiculo", function(){

    var idVehiculo = $(this).attr("idVehiculo");

    var datos = new FormData();
    datos.append("accion", "buscarVehiculoEditar");
    datos.append("idVehiculo", idVehiculo);

    $.ajax({
        url: "ajax/vehiculo.ajax.php",
        method: "POST",
        data: datos,
        cache: false,
        contentType: false,
        processData: false,
        dataType: "json",
        success: function(respuesta){

            //console.log("respuesta:", respuesta);

            $("#editarPlacaVehiculo").val(respuesta.PLACA_VEHICULO);
            $("#anioFabricacionEditar").val(respuesta.ANIO_FABRICACION);
            $("#nroMotorEditar").val(respuesta.NRO_MOTOR);
            $("#colorEditar").val(respuesta.COLOR);
            $("#responsableEditar").val(respuesta.RESPONSABLE);
            $("#idVehiculoEditar").val(respuesta.ID_VEHICULO);
            $("#idMarcaVehiculoEditar").val(respuesta.ID_MARCA);
            mostrarModelosMarca(respuesta.ID_MARCA, respuesta.ID_MODELO);
            
            $("#modalEditarVehiculo").modal('show');

        }

    });
    
});

function mostrarModelosMarca(pIdMarca, pIdModelo){

    $('#idModeloVehiculoEditar').empty();
    $('#idModeloVehiculoEditar').append('<option value="">- Modelo Vehiculo -</option>');

    var datos = new FormData();
    datos.append("accion", "listarModelos");
    datos.append("marcaVehiculo", pIdMarca);

    $.ajax({
        url: "ajax/modelo.ajax.php",
        method: "POST",
        data: datos,
        cache: false,
        contentType: false,
        processData: false,
        dataType: "json",
        success: function(respuesta){

            //console.log("respuesta:", respuesta);

            respuesta.forEach(function(row) {

				$('#idModeloVehiculoEditar').append('<option value="'+row.ID_MODELO+'">'+row.NOMBRE_MODELO+'</option>');

			});

            $("#idModeloVehiculoEditar").val(pIdModelo);

        }

    });

}