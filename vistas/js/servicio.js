//Buscar vehiculo por placa
function buscarVehiculoPlaca(){

    var placaVehiculo = $("#placaVehiculo").val();

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

            //Si no hay respuesta
            if(!respuesta){

                alert('Vehiculo no encontrado');
                $("#placaVehiculo").focus();
                return;

            }

            $("#spPlaca").text(respuesta.PLACA_VEHICULO);
            $("#spMarca").text(respuesta.NOMBRE_MARCA);
            $("#spModelo").text(respuesta.NOMBRE_MODELO);
            $("#spAnio").text(respuesta.ANIO_FABRICACION);
            $("#spResponsable").text(respuesta.RESPONSABLE);
            $("#idVehiculo").val(respuesta.ID_VEHICULO);

            $('#kilometraje').focus();

        }

    });

}


//Registrar servicio
$("#btnRegistrarServicio").click(function(){

    var idVehiculo = $("#idVehiculo").val();
    var fechaIngreso = $("#fechaIngreso").val();
    var horaIngreso = $("#horaIngreso").val();
    var kilometraje = $("#kilometraje").val();
    var detalleServicio = $("#detalleServicio").val();

    if(idVehiculo == ""){

        alert("Ingrese los datos del vehiculo");
        $("#placaVehiculo").focus();
        return;

    }

    var datos = new FormData();
    datos.append("accion", "registrarServicio");
    datos.append("idVehiculo", idVehiculo);
    datos.append("fechaIngreso", fechaIngreso);
    datos.append("horaIngreso", horaIngreso);
    datos.append("kilometraje", kilometraje);
    datos.append("detalleServicio", detalleServicio);

    $.ajax({
        url: "ajax/servicio.ajax.php",
        method: "POST",
        data: datos,
        cache: false,
        contentType: false,
        processData: false,
        dataType: "json",
        success: function(respuesta){

            console.log("respuesta:", respuesta);
        
            if(respuesta == "ok"){
        
                Swal.fire({
                    title: "Servicio registrado correctamente",
                    icon: "success",
                    confirmButtonText: "Ok"
                }).then((result) => {

                    if (result.isConfirmed) {
                        window.location = "ingreso";
                    }

                })

            }

            

        }

    });
    
});



//Finalizar servicio
function finalizarServicio(idServicio){

    var fechaHora = fechaHoraActual();

    //alert(fechaHora); return;

    var datos = new FormData();
    datos.append("accion", "finalizarServicio");
    datos.append("idServicio", idServicio);
    datos.append("fechaHora", fechaHora);

    Swal.fire({
        title: 'Alerta!!',
        text: "Confirma que desea Finalizar el servicio?",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        cancelButtonText: 'Cancelar',
        confirmButtonText: 'Confirmar'
      }).then((result) => {
        if (result.isConfirmed) {

            $.ajax({
                url: "ajax/servicio.ajax.php",
                method: "POST",
                data: datos,
                cache: false,
                contentType: false,
                processData: false,
                dataType: "json",
                success: function(respuesta){
        
                    //console.log("respuesta:", respuesta);
        
                    if(respuesta == "ok"){
        
                        Swal.fire({
                            title: "Servicio finalizado correctamente",
                            icon: "success",
                            confirmButtonText: "Ok"
                        }).then((result) => {
        
                            if (result.isConfirmed) {
                                window.location = "salida";
                            }
        
                        })
        
                    }
        
                }
        
            });

        }
    });

}


//Anular servicio
function anularServicio(idServicio){

    //alert(idServicio); return;

    var datos = new FormData();
    datos.append("accion", "anularServicio");
    datos.append("idServicio", idServicio);

    Swal.fire({
        title: 'Alerta!!',
        text: "Esta seguro que desea Cancelar el servicio?",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        cancelButtonText: 'Cancelar',
        confirmButtonText: 'Confirmar'
      }).then((result) => {
        if (result.isConfirmed) {

            $.ajax({
                url: "ajax/servicio.ajax.php",
                method: "POST",
                data: datos,
                cache: false,
                contentType: false,
                processData: false,
                dataType: "json",
                success: function(respuesta){
        
                    //console.log("respuesta:", respuesta);
        
                    if(respuesta == "ok"){
        
                        Swal.fire({
                            title: "El servicio ha sido anulado correctamente",
                            icon: "success",
                            confirmButtonText: "Ok"
                        }).then((result) => {
        
                            if (result.isConfirmed) {
                                window.location = "salida";
                            }
                            
                        })
        
                    }
        
                }
        
            });

        }
    });
}


//Editar servicio
function editarServicio(idServicio){

    //alert(idServicio); return;
    
    var datos = new FormData();
    datos.append("accion", "editarServicio");
    datos.append("idServicio", idServicio);

    $.ajax({
        url: "ajax/servicio.ajax.php",
        method: "POST",
        data: datos,
        cache: false,
        contentType: false,
        processData: false,
        dataType: "json",
        success: function(respuesta){

            //console.log("respuesta:", respuesta);

            respuesta.forEach(function(row) {                 
                $("#datosVehiculo").text(row.PLACA_VEHICULO +" - "+ row.MARCA_MODELO);
                $("#datosIngreso").text(row.FECHA_INGRESO);
                $("#datosServicio").text(row.DESC_SERVICIO);
                $("#nuevoCostoServicio").val(row.COSTO_SERVICIO);
                $("#hIdServicio").val(row.ID_SERVICIO);
            });

            $("#modalEditarServicio").modal("show");

        }

    });

}

//funcion para captura fecha y hora actual
function fechaHoraActual() {

    var date = new Date();
    var aaaa = date.getFullYear();
    var gg = date.getDate();
    var mm = (date.getMonth() + 1);

    if (gg < 10)
        gg = "0" + gg;

    if (mm < 10)
        mm = "0" + mm;

    var cur_day = aaaa + "-" + mm + "-" + gg;

    var hours = date.getHours()
    var minutes = date.getMinutes()
    var seconds = date.getUTCSeconds();

    if (hours < 10)
        hours = "0" + hours;

    if (minutes < 10)
        minutes = "0" + minutes;

    if (seconds < 10)
        seconds = "0" + seconds;

    return cur_day + " " + hours + ":" + minutes + ":" + seconds;

}



///***** Para no refrescar pagina por busqueda de producto por codigo *******
$(function(){
    $("#frmBuscarVehiculo").submit(function(e) {
        buscarVehiculoPlaca();
        return false;
    });
});
