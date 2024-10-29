//Grafico lineas
var getLineaServiciosMes = document.getElementById("lineaServiciosMes");
var lineaServiciosMes = new Chart(getLineaServiciosMes, {
    type : 'line',
    plugins: [ChartDataLabels],
    data : {
        labels: ['Enero'],
        datasets : [
                {
                    data: [0],
                    label : "Servicios",
                    borderColor : "rgb(54, 162, 235)",
                    fill : false
                }]
    },
    options : {
        scales: {
            y: {
                beginAtZero: true
            }
        },
        plugins:{
            legend:{
                display:false
            },
            title: {
                display: true,
                text: 'Servicios 6 ultimos meses'
            },
            datalabels: {
                align: 'top'
            }
        }
    }
});


//Mostrar indicadores en pantalla inicio
function mostrarIndicadores(){
    
    var datos = new FormData();
    datos.append("accion", "listarIndicadores");

    //Cargar datos de indicadores de mes
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
                $("#totalServicios").text(row.CANTIDAD_SERVICIO);
                $("#totalFinalizados").text(row.SERVICIOS_FINALIZADO);
                $("#totalPendientes").text(row.SERVICIOS_PENDIENTE);
                $("#totalAnulados").text(row.SERVICIOS_ANULADOS);
            });
    
        }

    });


    //Cargar datos de grafico lineas
    var datos1 = new FormData();
    datos1.append("accion", "listarSer6UltMeses");

    $.ajax({
        url: "ajax/servicio.ajax.php",
        method: "POST",
        data: datos1,
        cache: false,
        contentType: false,
        processData: false,
        dataType: "json",
        success: function(respuesta){

            //console.log("respuesta:", respuesta);

            var nombreMes = [];
            var serviciosMes = [];

            respuesta.forEach(function(row) {                 
                nombreMes.push(row.NOMBRE_MES);
				serviciosMes.push(row.SERVICIOS_MES);
            });

            lineaServiciosMes.data.labels = nombreMes;
            lineaServiciosMes.data.datasets.forEach((dataset) => {
                dataset.data = serviciosMes;
            });

            lineaServiciosMes.update();
    
        }

    });

}
