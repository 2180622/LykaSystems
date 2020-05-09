<!DOCTYPE html>
<html lang="pt" dir="ltr">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title> @yield('title') - Lyka Systems</title>

    <!-- Favicon -->
    <link rel="shortcut icon" href="/media/favicon.png" type="image/x-icon">

    <!-- Bootstrap core CSS -->
    <link href="{{asset('/vendor/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet">

    <!-- Fontawesome core CSS -->
    <link href="{{asset('/vendor/fontawesome-free/css/all.min.css')}}" rel=" stylesheet" type="text/css">

    <!-- Lyka Font -->
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700;800;900&display=swap" rel="stylesheet">

    <!-- CSS Link -->
    <link href="{{asset('/css/master.css')}}" rel="stylesheet">

    <script src="https://unpkg.com/feather-icons"></script>

    @yield('styleLinks')

    {{-- NOTIFICAÇÔES PARA TODAS AS PÁGINAS --}}

    @php
    $Notificacoes = Auth()->user()->getNotifications();
    @endphp

</head>

<body>

    {{-- Mensagem de carregamento / processamento --}}
    <div id="wait_screen" style="display:none; position:absolute; top:0; left:0; width:100% ; height:100%; background-color:black; opacity:0.7;z-index:999;">
        <div class="row" style="width: 100%; height:100%">

            <div class="col my-auto mx-auto text-center text-white">

                <div class="spinner-grow" style="width: 3rem; height: 3rem;" role="status">
                    <span class="sr-only">Loading...</span>
                </div>
                <div style="font-size:30px">Aguarde por favor...</div>
            </div>

        </div>
    </div>
    {{-- Mensagem de carregamento / processamento --}}
    <!-- Structure and Navigation -->
    <div class="container-fluid ">
        <div class="row" style="min-height:100vh">

            <!-- Left Sidebar -->
            <div class="col main-menu shadow">
                @include('layout.partials.main-menu')
            </div>

            <!-- Content -->
            <div class="col pb-5 pt-3">
                <!-- Error and Success Message -->
                @if ($errors->any())
                @include ('layout.msg-error-message.partials.errors')
                @endif
                @if (!empty(session('success')))
                @include ('layout.msg-error-message.partials.success')
                @endif
                <!-- Content -->
                @yield('content')
            </div>

            <!-- Right Sidebar -->
            <div class="col sidebar shadow">
                @include('layout.partials.sidebar')
            </div>
        </div>
    </div>

    <!-- Scripts -->
    @include('layout.partials.footer')

    <script type="text/javascript">
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': "{{csrf_token()}}"
            }
        });

        $('#form-contact').submit(function(event) {
            event.preventDefault();
            info = {
                users: $("#user-type").find(":selected").val(),
                name: $("#name").val()
            };
            $.ajax({
                type: "post",
                url: "{{route('search.contact')}}",
                context: this,
                data: info,
                success: function(data) {
                    console.log(data);
                },
                error: function() {
                    console.log('NOK');
                }
            });
        });
    </script>
</body>

</html>
