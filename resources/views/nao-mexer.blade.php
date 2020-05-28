
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


<br>
<div class="report">
    <div class="row">
        <div class="title col-md-10">
            <h6>Relatório e contas</h6>
        </div>
        <div class="col-md-2 text-right">
            <button type="button" name="button">ver todos</button>
        </div>
    </div>
    <div class="row graphic-group">
        <div class="col-md-6">
            <div class="graphic">

            </div>
        </div>
        <div class="col-md-6">
            <div class="graphic">
                @if($agends!=null)
                    <div class="table-responsive " style="overflow:hidden">
                        <table nowarp class="table table-borderless" row-border="0"
                               style="overflow:hidden;">
                            {{-- Cabeçalho da tabela --}}
                            <thead>
                            @foreach ($todayAgends as $agend)
                                <tr>
                                    <th colspan="2">Todos os eventos {{ date('d/m/Y', strtotime($agend->Date.now())) }}</th>
                                </tr>
                            </thead>
                            {{-- Corpo da tabela --}}
                            <tbody>

                            <tr href="#">
                                <td style="padding:0!important"><i class="fas fa-circle ml-3 mt-2"
                                                                   style="color:{{$agend->cor}}"></i></td>
                                {{-- Título --}}
                                <td style="padding: 0 3px 0 0!important"><a>{{$agend->titulo}}</td>
                            </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <div class="border rounded bg-light p-3">
                        <div class="text-muted"><small>(sem registos)</small></div>
                    </div>
                    <br>
                @endif
            </div>
        </div>
    </div>


    <div class="title  mt-5 ">
        <h6>Espaço de aramazenamento</h6>
    </div>

    <div class="row ">
        <div class="col">
            <div>
                Espaço de armazenamento ocupado: {{$size}}
                <br>Disponivel: XX
                <br> Gráfico ?
            </div>
        </div>

    </div>
