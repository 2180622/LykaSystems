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
      //  $Notificacoes = Auth()->user()->notificacao();
     @endphp


</head>

<body>

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

</body>

</html>
