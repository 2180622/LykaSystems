@extends('layout.master')

{{-- Page Title --}}
@section('title', 'Ficha de agente')

{{-- CSS Style Link --}}
@section('styleLinks')
<link href="{{asset('css/datatables_general_style.css')}}" rel="stylesheet">
@endsection



{{-- Page Content --}}
@section('content')

    <div class="container mt-2">
        {{-- Navegação --}}
        <div class="float-left">
            <a href="javascript:history.go(-1)" title="Voltar"><i
                    class="fas fa-arrow-left rounded-circle p-2 nav_btns mr-3"></i></a>
            <a href="javascript:window.history.forward();" title="Avançar"><i
                    class="fas fa-arrow-right rounded-circle p-2 nav_btns"></i></a>
        </div>
        <div class="float-right">
            <a href="{{route('agents.edit',$agent)}}" class="top-button mr-2">Editar informação</a>
            <a href="{{route('agents.print',$agent)}}" target="_blank" class="top-button">Imprimir</a>
        </div>

        <br><br>

        <div class="cards-navigation">
            <div class="title">
                
                <h6>@if ($agent->tipo=="Agente")
                    Ficha de Agente
                    @else
                    Ficha de Subagente
                    @endif
                </h6>

            </div>
            <br>



            <div class="row font-weight-bold border p-2 pt-3 pb-3" style="color:#6A74C9">
                <div class="col p-0 text-center" style="flex: 0 0 20%; -ms-flex: 0 0 20%; min-width:195px">

                    @if($agent->fotografia)
                        <img class="m-2 p-1 rounded bg-white shadow-sm" src="{{Storage::disk('public')->url('agent-photos/').$agent->fotografia}}" style="width:90%">
                    @elseif($agent->genero == 'F')
                        <img class="m-2 p-1 rounded bg-white shadow-sm" src="{{Storage::disk('public')->url('default-photos/F.jpg')}}" style="width:90%">
                    @else
                        <img class="m-2 p-1 rounded bg-white shadow-sm" src="{{Storage::disk('public')->url('default-photos/M.jpg')}}" style="width:90%">
                    @endif

                </div>

                <div class="col p-2">

                    {{-- Informações Pessoais --}}
                    <div><span class="text-secondary ">Nome:</span> {{$agent->nome}} {{$agent->apelido}}</div><br>

                    <div><span class="text-secondary ">Género: </span>
                    @if ($agent->genero == 'M')
                        Masculino
                    @else
                        Feminino
                    @endif
                    </div><br>

                    <div><span class="text-secondary">País:</span> {{$agent->pais}}</div><br>

                    <div><span class="text-secondary ">Data de nascimento: </span>
                        {{ date('d-M-y', strtotime($agent->dataNasc)) }}</div><br>

                    <div><span class="text-secondary">Telefone (principal):</span> {{$agent->telefoneW}}</div><br>

                    <div><span class="text-secondary">Telefone (alternativo):</span> {{$agent->telefone2}}</div><br>

                    <div><span class="text-secondary">E-mail:</span> {{$agent->email}}</div>

                    <hr>

                    <div class="text-muted"><small>Adicionado: {{ date('d-M-y', strtotime($agent->created_at)) }}</small></div>
                    <div class="text-muted"><small>Ultima atualização: {{ date('d-M-y', strtotime($agent->updated_at)) }}</small></div>

                </div>

            </div>


        </div>
    </div>

@endsection

{{-- Scripts --}}
@section('scripts')
{{-- <script src="{{asset('/js/agent.js')}}"></script> --}}
@endsection
