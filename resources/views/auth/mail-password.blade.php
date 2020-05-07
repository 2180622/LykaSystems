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
                form = "<form style='padding: 0px;' id='form2'> <button type='submit' class='submit-button' id='submit-button2'>Recuperar</button> </form>";
                $('#collapse').show().append(form);
                $('#collapse-card').prepend(user.telefone1).after("<br>");
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
</script>
@endsection
@endsection
