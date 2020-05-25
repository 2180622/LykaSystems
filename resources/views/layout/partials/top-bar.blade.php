<div class="d-flex align-content-center flex-wrap">
    {{-- Menu icon --}}
    <div class="mr-auto bd-highlight align-self-center">
        <ion-icon name="menu-outline" id="menu-icon"></ion-icon>
    </div>
    {{-- Phone icon --}}
    <div class="bd-highlight pr-5 pt-1 align-self-center">
        <ion-icon name="call-outline" id="procurar-contactos-icon"></ion-icon>
    </div>
    {{-- Notification icon --}}
    <div class="bd-highlight pr-5 pt-1 align-self-center">
        <ion-icon name="notifications-outline" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"></ion-icon>
        <div class="dropdown-menu dropdown-menu-right shadow-sm mt-2" aria-labelledby="dropdownMenuButton">
            <div class="dropdown-header">
                Notificações
            </div>
            <div class="dropdown-content">
                <p class="text-center"><img src="{{asset("/media/cat.jpg")}}" width="200px"><br>I'm Back!!</p>
            </div>
        </div>
    </div>
    {{-- User image --}}
    <div class="bd-highlight pr-2 align-self-center" data-toggle="modal" data-target="#settingsModal">
        <div class="user-image"  >
            <img src="{{asset("/media/profile-photo.jpg")}}" alt="Imagem de apresentação" width="100%">
        </div>
    </div>
    {{-- User info --}}
    <div class="bd-highlight align-self-center user-info" data-toggle="modal" data-target="#settingsModal">
        @if (Auth()->user()->tipo == "admin")
        <p>{{Auth()->user()->admin->nome.' '.Auth()->user()->admin->apelido}}</p>
        @elseif (Auth()->user()->tipo == "agente")
        <p>{{Auth()->user()->agente->nome.' '.Auth()->user()->agente->apelido}}</p>
        @else
        <p>{{Auth()->user()->cliente->nome.' '.Auth()->user()->cliente->apelido}}</p>
        @endif
        <br>
        @if (Auth()->user()->tipo == "admin")
        <p>Administrador</p>
        @elseif (Auth()->user()->tipo == "agente")
        <p>Agente</p>
        @else
        <p>Cliente</p>
        @endif
    </div>
</div>
