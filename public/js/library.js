    $(document).ready(function () {


        $('#preview').on('click', function (e) {
            e.preventDefault();
            $('#ficheiro').trigger('click');
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

        $("#ficheiro").change(function () {
            readURL(this);
        });


    });




