<div class="menu-content">
    <!-- Lyka Name -->
    <div class="row pt-3 pb-3 logo">
        <div class="col">
            <a class="logotype" href="{{route('dashboard')}}">lyka.</a>
        </div>
    </div>

    <!-- Menu Options -->
    <ul class="menu-list">
        <!-- Dashboard -->
        <li class="menu-option">
            <a href="{{route('dashboard')}}">
                <div class="menu-icon">
                    <i class="far fa-hdd mr-2"></i>
                </div>
                <span class="{{Route::is('dashboard') ? 'active' : ''}}" style="bottom:2px;">Dashboard</span>
            </a>
        </li>

        <br>

        <!-- Estudantes  -->
        <li class="menu-option">
            <a href="#">
                <div class="menu-icon">
                    <i class="fas fa-user-graduate mr-2"></i>
                </div>
                <span class="option-name">Estudantes</span>
            </a>
        </li>


        <!-- Universidades  -->
        <li class="menu-option">
            <a href="#">
                <div class="menu-icon">
                    <i class="fas fa-university mr-2"></i>
                </div>
                <span class="option-name">Universidades</span>
            </a>
        </li>

        <!-- Agentes  -->
        <li class="menu-option">
            <a href="#">
                <div class="menu-icon">
                    <i class="fas fa-user-tie mr-2"></i>
                </div>
                <span class="option-name">Agentes</span>
            </a>
        </li>

        <br>

        <!-- Listagens -->
        <li class="menu-option">
            <a href="#">
                <div class="menu-icon">
                    <i class="fas fa-stream mr-2"></i>
                </div>
                <span class="option-name">Listagens</span>
            </a>
        </li>

        <!-- Relatório de contas -->
        <li class="menu-option">
            <a href="#">
                <div class="menu-icon">
                    <i class="fas fa-chart-line mr-2"></i>
                </div>
                <span class="option-name">Relatório de contas</span>
            </a>
        </li>


        <!-- Biblioteca -->
        <li class="menu-option">
            <a href="#">
                <div class="menu-icon">
                    <i class="far fa-folder mr-2"></i>
                </div>
                <span class="option-name">Biblioteca</span>
            </a>
        </li>

        <!-- Lista telefónica -->
        <li class="menu-option">
            <a href="#">
                <div class="menu-icon">
                    <i class="fas fa-phone-alt mr-2"></i>
                </div>
                <span class="option-name">Lista telefónica</span>
            </a>
        </li>

        <!-- Agenda -->
        <li class="menu-option">
            <a href="#">
                <div class="menu-icon">
                    <i class="far fa-calendar-alt mr-2"></i>
                </div>
                <span class="option-name">Agenda</span>
            </a>
        </li>

        <!-- Pagamentos -->
        <li class="menu-option">
            <a href="#">
                <div class="menu-icon">
                    <i class="far fa-credit-card mr-2"></i>
                </div>
                <span class="option-name">Pagamentos</span>
            </a>
        </li>

        <!-- Utilizadores -->
        <li class="menu-option">
            <a href="{{route('users.index')}}">
                <div class="menu-icon">
                    <i class="fas fa-users mr-2"></i>
                </div>
                <span class="{{Route::is('users.*') ? 'active' : ''}} option-name">Utilizadores</span>
            </a>
        </li>

    </ul>



    <div class="text-center  mb-4">


        <a href="#" title="Definições" class="user_btn"><div class="opts_btn shadow-sm align-self-center">
            <i class="fas fa-sliders-h"></i>
        </div></a>

        <a href="#" title="Terminar sessão" class="user_btn"><div class="user_opts shadow-sm align-self-center">
            <i class="fas fa-power-off"></i>
        </div></a>


        <div class="mx-auto user_photo rounded-circle shadow">
            {{-- Foto Utilizador --}}
            <img src="{{asset('storage/user-photos/user.jpg')}}" style="width:100%">
        </div>

        <div class="text-center mt-3">
            {{-- Nome e Perfil --}}
            <span class="font-weight-bold text-uppercase">Nome</span><br>
            <span class="text-muted " style="font-size:14px">Administrador</span>
        </div>

    </div>





</div>
