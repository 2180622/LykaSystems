<!DOCTYPE html>
<html lang="pt" dir="ltr">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title> @yield('title') | LYKA</title>

    <!-- Favicon -->
    {{-- <link rel="shortcut icon" href="/img/icon_logo.png" type="image/x-icon"> --}}

    <!-- Bootstrap core CSS -->
    <link href="{{asset('/vendor/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet">

    <!-- Fontawesome core CSS -->
    <link href="{{asset('/vendor/fontawesome-free/css/all.min.css')}}" rel=" stylesheet" type="text/css">

    <!-- Lyka Font -->
    <link href="https://fonts.googleapis.com/css?family=Nunito&display=swap" rel="stylesheet">

    <!-- CSS Link -->
    <link href="{{asset('/css/master.css')}}" rel="stylesheet">

    @yield('styleLinks')

</head>

<body>

    <!-- Structure and Navigation -->
    <div class="container-fluid ">
        <div class="row" style="min-height:100vh">

            <!-- Left SIdebar -->
            <div class="col main_menu shadow">
                @include('layout.partials.main-menu')
            </div>

            <!-- Content -->
            <div class="col pb-5 pt-3 " style="">
                @yield('content')
            </div>

            <!-- Right Sidebar -->
            <div class="col sidebar shadow p-2">
                @include('layout.partials.sidebar')
            </div>
        </div>
    </div>

    <!-- Scripts -->
    @include('layout.partials.footer')

</body>

</html>
