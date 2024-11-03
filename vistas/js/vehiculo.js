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