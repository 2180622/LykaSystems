    $(document).ready(function () {



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
