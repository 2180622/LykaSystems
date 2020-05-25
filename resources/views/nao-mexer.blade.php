@include('layout.partials.modal')

{{-- AJUDA + Terminar Sessão --}}
<div class="text-center mb-4">
    <div class="opts_btn shadow-sm align-self-center">
        <a href="{{route('ajuda')}}" title="Ajuda" class="user_btn {{Route::is('ajuda') ? 'active' : ''}}"><i class="fas fa-question"></i></a>
    </div>

    <div class="user_opts shadow-sm align-self-center">
        <a href="#" title="Terminar sessão" class="user_btn" data-toggle="modal" data-target="#Modal"><i class="fas fa-power-off"></i></a>
    </div>

    {{-- SE FOR ADMIN --}}
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


    {{-- SE FOR AGENTE / SUBAGENTE --}}
    @elseif (Auth::user()->tipo == "agente" && Auth::user()->idAgente != null)
    <div class="mx-auto user_photo rounded-circle shadow">
        <a href="{{route('agents.show', Auth::user()->agente )}}" title="Ver as minhas informações">
            {{-- Foto Utilizador --}}
            @if(Auth::user()->agente->fotografia != null)
                <img src="{{asset('/storage/agent-documents/'.Auth::user()->agente->idAgente.'/'.Auth::user()->agente->fotografia)}}" style="width:100%">
                @elseif (Auth::user()->agente->genero == "F")
                <img src="{{asset('/storage/default-photos/F.jpg')}}" style="width:100%">
                @else
                <img src="{{asset('/storage/default-photos/M.jpg')}}" style="width:100%">
                @endif
        </a>
    </div>

    <div class="text-center mt-3">
        {{-- Nome e Perfil --}}
        <span class="font-weight-bold text-uppercase">{{Auth::user()->agente->nome}}</span><br>
        <span class="text-muted " style="font-size:14px">{{Auth::user()->agente->tipo}}</span>
    </div>


    {{-- SE FOR CLIENTE --}}
    @elseif (Auth::user()->tipo == "cliente" && Auth::user()->idCliente != null)
    <div class="mx-auto user_photo rounded-circle shadow">
        <a href="#" title="Ver as minhas informações">
            {{-- Foto Utilizador --}}
            @if(Auth::user()->cliente->fotografia != null)
                <img src="{{asset('/storage/client-photos/'.Auth::user()->cliente->fotografia)}}" style="width:100%">
                @elseif (Auth::user()->cliente->genero == "F")
                <img src="{{asset('/storage/default-photos/F.jpg')}}" style="width:100%">
                @else
                <img src="{{asset('/storage/default-photos/M.jpg')}}" style="width:100%">
                @endif
        </a>
    </div>

    <div class="text-center mt-3">
        {{-- Nome e Perfil --}}
        <span class="font-weight-bold text-uppercase">{{Auth::user()->cliente->nome}}</span><br>
        <span class="text-muted " style="font-size:14px">{{Auth::user()->tipo}}</span>
    </div>
    @endif

</div>
