//Reporte General, verificar que la diferencia de dias no sea mayor a 30
$(function(){
    $("#frmReporteGeneral").submit(function(e) {
        
        var fechaDesde = new Date($("#fechaDesde").val());
        var fechaHasta = new Date($("#fechaHasta").val());

        var diasDiferencia = (fechaHasta - fechaDesde)/(1000*60*60*24);

        if(diasDiferencia > 30){

            alert("La diferencia de fechas No debe ser mayor a 30 dias");
            return false;

        }

    });
});


//Detalle servicio
$(document).on("click", ".detalleServicio", function(){

    var idServicio = $(this).attr("idServicio");

    mostrarItemsServicio(idServicio);

    var datos = new FormData();
    datos.append("accion", "mostrarDetalleServicio");
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

            var i = 0;

            var tbody = $("#tbodyDetalleServicio");

            tbody.empty();

            respuesta.forEach(function(servicio) {

                i++;

                tbody.append(
                    '<tr>'+
                        '<td>'+i+'</td>'+
                        '<td>'+servicio.ITEM+'</td>'+
                        '<td align="right">'+(servicio.PRECIO_BASE).toFixed(2)+'</td>'+
                        '<td align="right">'+(servicio.UTILIDAD).toFixed(2)+'</td>'+
                        '<td align="right">'+(servicio.SUBTOTAL).toFixed(2)+'</td>'+
                    '</tr>'
                );

            });

        }

    });

    $("#modal-servicio-detalle").modal("show");
    
});