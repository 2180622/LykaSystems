<div class="menu-content"> 
    <!-- Lyka Name -->
    <div class="row pt-3 pb-3">
        <div class="col text-center">
            <a class="logotype" href="{{route('dashboard')}}">lyka.</a>
        </div>
    </div>

    <!-- Menu Options -->
    <ul class="menu-list">

        <!-- Dashboard -->
        <li class="menu-option">
            <a href="{{route('dashboard')}}">
                <div class="menu_icon">
                    <i class="fas fa-tachometer-alt mr-2"></i>
                </div>
                <span class="{{Route::is('dashboard') ? 'active' : ''}} option-name">Dashboard</span>
            </a>
        </li>

        <li class="menu-option"></li>

        <!-- Estudantes  -->
        <li class="menu-option">
            <a href="#">
                <div class="menu_icon">
                    <i class="fas fa-user-graduate mr-2"></i>
                </div>
                <span class="option-name">Estudantes</span>
            </a>
        </li>


        <!-- Universidades  -->
        <li class="menu-option">
            <a href="#">
                <div class="menu_icon">
                    <i class="fas fa-university mr-2"></i>
                </div>
                <span class="option-name">Universidades</span>
            </a>
        </li>

        <!-- Agentes  -->
        <li class="menu-option">
            <a href="#">
                <div class="menu_icon">
                    <i class="fas fa-user-tie mr-2"></i>
                </div>
                <span class="option-name">Agentes</span>
            </a>
        </li>

        <li class="menu-option"></li>

        <!-- Listagens -->
        <li class="menu-option">
            <a href="#">
                <div class="menu_icon">
                    <i class="fas fa-stream mr-2"></i>
                </div>
                <span class="option-name">Listagens</span>
            </a>
        </li>

        <!-- Relatório de contas -->
        <li class="menu-option">
            <a href="#">
                <div class="menu_icon">
                    <i class="fas fa-chart-line mr-2"></i>
                </div>
                <span class="option-name">Relatório de contas</span>
            </a>
        </li>


        <!-- Biblioteca -->
        <li class="menu-option">
            <a href="#">
                <div class="menu_icon">
                    <i class="fas fa-photo-video mr-2"></i>
                </div>
                <span class="option-name">Biblioteca</span>
            </a>
        </li>

        <!-- Lista telefónica -->
        <li class="menu-option">
            <a href="#">
                <div class="menu_icon">
                    <i class="fas fa-phone-alt mr-2"></i>
                </div>
                <span class="option-name">Lista telefónica</span>
            </a>
        </li>

        <!-- Agenda -->
        <li class="menu-option">
            <a href="#">
                <div class="menu_icon">
                    <i class="far fa-calendar-alt mr-2"></i>
                </div>
                <span class="option-name">Agenda</span>
            </a>
        </li>

        <!-- Pagamentos -->
        <li class="menu-option">
            <a href="#">
                <div class="menu_icon">
                    <i class="far fa-credit-card mr-2"></i>
                </div>
                <span class="option-name">Pagamentos</span>
            </a>
        </li>

        <!-- Utilizadores -->
        <li class="menu-option">
            <a href="{{route('users.index')}}">
                <div class="menu_icon">
                    <i class="fas fa-users mr-2"></i>
                </div>
                <span class="{{Route::is('users.*') ? 'active' : ''}} option-name">Utilizadores</span>
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
                {{-- Nome e Perfil --}}
                <span class="font-weight-bold">Nome</span><br>
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
