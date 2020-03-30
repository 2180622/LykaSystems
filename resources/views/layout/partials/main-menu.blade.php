@include('layout.partials.modal')

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
            <a href="{{route('universities.index')}}">
                <div class="menu-icon">
                    <i class="fas fa-university mr-2"></i>
                </div>
                <span class="option-name {{Route::is('universities.*') ? 'active' : ''}}">Universidades</span>
            </a>
        </li>

        <!-- Agentes  -->
        <li class="menu-option">
            <a href="{{route('agents.index')}}">
                <div class="menu-icon">
                    <i class="fas fa-user-tie mr-2"></i>
                </div>
                <span class="option-name {{Route::is('agents.*') ? 'active' : ''}}">Agentes</span>
            </a>
        </li>

        {{-- Produtos --}}
        <li class="menu-option">
            <a href="{{route('produtostock.index')}}">
                <div class="menu-icon">
                    <i class="fas fa-user-tie mr-2"></i>
                </div>
                <span class="option-name {{Route::is('produtostock.*') ? 'active' : ''}}">Produtos Stock</span>
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
                <a href="{{route('libraries.index')}}">
                    <div class="menu-icon">
                        <i class="far fa-folder mr-2"></i>
                    </div>
                    <span class="option-name {{Route::is('libraries.*') ? 'active' : ''}}">Biblioteca</span>
                </a>
            </li>

            <!-- Lista telefónica -->
            <li class="menu-option">
                <a href="{{route('contacts.index')}}">
                    <div class="menu-icon">
                        <i class="fas fa-phone-alt mr-2"></i>
                    </div>
                    <span class="{{Route::is('contacts.*') ? 'active' : ''}} option-name">Lista telefónica</span>
                </a>
            </li>

            <!-- Agenda -->
            <li class="menu-option">
                <a href="{{route('agends.index')}}">
                    <div class="menu-icon">
                        <i class="far fa-calendar-alt mr-2"></i>
                    </div>
                    <span class="option-name {{Route::is('agends.*') ? 'active' : ''}}">Agenda</span>
                </a>
            </li>
        </div>

        <!-- Utilizadores -->
        @if (Auth()->user()->tipo == 'admin')
        <li class="menu-option">
            <a href="{{route('users.index')}}">
                <div class="menu-icon">
                    <i class="fas fa-users mr-2"></i>
                </div>
                <span class="{{Route::is('users.*') ? 'active' : ''}} option-name">Utilizadores</span>
            </a>
        </li>
        @endif
    </ul>



    <div class="text-center mb-4">


        <div class="opts_btn shadow-sm align-self-center">
            <a href="#" title="Definições" class="user_btn"><i class="fas fa-cog"></i></a>
        </div>

        <div class="user_opts shadow-sm align-self-center">
            <a href="#" title="Terminar sessão" class="user_btn" data-toggle="modal" data-target="#Modal"><i class="fas fa-power-off"></i></a>
{{--             @csrf
            @method('POST') --}}
        </div>
        <!-- -->
        @if (Auth::user()->tipo == "admin" && Auth::user()->idAdmin != null)
        <div class="mx-auto user_photo rounded-circle shadow">
            {{-- Foto Utilizador --}}
            @if(Auth::user()->admin->fotografia != null)
                <img src="{{asset('/storage/admin-photos/'.Auth::user()->admin->fotografia)}}" style="width:100%">
                @elseif (Auth::user()->admin->genero == "F")
                <img src="{{asset('/storage/default-photos/F.jpg')}}" style="width:100%">
                @else
                <img src="{{asset('/storage/default-photos/M.jpg')}}" style="width:100%">
                @endif
        </div>

        <div class="text-center mt-3">
            {{-- Nome e Perfil --}}
            <span class="font-weight-bold text-uppercase">{{Auth::user()->admin->nome}}</span><br>
            <span class="text-muted " style="font-size:14px">{{Auth::user()->tipo}}</span>
        </div>
        @elseif (Auth::user()->tipo == "agente" && Auth::user()->idAgente != null)
        <div class="mx-auto user_photo rounded-circle shadow">
            {{-- Foto Utilizador --}}
            @if(Auth::user()->agente->fotografia != null)
                <img src="{{asset('/storage/agent-photos/'.Auth::user()->agente->fotografia)}}" style="width:100%">
                @elseif (Auth::user()->agente->genero == "F")
                <img src="{{asset('/storage/default-photos/F.jpg')}}" style="width:100%">
                @else
                <img src="{{asset('/storage/default-photos/M.jpg')}}" style="width:100%">
                @endif
        </div>

        <div class="text-center mt-3">
            {{-- Nome e Perfil --}}
            <span class="font-weight-bold text-uppercase">{{Auth::user()->agente->nome}}</span><br>
            <span class="text-muted " style="font-size:14px">{{Auth::user()->tipo}}</span>
        </div>
        @elseif (Auth::user()->tipo == "cliente" && Auth::user()->idCliente != null)
        <div class="mx-auto user_photo rounded-circle shadow">
            {{-- Foto Utilizador --}}
            @if(Auth::user()->cliente->fotografia != null)
                <img src="{{asset('/storage/client-photos/'.Auth::user()->cliente->fotografia)}}" style="width:100%">
                @elseif (Auth::user()->cliente->genero == "F")
                <img src="{{asset('/storage/default-photos/F.jpg')}}" style="width:100%">
                @else
                <img src="{{asset('/storage/default-photos/M.jpg')}}" style="width:100%">
                @endif
        </div>

        <div class="text-center mt-3">
            {{-- Nome e Perfil --}}
            <span class="font-weight-bold text-uppercase">{{Auth::user()->cliente->nome}}</span><br>
            <span class="text-muted " style="font-size:14px">{{Auth::user()->tipo}}</span>
        </div>
        @endif

    </div>
</div>
