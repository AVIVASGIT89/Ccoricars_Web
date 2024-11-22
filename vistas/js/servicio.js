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
                $("#placaVehiculo").select();
                return;

            }

            $("#spPlaca").text(respuesta.PLACA_VEHICULO);
            $("#spMarca").text(respuesta.NOMBRE_MARCA);
            $("#spModelo").text(respuesta.NOMBRE_MODELO);
            $("#spAnio").text(respuesta.ANIO_FABRICACION);
            $("#spResponsable").text(respuesta.RESPONSABLE);
            $("#idVehiculo").val(respuesta.ID_VEHICULO);

            $('#kilometraje').select();

        }

    });

}


//Registrar servicio
$("#btnRegistrarServicio").click(function(){

    $("#btnRegistrarServicio").prop('disabled', true);

    var idVehiculo = $("#idVehiculo").val();
    var fechaIngreso = $("#fechaIngreso").val();
    var horaIngreso = $("#horaIngreso").val();
    var kilometraje = $("#kilometraje").val();
    var detalleServicio = $("#detalleServicio").val();

    if(idVehiculo == ""){

        alert("Ingrese los datos del vehiculo");
        $("#placaVehiculo").focus();
        $("#btnRegistrarServicio").prop('disabled', false);
        return;

    }

    var datos = new FormData();
    datos.append("accion", "registrarServicio");
    datos.append("idVehiculo", idVehiculo);
    datos.append("fechaIngreso", fechaIngreso);
    datos.append("horaIngreso", horaIngreso);
    datos.append("kilometraje", kilometraje);
    datos.append("detalleServicio", detalleServicio);

    //Efecto "Registrando..."
    $(this).prop("disabled", true);
    $(this).html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Registrando...');      

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
                    title: "Servicio registrado correctamente",
                    icon: "success",
                    allowOutsideClick: false,
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
                            allowOutsideClick: false,
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
                            allowOutsideClick: false,
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


//Registro de detalle de servicio
function registroDetalleServicio(idServicio){

    $("#btnRegistrarDetalleServicio").prop('disabled', true);
    
    var datos = new FormData();
    datos.append("accion", "editarServicio");
    datos.append("idServicio", idServicio);

    //Ejecuta el efecto cargando...
	var screen = $('#loading-screen');
	configureLoadingScreen(screen);

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

            var items;

            respuesta.forEach(function(row) {
                items = row.ITEMS;
                $("#spPlaca").text(row.PLACA_VEHICULO);
                $("#spColor").text(row.COLOR);
                $("#datosVehiculo").text(row.MARCA_MODELO);
                $("#datosIngreso").text(row.FECHA_INGRESO);
                $("#spKilometraje").text(row.KM_INGRESO);
                $("#spServicio").text(row.DETALLE_SERVICIO);
                $("#idServicio").val(row.ID_SERVICIO);
                $("#idServicioCotizacion").val(row.ID_SERVICIO);
            });

            var tbody = $("#tbodyListaProductos");

            tbody.empty();

            if(items == "1"){

                mostrarItemsServicio(idServicio);

            }else{

                $("#dvDescargarItems").hide();
                $("#spTotalServicio").text("0.00");
                $("#modalEditarServicio").modal("show");

            }

        }

    });

}

//Mostrar productos ya registrados del servicio
function mostrarItemsServicio(idServicio){

    var datos = new FormData();
    datos.append("accion", "mostrarDetalleServicio");
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

            var tbody = $("#tbodyListaProductos");

            tbody.empty();

            respuesta.forEach(function(servicio) {

                tbody.append(
                    '<tr>'+
                        '<td></td>'+
                        '<td>'+servicio.ITEM+'</td>'+
                        '<td align="right">'+(servicio.PRECIO_BASE).toFixed(2)+'</td>'+
                        '<td align="right">'+(servicio.UTILIDAD).toFixed(2)+'</td>'+
                        '<td align="right">'+(servicio.SUBTOTAL).toFixed(2)+'</td>'+
                        '<td align="center">'+
                            '<a href="javascript:" onclick="quitarProducto(event)"><img src="vistas/dist/img/menos.png" alt="Quitar Producto" height="21"/></a>'+
                        '</td>'+
                    '</tr>'
                );

            });

            enumerarItem();
            calcularTotal();

            $("#dvDescargarItems").show();
            $("#modalEditarServicio").modal("show");

        }

    });

}


