    $(document).ready(function () {





        $('#test_link').click(function(){

            var cidade = $('#cidade').val();

            window.location.href = "{{ route('clients.index',cidade)}}";

        });




    });
