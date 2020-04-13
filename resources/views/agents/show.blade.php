@extends('layout.master')

{{-- Page Title --}}
@section('title', 'Ficha de agente')

{{-- CSS Style Link --}}
@section('styleLinks')
<link href="{{asset('css/datatables_general.css')}}" rel="stylesheet">
<link href="{{asset('css/agents.css')}}" rel="stylesheet">
@endsection
{{-- Page Content --}}
@section('content')

<div class="container mt-2">
    {{-- Navegação --}}
    <div class="float-left buttons">
        <a href="javascript:history.go(-1)" title="Voltar">
            <ion-icon name="arrow-back-outline" class="button-back"></ion-icon>
        </a>
        <a href="javascript:window.history.forward();" title="Avançar">
            <ion-icon name="arrow-forward-outline" class="button-foward"></ion-icon>
        </a>
    </div>
    <div class="float-right">
        @if ( Auth::user()->tipo == "admin")
        <a href="{{route('agents.edit',$agent)}}" class="top-button mr-2">Editar informação</a>
        <a href="{{route('agents.print',$agent)}}" target="_blank" class="top-button">Imprimir</a>
        @endif
    </div>

    <br><br>

    <div class="cards-navigation">
        <div class="title">

            <h6>
                @if ($agent->tipo=="Agente")
                    Ficha de Agente
                @else
                    Ficha de Subagente<br>
                    <span class="text-muted"><small>Adicionado por: <a class="agent_link" href="{{route('agents.show',$mainAgent)}}">{{$mainAgent->nome}} {{$mainAgent->apelido}}</a></small></span>
                @endif
            </h6>

        </div>
        <br>

        <div class="row font-weight-bold border p-2 pt-3 pb-3" style="color:#6A74C9">
            <div class="col p-0 text-center mr-2" style="flex: 0 0 20%; -ms-flex: 0 0 20%; min-width:195px">

                @if($agent->fotografia)
                <img class="m-2 p-1 rounded bg-white shadow-sm"
                    src="{{Storage::disk('public')->url('agent-photos/').$agent->fotografia}}" style="width:90%">
                @elseif($agent->genero == 'F')
                <img class="m-2 p-1 rounded bg-white shadow-sm"
                    src="{{Storage::disk('public')->url('default-photos/F.jpg')}}" style="width:90%">
                @else
                <img class="m-2 p-1 rounded bg-white shadow-sm"
                    src="{{Storage::disk('public')->url('default-photos/M.jpg')}}" style="width:90%">
                @endif

                <br>


                @if (Auth::user()->tipo == "admin")
                <div class="card rounded shadow-sm m-2 p-3">
                    @if ($agent->img_doc)
                        <i class="far fa-id-card" style="font-size:40px"></i>
                        <a class="name_link" target="_blank" href="{{Storage::disk('public')->url('agent-docs/').$agent->img_doc}}">Ver documento de identificação</a>
                    @else
                        <i class="far fa-id-card" style="font-size:40px"></i>
                        <a href="{{route('agents.edit',$agent)}}" class="mt-2 agent_link">
                            <small class="text-danger mt-2"><strong>Sem documento de identificação</strong></small>
                        </a>
                    @endif
                </div>
                @endif


            </div>

            <div class="col p-2" style="min-width:280px !important">


                {{-- Informações Pessoais --}}
                <div><span class="text-secondary ">Nome:</span> {{$agent->nome}} {{$agent->apelido}}</div>

                <div><span class="text-secondary ">Género: </span>
                    @if ($agent->genero == 'M')
                    Masculino
                    @else
                    Feminino
                    @endif
                </div><br>

                <div><span class="text-secondary ">Data de nascimento: </span>
                    {{ date('d-M-y', strtotime($agent->dataNasc)) }}</div><br>


                <div><span class="text-secondary">País:</span> {{$agent->pais}}</div>

                <div><span class="text-secondary">Morada:</span> {{$agent->morada}}</div><br>

                <div><span class="text-secondary">Telefone (principal):</span> {{$agent->telefoneW}}</div>

                <div><span class="text-secondary">Telefone (alternativo):</span> {{$agent->telefone2}}</div><br>

                <div><span class="text-secondary">E-mail:</span> {{$agent->email}}</div><br>

                <div><span class="text-secondary">N. Documento Identificação:</span> {{$agent->num_id}}</div>

                <div><span class="text-secondary">NIF:</span> {{$agent->NIF}}</div>

                <hr>

                <div class="text-muted"><small>Adicionado: {{ date('d-M-y', strtotime($agent->created_at)) }}</small>
                </div>
                <div class="text-muted"><small>Ultima atualização:
                        {{ date('d-M-y', strtotime($agent->updated_at)) }}</small></div>

            </div>

            <div class="col p-2" style="min-width:280px !important">

                    <div class="mb-2 text-muted">Lista de subagentes:</div>

                     @if($listagents==null)
                        <div class="text-muted"><small>(sem registos)</small></div>
                    @else
                        @foreach ($listagents as $agent)
                            <div class="mb-1 text-muted"><i class="fas fa-user-tie mr-2"></i><a class="agent_link" href="{{route('agents.show',$agent)}}" >{{$agent->nome}} {{$agent->apelido}}</a></div>
                        @endforeach
                    @endif




            </div>


        </div>


    </div>
</div>

@endsection

{{-- Scripts --}}
@section('scripts')
{{-- <script src="{{asset('/js/agent.js')}}"></script> --}}
@endsection
