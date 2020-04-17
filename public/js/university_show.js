$(document).ready(function () {

    var table = $('#dataTable').DataTable({

        "columnDefs": [{
                "orderable": false,
                "width": "10px",
                "targets": 0
            },
            {
                "orderable": false,
                "width": "130px",
                "targets": 4
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

    $(".dataTables_filter").hide(); // Esconde o input search por defeito
    $("#customSearchBox").on('keyup', function () {
        $(".dataTables_filter input").val($("#customSearchBox").val())
        table.search($(".dataTables_filter input").val()).draw();
    });


    $('.dataTables_length').hide(); // Esconde o select "rows per page" por defeito
    $('#records_per_page').val(table.page.len());
    $('#records_per_page').change(function () {
        table.page.len($(this).val()).draw();
    });


    /* FIM configs DATATABLES */



    /* OPÇÃO DE APAGAR */
/*     var formToSubmit //Variavel para indicar o forumulário a submeter

    $(".form_university_id").submit(function (e) {
        e.preventDefault();
        formToSubmit = this;
        $("#tituloUniversidade").text($(this).attr("data"));
        return false;
    });

    //click sim na modal
    $(".btn_submit").click(function (e) {
        formToSubmit.submit();
    });

 */


});
