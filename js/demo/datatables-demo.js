// Call the dataTables jQuery plugin
$(document).ready(function() {
/*
  var espaniol={
    "sProcessing":     "Procesando...",
    "sLengthMenu":     "Mostrar _MENU_ registros",
    "sZeroRecords":    "No se encontraron resultados",
    "sEmptyTable":     "Ningún dato disponible en esta tabla",
    "sInfo":           "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
    "sInfoEmpty":      "Mostrando registros del 0 al 0 de un total de 0 registros",
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
*/
/*
  $('.sortable').sortable({
    disabled: true
  });
  $("#example2 tbody tr").draggable({
      appendTo:"body",
      helper:"clone"
  });
  $("#example2 tbody").droppable({
      activeClass:"ui-state-default",
      hoverClass:"ui-state-hover",
      accept:":not(.ui-sortable-helper)",
      drop:function (event, ui) {
          $('.placeholder').remove();
          row = ui.draggable;
          $(this).append(row);
      }
  });
*/

  //$('#dataTable').DataTable();
  /*
  var oTables=$('#dataTable').DataTable( {
  "searching": false,
  "ordering": true,
  "info":     true,
  "paging":   false,
  //"pageLength": 10,
  "language" : espaniol,
  "columnDefs": [
     { "width": "15px" },
     null,
     null,
     null,
     null,
     null,  
],

} );
*/

/*
$('#dataTable_length').hide();

var oTable=$('#example2').DataTable( {
"searching": false,
"ordering": false,
"info":     false,
"paging":   false,
"language" : espaniol
} );


$('#example2 tbody').on( 'click', 'tr', function () {
    oTable.rows().eq(0).each( function ( index ) {
      var row = oTable.row( 0 );
      var data = row.data();
      $('#txt_chofer').val(data[1]);
      $('#txt_tipo_grua').val($('#c_tipo_grua').val());
      //$('#tab-select').val('#tab02');
    } );
} );

*/



});
