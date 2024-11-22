//Setear DataTable a tablas con la clase "DataTable"
$(".dataTable").DataTable({
                            "responsive": true, 
                            "lengthChange": false, 
                            "autoWidth": false,
                            "language": {

                                "sProcessing":     "Procesando...",
                                "sLengthMenu":     "Mostrar _MENU_ registros",
                                "sZeroRecords":    "No se encontraron resultados",
                                "sEmptyTable":     "Ningún dato disponible en esta tabla",
                                "sInfo":           "Mostrando registros del _START_ al _END_ de un total de _TOTAL_",
                                "sInfoEmpty":      "Mostrando registros del 0 al 0 de un total de 0",
                                "sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
                                "sInfoPostFix":    "",
                                "sSearch":         "Buscar:",
                                "sUrl":            "",
                                "sInfoThousands":  ",",
                                "sLoadingRecords": "Cargando...",
                                "oPaginate": {
                                "sFirst":    "Primero",
                                "sLast":     "Último",
                                "sNext":     "Siguiente",
                                "sPrevious": "Anterior"
                                },
                                "oAria": {
                                    "sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
                                    "sSortDescending": ": Activar para ordenar la columna de manera descendente"
                                }
                        
                            }

                          }
);


//DataTable con boton de descarga en Excel
$("#example1").DataTable({
    "responsive": true, "lengthChange": false, "autoWidth": false,
    "buttons": ["excel"],
    "language": {

        "sProcessing":     "Procesando...",
        "sLengthMenu":     "Mostrar _MENU_ registros",
        "sZeroRecords":    "No se encontraron resultados",
        "sEmptyTable":     "Ningún dato disponible en esta tabla",
        "sInfo":           "Mostrando registros del _START_ al _END_ de un total de _TOTAL_",
        "sInfoEmpty":      "Mostrando registros del 0 al 0 de un total de 0",
        "sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
        "sInfoPostFix":    "",
        "sSearch":         "Buscar:",
        "sUrl":            "",
        "sInfoThousands":  ",",
        "sLoadingRecords": "Cargando...",
        "oPaginate": {
        "sFirst":    "Primero",
        "sLast":     "Último",
        "sNext":     "Siguiente",
        "sPrevious": "Anterior"
        },
        "oAria": {
            "sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
            "sSortDescending": ": Activar para ordenar la columna de manera descendente"
        }

    }
}).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');


//Setear hora actual a input con value "now"
$(function(){     
var d = new Date(),        
    h = d.getHours(),
    m = d.getMinutes();
if(h < 10) h = '0' + h; 
if(m < 10) m = '0' + m; 
$('input[type="time"][value="now"]').each(function(){ 
    $(this).attr({'value': h + ':' + m});
});
});



///******************** Codigo para activar item del manu dinamicamente
var url = window.location;
// for sidebar menu entirely but not cover treeview
$('ul.nav-sidebar a').filter(function() {
    if (this.href) {
        return this.href == url || url.href.indexOf(this.href) == 0;
    }
}).addClass('active');

// for the treeview
$('ul.nav-treeview a').filter(function() {
    if (this.href) {
        return this.href == url || url.href.indexOf(this.href) == 0;
    }
}).parentsUntil(".nav-sidebar > .nav-treeview").addClass('menu-open').prev('a').addClass('active');


//--------------------- Validacion para Ingresar solo Numero y Letras sin "Ñ-ñ" --------------------------------
function numletras(e) { // 1
	tecla = (document.all) ? e.keyCode : e.which; // 2
	if (tecla==8) return true; // 3
	patron =/^([a-z]|[A-Z]|[0-9])+$/; // 4  - patron =/^([a-z]|[A-Z]|[0-9]|-|\s|ñ)+$/;
	te = String.fromCharCode(tecla); // 5
	return patron.test(te); // 6
}


//******************** Funcion para efecto Cargando... ********************
function configureLoadingScreen(screen){
    $(document)
        .ajaxStart(function () {
            screen.fadeIn();
        })
        .ajaxStop(function () {
            screen.fadeOut();
        });
}