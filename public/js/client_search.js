    $(document).ready(function () {


        var table = $('#dataTable').DataTable({

            "pageLength": 100,

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



        $('#searchfields div:not(#divPaisOrigem)').hide();

        $('#search_options').on('change', function() {


                /* Pais de origem */
                if($('#search_options').val()=="País de origem" ){
                    $('#searchfields div:not(#divPaisOrigem)').hide();
                    $("#divPaisOrigem").show();
                }

                /* Cidade de origem */
                if($('#search_options').val()=="Cidade de origem" ){
                    $('#searchfields div:not(#divCidade)').hide();
                    $("#divCidade").show();
                }

                /* Instituição de origem */
                if($('#search_options').val()=="Instituição de origem" ){
                    $('#searchfields div:not(#divInstituicaoOrigem)').hide();
                    $("#divInstituicaoOrigem").show();
                }

                /* Agente */
                if($('#search_options').val()=="Agente" ){
                    $('#searchfields div:not(#divAgents)').hide();
                    $("#divAgents").show();
                }

                /* Universidade */
                if($('#search_options').val()=="Universidade" ){
                    $('#searchfields div:not(#divUniversidades)').hide();
                    $("#divUniversidades").show();
                }


                /* Nível de estudos */
                if($('#search_options').val()=="Nível de estudos" ){
                    $('#searchfields div:not(#divNivelEstudos)').hide();
                    $("#divNivelEstudos").show();
                }


                /* Estado de cliente */
                if($('#search_options').val()=="Estado de cliente" ){
                    $('#searchfields div:not(#divEstadoCliente)').hide();
                    $("#divEstadoCliente").show();
                }


        });







        $('#test_link').click(function(){

            var cidade = $('#cidade').val();
            let url = "{{ route('clients.searchResults'," + cidade +") }}";
/*             url = url.replace(':cidade', cidade); */
            /* alert(url); */
             document.location.href=url;
        });




    });
