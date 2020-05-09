    $(document).ready(function () {

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







        /* Definir paisNaturalidade */
        var str_paisNaturalidade = $("#hidden_paisNaturalidade").val();
        $('#paisNaturalidade').val(str_paisNaturalidade);


        /* Definir passaportePaisEmi */
        var str_passaportePaisEmi = $("#hidden_passaportePaisEmi").val();
        $('#passaportePaisEmi').val(str_passaportePaisEmi);





        //Preview da fotografia++++++++++++++++++
        /*         $('#search_btn').on('click', function (e) {
                    e.preventDefault();
                    $('#fotografia').trigger('click');
                }); */


        $('#preview').on('click', function (e) {
            e.preventDefault();
            $('#fotografia').trigger('click');
        });

        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    $('#preview').attr('src', e.target.result);
                }

                reader.readAsDataURL(input.files[0]);
            }
        }

        $("#fotografia").change(function () {
            readURL(this);
        });




        //Preview do DOCUMENTO DE IDENTIFICAÇÃO+++++++++++++++

        $('#doc_id_preview_file').on('click', function (e) {
            e.preventDefault();
            $('#img_docOficial').trigger('click');
        });

        $('#doc_id_preview').on('click', function (e) {
            e.preventDefault();
            $('#img_docOficial').trigger('click');
        });


        function readDocImgURL(input) {
            if (input.files && input.files[0]) {
                var iddocumento = new FileReader();
                iddocumento.onload = function (e) {
                    iddocumento.fileName = img_docOficial.name;
                    $('#name_doc_id_file').text(input.files[0].name);
                }

                iddocumento.readAsDataURL(input.files[0]);
            }
        }

        $("#img_docOficial").change(function () {
            readDocImgURL(this);
            $('#doc_id_preview_file').hide();
            $('#doc_id_preview').show();

        });





        //Preview do Passaporte +++++++++++++++

        /*         $('#passport_preview_file').on('click', function (e) {
                    e.preventDefault();
                    $('#img_Passaporte').trigger('click');
                });

                $('#passport_preview').on('click', function (e) {
                    e.preventDefault();
                    $('#img_Passaporte').trigger('click');
                });

                function readPassaporteURL(input) {
                    if (input.files && input.files[0]) {
                        var passaporte = new FileReader();

                        passaporte.onload = function (e) {
                            $('#name_passaporte_file').text(input.files[0].name);
                        }

                        passaporte.readAsDataURL(input.files[0]);
                    }
                }

                $("#img_Passaporte").change(function () {
                    readPassaporteURL(this);
                    $('#passport_preview_file').hide();
                    $('#passport_preview').show();

                }); */










        /* OPÇÃO DE APAGAR */
        var formToSubmit //Variavel para indicar o forumulário a submeter

        $(".form_client_id").submit(function (e) {
            e.preventDefault();
            formToSubmit = this;
            $("#student_name").text($(this).attr("data"));
            return false;
        });

        //click sim na modal
        $(".btn_submit").click(function (e) {
            formToSubmit.submit();
        });






        /* VALIDAÇÃO DE INPUTS */

        if ($('#nome').length) {

            /* Apenas letras:  .lettersOnly();  */
            $("#nome").lettersOnly();
            $("#apelido").lettersOnly();
            $("#cidadeInstituicaoOrigem").lettersOnly();
            $("#nomePai").lettersOnly();
            $("#nomeMae").lettersOnly();
            $("#localEmissaoPP").lettersOnly();

            /* Apenas numeros:  .numbersOnly();  */
            $("#telefone1").numbersOnly();
            $("#telefone2").numbersOnly();
            $("#telefonePai").numbersOnly();
            $("#telefoneMae").numbersOnly();
            /*             $("#num_docOficial").numbersOnly();
                        $("#numPassaporte").numbersOnly();
                        $("#IBAN").numbersOnly(); */
            $("#NIF").numbersOnly();

        }


        /* VALIDAÇÃO DO FORMULÁRIO */

        // Example starter JavaScript for disabling form submissions if there are invalid fields
        (function () {
            'use strict';
            window.addEventListener('load', function () {
                // Fetch all the forms we want to apply custom Bootstrap validation styles to
                var forms = document.getElementsByClassName('needs-validation');
                // Loop over them and prevent submission
                var validation = Array.prototype.filter.call(forms, function (form) {
                    form.addEventListener('submit', function (event) {

                        /* mostrar div de espera */
                        $("#wait_screen").show();





                        if (form.checkValidity() === false) {
                            event.preventDefault();
                            event.stopPropagation();



                            /* valida Campos da informação pessoal */
                            if (($("#nome").val() == "") || ($("#apelido").val() == "") || ($("#genero").val() == "") || ($("#paisNaturalidade").val() == "") || ($("#dataNasc").val() == "")) {
                                $("#wait_screen").hide();
                                $("#pessoal-tab").addClass("border-danger text-danger");
                                $("#warning_msg").show();
                            } else {
                                $("#pessoal-tab").removeClass("border-danger text-danger");
                            }


                            /* valida Campos dos documentos */
                            if (($("#num_docOficial").val() == "") || ($("#num_passaporte").val() == "")) {
                                $("#wait_screen").hide();
                                $("#documentation-tab").addClass("border-danger text-danger");
                                $("#warning_msg").show();
                            } else {
                                $("#documentation-tab").removeClass("border-danger text-danger");

                            }

                            /* valida Campos dos dados académicos */
                            /*if (($("#nivEstudoAtual").val() == "") ) {
                                $("#wait_screen").hide();
                                $("#academicos-tab").addClass("border-danger text-danger");
                                $("#warning_msg").show();
                            } else {
                                $("#academicos-tab").removeClass("border-danger text-danger");
                            } */



                            /* valida Campos dos contactos */
                            if (($("#telefone1").val() == "") || ($("#email").val() == "")) {
                                $("#wait_screen").hide();
                                $("#contacts-tab").addClass("border-danger text-danger");
                                $("#warning_msg").show();
                            } else {
                                $("#contacts-tab").removeClass("border-danger text-danger");

                            }


                            /* valida Campos das moradas */
                            /*if (($("#moradaResidencia").val() == "") || ($("#morada").val() == "") || ($("#cidade").val() == "")) {
                                $("#wait_screen").hide();
                                $("#contacts-tab").addClass("border-danger text-danger");
                                $("#warning_msg").show();
                            } else {
                                $("#contacts-tab").removeClass("border-danger text-danger");
                            } */



                            /* valida Campos das finanças */
                            /*if ($("#IBAN").val() == "") {
                                $("#wait_screen").hide();
                                $("#financas-tab").addClass("border-danger text-danger");
                                $("#warning_msg").show();
                            } else {
                                $("#financas-tab").removeClass("border-danger text-danger");
                            } */

                            /* Valida se tem agente associado */

                            if ( $('#idAgente').val() == "0"){
                                $("#wait_screen").hide();
                                $("#div_agente").addClass("border border-danger text-danger ");
                                $("#idAgente").removeClass("is-valid");
                                $("#idAgente").addClass("is-invalid");
                                $("#idAgente").css("background-image", "none");
                                $("#warning_msg").show();


                            }else{
                                $("#div_agente").removeClass("border-danger text-danger");
                            }



                        }
                        window.scrollTo(0, 0);
                        form.classList.add('was-validated');
                    }, false);
                });
            }, false);
        })();







    });
