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
                <div>
                    <div>
                        <button type="submit" class="btn submit-button" id="submit-button">
                            {{ __('Confirmar') }}
                        </button>
                    </div>
                </div>
            </form>
            <div class="collapse" id="collapse">
                <div class="card card-body" id="collapse-card">
                    <p id="collapse-p">Para efeitos de confirmação, insira, por favor, os três últimos dígitos do seu número de telemóvel.</p>
                    <div id="js-form">
                        <form id="form-code" method="post">
                            <input id="emailcode" type="text" name="emailcode" hidden>
                            <input id="phonecode" type="text" name="phonecode" hidden>
                        </form>
                    </div>
                </div>
            </div>
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

                form = "<label id='label-code'></label> <div id='code' class='form-control' style='width:100%;'><input name='code' type=text id='code-input' maxlength='3' autocomplete='off' required> </div> <button type='submit' class='submit-button' id='submit-button2'>Recuperar</button>";
                $('#form-code').append(form);
                $('#form-code').css("display", "block");
                $('#emailcode').attr("value", user.email);
                $('#phonecode').attr("value", user.telefone1);
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
                $('#form-code').css("display", "none");
                $('#submit-button').css("display", "block");
                error = "<strong id='error'>O e-mail que introduziu não está registado no sistema, ou não está ativo.</strong>";
                $('#last-p').after(error);
            }
        });
    });

    $('#form-code').submit(function(event) {
        event.preventDefault();
        info = {
            code: $("#code-input").val(),
            email: $("#emailcode").val(),
            phone: $("#phonecode").val()
        }
        console.log(info.code);
        $.ajax({
            type: "post",
            url: "{{route('check.phone')}}",
            context: this,
            data: info,
            success: function(data) {
                if ($('#error').text() != '') {
                    $('#error').css("display", "none");
                }
            window.location.href = 'http://lykasystems.test/login';
            },
            error: function() {
              if ($('#error').text() != '') {
                  $('#error').css("display", "none");
              }
              error = "<strong id='error' style='margin-top: 0px;'>O número que inseriu não corresponde ao seu e-mail.</strong>";
              $('#collapse-p').after(error);
            }
        });
    });
</script>
@endsection
@endsection
