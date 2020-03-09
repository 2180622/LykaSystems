<div class="">

    <!-- LYKA Logotipo -->
    <div class="row pt-3 pb-3">
        <div class="col text-center">
            <a class="logotype" href="{{route('dashboard')}}">LYKA.</a>
        </div>
    </div>



    <!-- OPÇÔES DE MENU -->

    <ul class="menu-list">

        <!-- Dashboard -->
        <li class="menu_option">
            <a href="{{route('dashboard')}}">
                <div class="menu_icon">
                    <i class="fas fa-tachometer-alt mr-2"></i>
                </div>
                <span class="{{Route::is('dashboard') ? 'active' : ''}}">Dashboard</span>
            </a>
        </li>

        <li class="menu_option"></li>

        <!-- Estudantes  -->
        <li class="menu_option">
            <a href="#">
                <div class="menu_icon">
                    <i class="fas fa-user-graduate mr-2"></i>
                </div>
                <span>Estudantes</span>
            </a>
        </li>


        <!-- Universidades  -->
        <li class="menu_option">
            <a href="#">
                <div class="menu_icon">
                    <i class="fas fa-university mr-2"></i>
                </div>
                <span>Universidades</span>
            </a>
        </li>

        <!-- Agentes  -->
        <li class="menu_option">
            <a href="#">
                <div class="menu_icon">
                    <i class="fas fa-user-tie mr-2"></i>
                </div>
                <span>Agentes</span>
            </a>
        </li>

        <li class="menu_option"></li>

        <!-- Listagens -->
        <li class="menu_option">
            <a href="#">
                <div class="menu_icon">
                    <i class="fas fa-stream mr-2"></i>
                </div>
                <span>Listagens</span>
            </a>
        </li>

        <!-- Relatório de contas -->
        <li class="menu_option">
            <a href="#">
                <div class="menu_icon">
                    <i class="fas fa-chart-line mr-2"></i>
                </div>
                <span>Relatório de contas</span>
            </a>
        </li>


        <!-- Biblioteca -->
        <li class="menu_option">
            <a href="#">
                <div class="menu_icon">
                    <i class="fas fa-photo-video mr-2"></i>
                </div>
                <span>Biblioteca</span>
            </a>
        </li>

        <!-- Lista telefónica -->
        <li class="menu_option">
            <a href="#">
                <div class="menu_icon">
                    <i class="fas fa-phone-alt mr-2"></i>
                </div>
                <span>Lista telefónica</span>
            </a>
        </li>

        <!-- Agenda -->
        <li class="menu_option">
            <a href="#">
                <div class="menu_icon">
                    <i class="far fa-calendar-alt mr-2"></i>
                </div>
                <span>Agenda</span>
            </a>
        </li>

        <!-- Pagamentos -->
        <li class="menu_option">
            <a href="#">
                <div class="menu_icon">
                    <i class="far fa-credit-card mr-2"></i>
                </div>
                <span>Pagamentos</span>
            </a>
        </li>

        <!-- Utilizadores -->
        <li class="menu_option">
            <a href="{{route('users.index')}}">
                <div class="menu_icon">
                    <i class="fas fa-users mr-2"></i>
                </div>
                <span class="{{Route::is('users.*') ? 'active' : ''}}">Utilizadores</span>
            </a>
        </li>

    </ul>




    <div class="mt-5 m-2 rounded">


        <div class="p-2">
            <div style="float:left; width: 50px;">
                {{-- Foto Utilizador --}}
                <img class="shadow" src="{{asset('storage/user-photos/user.jpg')}}" style="width:100%">
            </div>

            <div class="pl-2" style="float:left;">
                {{-- Nome e Role --}}
                <span class="font-weight-bold">{{route(user.index)}}</span><br>
                <span class="text-muted" style="font-size:14px">Administrador</span>
            </div>
        </div>

        <div class="mt-5 p-2 rounded  text-center ">
            <a href="#" class="btn btn-sm btn-light mr-2"><i class="fas fa-sliders-h m-2"></i></a>
            <a href="#" class="btn btn-sm btn-light mr-2"><i class="far fa-question-circle m-2"></i></a>
            <a href="#" class="btn btn-sm btn-light"><i class="fas fa-power-off m-2"></i></a>
        </div>



    </div>






</div>
