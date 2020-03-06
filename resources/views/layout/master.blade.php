<!DOCTYPE html>
<html lang="pt" dir="ltr">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title> @yield('title') | LYKA</title>

    <!-- Favicon -->
    {{-- <link rel="shortcut icon" href="/img/icon_logo.png" type="image/x-icon"> --}}





    <!-- Bootstrap core CSS -->
    <link href="{{asset('vendor/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet">


    <!-- Fontawesome core CSS -->
    <link href="{{asset('vendor/fontawesome-free/css/all.min.css')}}" rel=" stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Fira+Sans:300,500&display=swap" rel="stylesheet">


    <!-- CSS Link -->
    <link href="{{asset('css/style_master.css')}}" rel="stylesheet">


    @yield('styleLinks')

</head>

<body>


   <!-- Estrutura & Navegação -->
   <div class="container-fluid ">
    <div class="row" style="min-height:100%">

        <!-- Menu principal - Esquerda -->
        <div class="col main_menu shadow">
            @include('layout.partials.main_menu')
        </div>

        <!-- Conteudo Principal -->
        <div class="col ">
            @yield('content')
        </div>

        <!--Barra Direita (notificações) -->
        <div class="col sidebar shadow p-2" >
            @include('layout.partials.sidebar')
        </div>


</body>

</html>
