@extends('layout.auth')

@section('title', 'Restaurar palavra-chave')

@section('content')

<div class="master-form">
    <div>
        <p>Restaurar palavra-chave</p>
        <p>Introduza o seu e-mail para dar continuidade ao processo.</p>
        @if (isset($error))
        <strong id="error">
            {{$error}}
        </strong>
        @endif
        <div>
            <form id="form" class="email-form" method="POST">
                <div class="form-group">
                    <input id="email" type="text" class="form-control" name="email" placeholder="Endereço eletrónico">
                </div>
                <div class="form-group">
                    <button type="submit" class="btn submit-button">Confirmar</button>
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
                    $('#error').remove();
                }
                user = JSON.parse(data);
            }
        });
    });
</script>
@endsection
@endsection
