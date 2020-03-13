$(document).ready(function() {
    
    var table = $('#dataTable').DataTable( {

        "columnDefs": [
            { "orderable": false, "targets": 0 },
            { "orderable": false, "targets": 2 },
            { "orderable": false, "targets": 4 },
            { "width": "60px", "targets": 0 },
            { "width": "auto", "targets": 1 },
            { "width": "auto", "targets": 2 },
            { "width": "auto", "targets": 3 },
            { "width": "130px", "targets": 4 },
        ],


        "language": {
            "lengthMenu":  "Mostrar _MENU_ por página",
            "search":      "Procurar",
            "zeroRecords": "Sem registos",
            "paginate": {
                "first":      "Primeiro",
                "last":       "Ultimo",
                "next":       "Proximo",
                "previous":   "Anterior"
            },

            "info": "",
            "infoEmpty": "",
            "infoFiltered": ""
        },

        "order": [1, 'desc'],

        /* "bLengthChange": false, */
        /* "bFilter": false, */

    } );

    $(".dataTables_filter").hide(); // Esconde o input search por defeito
    $("#customSearchBox").on( 'keyup', function () {
        $(".dataTables_filter input").val( $("#customSearchBox").val() )
        table.search( $(".dataTables_filter input").val() ).draw();
    } );

    $('.dataTables_length').hide(); // Esconde o select "rows per page" por defeito
    $('#records_per_page').val(table.page.len());
    $('#records_per_page').change( function() {
        table.page.len( $(this).val() ).draw();
    });
});

$(function () {
    $('input[type=text], textarea').keyup();
});
