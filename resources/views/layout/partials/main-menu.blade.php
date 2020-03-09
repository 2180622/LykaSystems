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
                    <ion-icon name="person-circle-outline" style="font-size: 16pt;"></ion-icon>
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

        <!-- Pagamentos -->
        <li class="menu-option">
            <a href="#">
                <div class="menu-icon">
                    <ion-icon name="wallet-outline" style="font-size:16pt; --ionicon-stroke-width: 50px;"></ion-icon>
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
                    <i class="fas fa-stream mr-2"></i>
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
