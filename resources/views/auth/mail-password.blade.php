@extends('layout.auth')

@section('title', 'Restaurar password')

@section('content')
<div class="master-form">
    <div>
        <p>Restaurar palavra-chave</p>
        <p id="last-p">Após inserir o seu endereço-eletrónico e clicar no botão "Restaurar", aceda ao seu e-mail para mais informações.</p>
        <div>
            <form id="form" method="post">
                <div>
                    <div>
                        <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" autofocus required placeholder="Endereço eletrónico">
                    </div>
                </div>
                <br>
                <div class="collapse" id="collapse">
                    <div class="card card-body" id="collapse-card">
                        <p id="collapse-p">Para efeitos de confirmação, insira, por favor, os três últimos dígitos do seu número de telemóvel.</p>
                        <div id="js-form">

                        </div>
                    </div>
                </div>
                <div>
                    <div>
                        <button type="submit" class="btn submit-button" id="submit-button">
                            {{ __('Confirmar') }}
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

@section('scripts')
<script type="text/javascript">
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': "{{csrf_token()}}"
        }
    });

    $('#form').submit(function(event) {
        event.preventDefault();
        info = {
            email: $("#email").val()
        };
        $.ajax({
            type: "post",
            url: "{{route('check.email')}}",
            context: this,
            data: info,
            success: function(data) {
                if ($('#error').text() != '') {
                    $('#error').css("display", "none");
                }
                user = JSON.parse(data);

                phone = user.telefone1,
                    completeNumber = [],
                    phoneNumber = phone.toString();

                for (var i = 0, len = phoneNumber.length; i < len; i += 1) {
                    completeNumber.push(+phoneNumber.charAt(i));
                }

                for (var i = 0; i < 3; i++) {
                    completeNumber.pop();
                }

                form = "<form style='padding: 0px;' id='form2'> <label id='label-code'></label> <div id='code' type='text' class='form-control' name='code' required style='width:100%;'><input type=text id='fake-input' maxlength='3' autocomplete='off'> </div> <button type='submit' class='submit-button' id='submit-button2'>Recuperar</button> </form>";
                $('#js-form').append(form);
                $('#label-code').append(completeNumber.join(''));
                $('#code').after("<br>");
                $('#collapse').show();
                $('#submit-button').css("display", "none");
            },
            error: function() {
                if ($('#error').text() != '') {
                    $('#error').css("display", "none");
                }
                $('#collapse').hide();
                $('#form2').css("display", "none");
                $('#submit-button').css("display", "block");
                error = "<strong id='error'>O e-mail que introduziu não está registado no sistema, ou não está ativo.</strong>";
                $('#last-p').after(error);
            }
        });
    });

    $('#form2').submit(function(event) {
        event.preventDefault();
        $.ajax({
            type: "post",
            url: "{{route('check.test')}}",
            context: this,
            data: 'hey',
            success: function() {
                console.log('Ok');
            }
        });
    });
</script>
@endsection
@endsection
