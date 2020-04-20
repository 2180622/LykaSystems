$(document).ready(function() {

    var table = $('#dataTable').DataTable({

        "columnDefs": [{
                "orderable": false,
                "width": "60px",
                "targets": 0
            },
            {
                "orderable": false,
                "targets": 2
            },
            {
                "orderable": false,
                "width": "130px",
                "targets": 3
            },
        ],

        "language": {
            "lengthMenu": "Mostrar _MENU_ por página",
            "search": "Procurar",
            "zeroRecords": "Sem registos",
            "paginate": {
                "first": "Primeiro",
                "last": "Ultimo",
                "next": "Proximo",
                "previous": "Anterior"
            },

            "info": "",
            "infoEmpty": "",
            "infoFiltered": ""
        },

        "order": [1, 'desc'],

        /* "bLengthChange": false, */
        /* "bFilter": false, */

    });

    $(".dataTables_filter").hide();
    $("#customSearchBox").on('keyup', function() {
        $(".dataTables_filter input").val($("#customSearchBox").val())
        table.search($(".dataTables_filter input").val()).draw();
    });


    $('.dataTables_length').hide();
    $('#records_per_page').val(table.page.len());
    $('#records_per_page').change(function() {
        table.page.len($(this).val()).draw();
    });

    $('*[data-href]').click(function(){
        window.location = $(this).data('href');
        return false;
    });
});
