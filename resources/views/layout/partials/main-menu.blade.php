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
                    <ion-icon name="cloud-outline" style="font-size: 16pt; position: relative; top: 3px; right: 3px; --ionicon-stroke-width: 40px;"></ion-icon>
                </div>
                <span class="{{Route::is('dashboard') ? 'active' : ''}} option-name" style="bottom:2px;">Dashboard</span>
            </a>
        </li>

        <br>

        <!-- Estudantes  -->
        <li class="menu-option">
            <a href="{{route('clients.index')}}">
                <div class="menu-icon">
                    <ion-icon name="person-circle-outline" style="font-size: 16pt; position: relative; top: 5px; right: 3px;"></ion-icon>
                </div>
                <span class="option-name {{Route::is('clients.*') ? 'active' : ''}} option-name">Estudantes</span>
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

        <!-- Pagamentos -->
        <li class="menu-option">
            <a href="#">
                <div class="menu-icon">
                    <ion-icon name="wallet-outline" style="font-size:16pt; --ionicon-stroke-width: 50px; position: relative; top: 3px; right: 3px;"></ion-icon>
                </div>
                <span class="option-name">Pagamentos</span>
            </a>
        </li>

        <!-- Listagens -->
        <li class="menu-option">
            <a href="#">
                <div class="menu-icon">
                    <i class="fas fa-stream mr-2"></i>
                </div>
                <span class="option-name">Listagens</span>
            </a>
        </li>

        <li class="menu-option">
            <a data-toggle="collapse" href="#collapseDiv" aria-expanded="false" aria-controls="collapseDiv">
                <div class="menu-icon">
                    <i class="fas fa-tools mr-2"></i>
                </div>
                <span class="option-name">Diversos</span>
            </a>
        </li>

        <div class="collapse" id="collapseDiv">
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
                <a href="{{route('phonebook.index')}}">
                    <div class="menu-icon">
                        <i class="fas fa-phone-alt mr-2"></i>
                    </div>
                    <span class="{{Route::is('phonebook.*') ? 'active' : ''}} option-name">Lista telefónica</span>
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
        </div>

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



    <div class="text-center mb-4">


        <div class="opts_btn shadow-sm align-self-center">
            <a href="#" title="Definições" class="user_btn"><i class="fas fa-cog"></i></a>
        </div>

        <div class="user_opts shadow-sm align-self-center">
            <a href="#" title="Terminar sessão" class="user_btn"><i class="fas fa-power-off"></i></a>
        </div>


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