//Agregar producto/servicio
$("#btnAgregarServicioProducto").click(function(){

    var servicioRepuesto = $("#servicioRepuesto").val();
    var textMontoBase = $("#montoBase").val();
    var textUtilidad = $("#utilidad").val();

    if(servicioRepuesto == ""){

        alert("Ingrese un servicio o producto");
        $("#servicioRepuesto").focus();
        return;

    }

    var montoBase = parseFloat(textMontoBase).toFixed(2);
    var utilidad = parseFloat(textUtilidad).toFixed(2);
    var subTotal = (parseFloat(montoBase) + parseFloat(utilidad)).toFixed(2);

    if(subTotal <= 0){

        alert("El subtotal no puede ser 0");
        $("#utilidad").focus();
        return;

    }

    $("#btnRegistrarDetalleServicio").prop('disabled', false);

    var tbody = $("#tbodyListaProductos");

    tbody.append(
        '<tr>'+
            '<td></td>'+
            '<td>'+servicioRepuesto+'</td>'+
            '<td align="right">'+montoBase+'</td>'+
            '<td align="right">'+utilidad+'</td>'+
            '<td align="right">'+subTotal+'</td>'+
            '<td align="center">'+
                '<a href="javascript:" onclick="quitarProducto(event)"><img src="vistas/dist/img/menos.png" alt="Quitar Producto" height="21"/></a>'+
            '</td>'+
        '</tr>'
    );

    $("#servicioRepuesto").val("");
    $("#montoBase").val("0");
    $("#utilidad").val("0");

    enumerarItem();
    calcularTotal();
    
    $("#servicioRepuesto").focus();
    
});

//Enumerar items de tabla productos
function enumerarItem(){
    var i=0;

    $("#tbodyListaProductos tr").each(function() {

        i++;

        $(this).find("td").eq(0).text(i);

    });
}

//Calcular total
function calcularTotal(){

    var totalBase = 0;
    var totalUtilidad = 0;
    var total = 0;

    $("#tbodyListaProductos tr").each(function() {

        var base = $(this).find("td").eq(2).text();
        var utilidad = $(this).find("td").eq(3).text();
        var subtotal = $(this).find("td").eq(4).text();

		if(subtotal != ""){
			total = total + parseFloat(subtotal);
            totalBase = totalBase + parseFloat(base);
            totalUtilidad = totalUtilidad + parseFloat(utilidad);
		}

    });

    var montoTotalBase = totalBase.toFixed(2);
    var montoTotalUtilidad = totalUtilidad.toFixed(2);
    var montoTotalVenta = total.toFixed(2);

    $("#totalBase").val(montoTotalBase);
    $("#totalUtilidad").val(montoTotalUtilidad);
    $("#spTotalServicio").text(montoTotalVenta);

}

//Quitar producto
function quitarProducto(e){

    $(e.target).closest("tr").remove();
    
	$("#servicioRepuesto").focus();

    $("#btnRegistrarDetalleServicio").prop('disabled', false);

    enumerarItem();
    calcularTotal();

}


//Registrar detalle servicio
$("#btnRegistrarDetalleServicio").click(function(){

    var idServicio = $("#idServicio").val();
    var totalBase = $("#totalBase").val();
    var totalUtilidad = $("#totalUtilidad").val();
    var totalServicio = $("#spTotalServicio").text();

    if(parseInt(totalServicio) <= 0){

        alert("Ingrese un repuesto o servicio");
        return;

    }

    $("#btnRegistrarDetalleServicio").prop('disabled', true);
    
    //Variable para almacenar la lista de productos
    var listaProductos = [];

    //Obtenemos la lista de productos (detalle)
    $("#tbodyListaProductos tr").each(function(){

        var servicioProducto = $(this).find("td").eq(1).text();
        var base = $(this).find("td").eq(2).text();
		var utilidad = $(this).find("td").eq(3).text();
        var subTotal = $(this).find("td").eq(4).text();

        listaProductos.push(
            {
                'servicioProducto': servicioProducto,
				'base': base,
                'utilidad': utilidad,
                'subTotal': subTotal
            }
        );

    });

    //Definimos toddos los datos del detalle de venta
    var datosDetalleServicio = {
        "accion": "registrarDetalleServicio",
        "idServicio": idServicio,
        "totalBase": totalBase,
        "totalUtilidad": totalUtilidad,
        "totalServicio": totalServicio,
        "listaProductos": listaProductos
    };

    //Efecto "Registrando..."
    $(this).prop("disabled", true);
    $(this).html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Registrando...');      

    $.ajax({
        url: "ajax/servicio.ajax.php",
        method: "POST",
        data: datosDetalleServicio,
        dataType: "json",
        success: function(respuesta){

            //console.log("respuesta:", respuesta);
        
            if(respuesta == "ok"){
        
                Swal.fire({
                    title: "Detalle de servicio registrado correctamente",
                    icon: "success",
                    allowOutsideClick: false,
                    confirmButtonText: "Ok"
                }).then((result) => {

                    if (result.isConfirmed) {
                        window.location = "salida";
                    }

                })

            }

            

        }

    });
    
});


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
