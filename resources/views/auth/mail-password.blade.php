@extends('layout.auth')

@section('title', 'Restaurar password')

@section('content')
<div class="master-form">
    <div>
        <p>Restaurar palavra-chave</p>
        <p>Após inserir o seu endereço-eletrónico e clicar no botão "Restaurar", aceda ao seu e-mail para mais informações.</p>
        @if (isset($error))
        <strong id="error">
            {{$error}}
        </strong>
        @endif
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
                        <button type="submit" class="btn submit-button">
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
        info = { email: $("#email").val() };
        $.ajax({
            type: "post",
            url: "{{route('check.email')}}",
            context: this,
            data: info,
            success: function(data) {
                user = JSON.parse(data);
                console.log(user.nome);
            }
        });
    });
</script>
@endsection
@endsection
