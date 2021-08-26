$(document).ready(function() {
    $('#tableBandeja').DataTable({
        pageLength: 10,
        searching: false,
        scrollX: true,
        scrollCollapse: true,
        paging: true,
        fixedColumns: {
            leftColumns: 0,
            rightColumns: 2,
        },
        language: {
            "sProcessing": "",
            "sLengthMenu": "",
            "sZeroRecords": "",
            "sEmptyTable": "",
            "sInfo": "Mostrando  _START_ al _END_ de  _TOTAL_ registros",
            "sInfoEmpty": "Mostrando registros del 0 al 0 de un total de 0 registros",
            "sInfoFiltered": "",
            "sInfoPostFix": "",
            "sSearch": "Búsqueda",
            "sUrl": "",
            "sInfoThousands": ",",
            "sLoadingRecords": "",
            "oPaginate": {
                "sFirst": "Primero",
                "sLast": "Último",
                "sNext": "Siguiente",
                "sPrevious": "Anterior"
            }
        },
    });
    $('#tableLeads').DataTable({
        pageLength: 10,
        searching: false,
        scrollX: true,
        scrollCollapse: true,
        paging: true,
        fixedColumns: {
            leftColumns: 0,
            rightColumns: 3,
        },
        columnDefs: [
            { "width": "25%", "targets": 14 }
        ],
        language: {
            "sProcessing": "",
            "sLengthMenu": "",
            "sZeroRecords": "",
            "sEmptyTable": "",
            "sInfo": "Mostrando  _START_ al _END_ de  _TOTAL_ registros",
            "sInfoEmpty": "Mostrando registros del 0 al 0 de un total de 0 registros",
            "sInfoFiltered": "",
            "sInfoPostFix": "",
            "sSearch": "Búsqueda",
            "sUrl": "",
            "sInfoThousands": ",",
            "sLoadingRecords": "",
            "oPaginate": {
                "sFirst": "Primero",
                "sLast": "Último",
                "sNext": "Siguiente",
                "sPrevious": "Anterior"
            }
        },
    });
    $('#tableClients').DataTable({
        pageLength: 10,
        searching: false,
        scrollX: true,
        scrollCollapse: true,
        paging: true,
        language: {
            "sProcessing": "",
            "sLengthMenu": "",
            "sZeroRecords": "",
            "sEmptyTable": "",
            "sInfo": "Mostrando  _START_ al _END_ de  _TOTAL_ registros",
            "sInfoEmpty": "Mostrando registros del 0 al 0 de un total de 0 registros",
            "sInfoFiltered": "",
            "sInfoPostFix": "",
            "sSearch": "Búsqueda",
            "sUrl": "",
            "sInfoThousands": ",",
            "sLoadingRecords": "",
            "oPaginate": {
                "sFirst": "Primero",
                "sLast": "Último",
                "sNext": "Siguiente",
                "sPrevious": "Anterior"
            }
        },
    });
    $('#test_table').DataTable();
    $('#tableUser').DataTable({
        pageLength: 10,
        searching: false,
        scrollX: true,
        scrollCollapse: true,
        paging: true,
        fixedColumns: {
            leftColumns: 0,
            rightColumns: 1,
        },
        language: {
            "sProcessing": "",
            "sLengthMenu": "",
            "sZeroRecords": "",
            "sEmptyTable": "",
            "sInfo": "Mostrando  _START_ al _END_ de  _TOTAL_ registros",
            "sInfoEmpty": "Mostrando registros del 0 al 0 de un total de 0 registros",
            "sInfoFiltered": "",
            "sInfoPostFix": "",
            "sSearch": "Búsqueda",
            "sUrl": "",
            "sInfoThousands": ",",
            "sLoadingRecords": "",
            "oPaginate": {
                "sFirst": "Primero",
                "sLast": "Último",
                "sNext": "Siguiente",
                "sPrevious": "Anterior"
            }
        },
    });
    $('#tableMetrica').DataTable({
        pageLength: 10,
        searching: false,
        scrollX: true,
        scrollCollapse: true,
        paging: true,
        language: {
            "sProcessing": "",
            "sLengthMenu": "",
            "sZeroRecords": "",
            "sEmptyTable": "",
            "sInfo": "Mostrando  _START_ al _END_ de  _TOTAL_ registros",
            "sInfoEmpty": "Mostrando registros del 0 al 0 de un total de 0 registros",
            "sInfoFiltered": "",
            "sInfoPostFix": "",
            "sSearch": "Búsqueda",
            "sUrl": "",
            "sInfoThousands": ",",
            "sLoadingRecords": "",
            "oPaginate": {
                "sFirst": "Primero",
                "sLast": "Último",
                "sNext": "Siguiente",
                "sPrevious": "Anterior"
            }
        },
    });
    $('#tableProfile').DataTable({
        pageLength: 10,
        searching: false,
        scrollX: true,
        scrollCollapse: true,
        paging: true,
        columnDefs: [
            { "width": "25%", "targets": 4 }
        ],
        language: {
            "sProcessing": "",
            "sLengthMenu": "",
            "sZeroRecords": "",
            "sEmptyTable": "",
            "sInfo": "Mostrando  _START_ al _END_ de  _TOTAL_ registros",
            "sInfoEmpty": "Mostrando registros del 0 al 0 de un total de 0 registros",
            "sInfoFiltered": "",
            "sInfoPostFix": "",
            "sSearch": "Búsqueda",
            "sUrl": "",
            "sInfoThousands": ",",
            "sLoadingRecords": "",
            "oPaginate": {
                "sFirst": "Primero",
                "sLast": "Último",
                "sNext": "Siguiente",
                "sPrevious": "Anterior"
            }
        },
    });
    $('#tableDetalleLead').DataTable({
        pageLength: 10,
        searching: false,
        scrollX: true,
        scrollCollapse: true,
        paging: true,
        fixedColumns: {
            leftColumns: 0,
            rightColumns: 1,
        },
        columnDefs: [
            { "width": "25%", "targets": 0 },
            { "width": "25%", "targets": 1 },
            { "width": "25%", "targets": 2 }
        ],
        language: {
            "sProcessing": "",
            "sLengthMenu": "",
            "sZeroRecords": "",
            "sEmptyTable": "",
            "sInfo": "Mostrando  _START_ al _END_ de  _TOTAL_ registros",
            "sInfoEmpty": "Mostrando registros del 0 al 0 de un total de 0 registros",
            "sInfoFiltered": "",
            "sInfoPostFix": "",
            "sSearch": "Búsqueda",
            "sUrl": "",
            "sInfoThousands": ",",
            "sLoadingRecords": "",
            "oPaginate": {
                "sFirst": "Primero",
                "sLast": "Último",
                "sNext": "Siguiente",
                "sPrevious": "Anterior"
            }
        },
    });
    $('#polizasCliente').DataTable({
        pageLength: 10,
        searching: false,
        scrollX: true,
        scrollCollapse: true,
        paging: true,
        fixedColumns: {
            leftColumns: 0,
            rightColumns: 1,
        },
        columnDefs: [
            { "width": "15%", "targets": 4 }
        ],
        language: {
            "sProcessing": "",
            "sLengthMenu": "",
            "sZeroRecords": "",
            "sEmptyTable": "",
            "sInfo": "Mostrando  _START_ al _END_ de  _TOTAL_ registros",
            "sInfoEmpty": "Mostrando registros del 0 al 0 de un total de 0 registros",
            "sInfoFiltered": "",
            "sInfoPostFix": "",
            "sSearch": "Búsqueda",
            "sUrl": "",
            "sInfoThousands": ",",
            "sLoadingRecords": "",
            "oPaginate": {
                "sFirst": "Primero",
                "sLast": "Último",
                "sNext": "Siguiente",
                "sPrevious": "Anterior"
            }
        },
    });
    $('#actividadProfile').DataTable({
        pageLength: 10,
        searching: false,
        scrollX: true,
        scrollCollapse: true,
        paging: true,
        columnDefs: [
            { "width": "2%", "targets": 0 },
            { "width": "2%", "targets": 1 },
            { "width": "2%", "targets": 2 },
            { "width": "2%", "targets": 3 },
            { "width": "2%", "targets": 4 }
        ],
        language: {
            "sProcessing": "",
            "sLengthMenu": "",
            "sZeroRecords": "",
            "sEmptyTable": "",
            "sInfo": "Mostrando  _START_ al _END_ de  _TOTAL_ registros",
            "sInfoEmpty": "Mostrando registros del 0 al 0 de un total de 0 registros",
            "sInfoFiltered": "",
            "sInfoPostFix": "",
            "sSearch": "Búsqueda",
            "sUrl": "",
            "sInfoThousands": ",",
            "sLoadingRecords": "",
            "oPaginate": {
                "sFirst": "Primero",
                "sLast": "Último",
                "sNext": "Siguiente",
                "sPrevious": "Anterior"
            }
        },
    });
    $('#tableVentas').DataTable({
        pageLength: 10,
        searching: false,
        scrollX: true,
        scrollCollapse: true,
        paging: true,
        fixedColumns: {
            leftColumns: 0,
            rightColumns: 1,
        },
        language: {
            "sProcessing": "",
            "sLengthMenu": "",
            "sZeroRecords": "",
            "sEmptyTable": "",
            "sInfo": "Mostrando  _START_ al _END_ de  _TOTAL_ registros",
            "sInfoEmpty": "Mostrando registros del 0 al 0 de un total de 0 registros",
            "sInfoFiltered": "",
            "sInfoPostFix": "",
            "sSearch": "Búsqueda",
            "sUrl": "",
            "sInfoThousands": ",",
            "sLoadingRecords": "",
            "oPaginate": {
                "sFirst": "Primero",
                "sLast": "Último",
                "sNext": "Siguiente",
                "sPrevious": "Anterior"
            }
        },
    });
    $('#tableInter').DataTable({
        pageLength: 10,
        searching: false,
        scrollX: true,
        scrollCollapse: true,
        paging: true,
        fixedColumns: {
            leftColumns: 0,
            rightColumns: 1,
        },
        language: {
            "sProcessing": "",
            "sLengthMenu": "",
            "sZeroRecords": "",
            "sEmptyTable": "",
            "sInfo": "Mostrando  _START_ al _END_ de  _TOTAL_ registros",
            "sInfoEmpty": "Mostrando registros del 0 al 0 de un total de 0 registros",
            "sInfoFiltered": "",
            "sInfoPostFix": "",
            "sSearch": "Búsqueda",
            "sUrl": "",
            "sInfoThousands": ",",
            "sLoadingRecords": "",
            "oPaginate": {
                "sFirst": "Primero",
                "sLast": "Último",
                "sNext": "Siguiente",
                "sPrevious": "Anterior"
            }
        },
    });
    $('input[name="daterange"]').daterangepicker({
        "locale": {
            "format": "DD/MM/YYYY",
            "separator": " - ",
            "applyLabel": "Aplicar",
            "cancelLabel": "Cancelar",
            "fromLabel": "Desde",
            "toLabel": "Hasta",
            "customRangeLabel": "Custom",
            "daysOfWeek": [
                "Dom",
                "Lun",
                "Mar",
                "Mie",
                "Jue",
                "Vie",
                "Sab"
            ],
            "monthNames": [
                "Enero",
                "Febrero",
                "Marzo",
                "Abril",
                "Mayo",
                "Junio",
                "Julio",
                "Agosto",
                "Septiembre",
                "Octubre",
                "Noviembre",
                "Diciembre"
            ],
            "firstDay": 1
        }
    });
    $(function() {
        var start = moment().subtract(29, 'days');
        var end = moment();

        function cb(start, end) {
            $('#reportrange span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
        }
        $('#reportrange').daterangepicker({
            startDate: start,
            endDate: end,
            ranges: {
                'Hoy': [moment(), moment()]
            },
        }, cb);
        cb(start, end);
    });
});

// window.onload = function() {
//     element = document.getElementsByClassName('ranges');
//     if (typeof(element) != 'undefined' && element != null) {
//         document.querySelector('.ranges').children[0].children[0].classList.add('active');
//         document.querySelector('.ranges').children[0].children[1].setAttribute('hidden', true);
//     }
// }