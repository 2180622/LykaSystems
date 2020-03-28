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





        /* Definir pais */
        var str_pais = $("#hidden_pais").val();
        $('#pais').val(str_pais);



        //Preview da fotografia

        $('#search_btn').on('click', function (e) {
            e.preventDefault();
            $('#fotografia').trigger('click');
        });

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




        /* OPÇÃO DE APAGAR */
        var formToSubmit //Variavel para indicar o forumulário a submeter

        $(".form_agent_id").submit(function (e) {
            formToSubmit = this;
            return false;
        });

        //click sim na modal
        $(".btn_submit").click(function (e) {
            formToSubmit.submit();
        });






        /* VALIDAÇÃO DE INPUTS */

        /* Apenas letras:  .lettersOnly();  */
        $("#nome").lettersOnly();
        $("#apelido").lettersOnly();




        /* Apenas numeros:  .numbersOnly();  */
        $("#telefoneW").numbersOnly();
        $("#telefone2").numbersOnly();
        $("#NIF").numbersOnly();




        /* VALIDAÇÃO DO FORMULÁRIO */
        (function() {
            'use strict';
            window.addEventListener('load', function() {
              // Fetch all the forms we want to apply custom Bootstrap validation styles to
              var forms = document.getElementsByClassName('needs-validation');
              // Loop over them and prevent submission
              var validation = Array.prototype.filter.call(forms, function(form) {
                form.addEventListener('submit', function(event) {
                  if (form.checkValidity() === false) {
                    event.preventDefault();
                    event.stopPropagation();
                  }
                  form.classList.add('was-validated');
                }, false);
              });
            }, false);
          })();



          
    });




