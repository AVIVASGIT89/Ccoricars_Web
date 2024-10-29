//Editar marca
function editarMarca(idMarca){
    
    var datos = new FormData();
    datos.append("accion", "buscarMarca");
    datos.append("idMarca", idMarca);

    $.ajax({
        url: "ajax/marca.ajax.php",
        method: "POST",
        data: datos,
        cache: false,
        contentType: false,
        processData: false,
        dataType: "json",
        success: function(respuesta){

            //console.log("respuesta:", respuesta);

            respuesta.forEach(function(row) {                 
                $("#editarMarca").val(row.NOMBRE_MARCA);
                $("#hIdMarca").val(row.ID_MARCA);
            });

            $("#modalEditarMarca").modal("show");

        }

    });

}


//Editar modelo
function editarModelo(idModelo){
    
    var datos = new FormData();
    datos.append("accion", "buscarModelo");
    datos.append("idModelo", idModelo);

    $.ajax({
        url: "ajax/modelo.ajax.php",
        method: "POST",
        data: datos,
        cache: false,
        contentType: false,
        processData: false,
        dataType: "json",
        success: function(respuesta){

            console.log("respuesta:", respuesta);

            respuesta.forEach(function(row) {                 
                $("#editarModelo").val(row.NOMBRE_MODELO);
                $("#hIdModelo").val(row.ID_MODELO);
                $("#editarMarcaVehiculo").val(row.ID_MARCA).change();
            });

            $("#modalEditarModelo").modal("show");

        }

    });

}