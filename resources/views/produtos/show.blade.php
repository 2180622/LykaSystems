@extends('layout.master')

{{-- Page Title --}}
@section('title', 'Ficha de produto')

{{-- CSS Style Link --}}
@section('styleLinks')

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
            <a href="{{route('produtos.edit',$produto)}}" class="top-button mr-2">Editar informação</a>
            <a href="{{route('produtos.print',$produto)}}" target="_blank" class="top-button">Imprimir</a>
        </div>

        <br><br>

        <div class="cards-navigation">
            <div class="title">
                <h6>Ficha de produto</h6>
            </div>
            <br>



            <div class="row font-weight-bold border p-2 pt-3 pb-3" style="color:#6A74C9">
                
                <!----------------------------------------------------------------------------------------->

                <div class="col p-0 text-center" style="flex: 0 0 20%; -ms-flex: 0 0 20%; min-width:195px">
                    @if ($produto->fotografia)
                        <img class="m-2 p-1 rounded bg-white shadow-sm"
                            src="{{Storage::disk('public')->url('client-photos/').$client->fotografia}}"
                            style="width:90%">
                    @else
                        @if($client->genero == 'F')
                            <img class="m-2 p-1 rounded bg-white shadow-sm"
                                src="{{Storage::disk('public')->url('default-photos/F.jpg')}}" style="width:90%">
                        @else
                            <img class="m-2 p-1 rounded bg-white shadow-sm"
                                src="{{Storage::disk('public')->url('default-photos/M.jpg')}}" style="width:90%">
                        @endif
                    @endif
                </div>
                
                <!----------------------------------------------------------------------------------------->

                <div class="col p-2">

                    {{-- Informações Pessoais --}}
                    <div><span class="text-secondary ">Tipo:</span> {{$produto->tipo}}</div><br>

                    <div><span class="text-secondary">Descrição:</span> {{$produto->descricao}}</div><br>

                    <div><span class="text-secondary ">Ano Académico: </span>{{ date('d-M-y', strtotime($produto->anoAcademico)) }}</div><br>

                    <div><span class="text-secondary">Valor:</span> {{$produto->valor}}</div>

                </div>

                <div class="col">
                    <div><span class="text-secondary">Cliente: 
                        <a class="name_link" href="{{route('clients.show',$produto->cliente)}}">
                            {{$produto->cliente->nome.' '.$produto->cliente->apelido}}</span>
                        </a>
                    </div><br>

                    <div><span class="text-secondary">Universidade: 
                        <a class="name_link" href="{{route('universities.show',$produto->universidade1)}}">
                            {{$produto->universidade1->nome}}</span>
                        </a>
                    </div><br>

                    @if($produto->idUniversidade2)
                        <div><span class="text-secondary">Universidade 2: 
                            <a class="name_link" href="{{route('universities.show',$produto->universidade2)}}">
                                {{$produto->universidade2->nome}}</span>
                            </a>
                        </div><br>
                    @endif

                    <div><span class="text-secondary">Agente: 
                        <a class="name_link" href="{{route('agents.show',$produto->agente)}}">
                            {{$produto->agente->nome.' '.$produto->agente->apelido}}</span>
                        </a>
                    </div><br>

                    @if($produto->idSubAgente)
                        <div><span class="text-secondary">Sub-Agente: 
                            <a class="name_link" href="{{route('agents.show',$produto->subAgente)}}">
                                {{$produto->subAgente->nome.' '.$produto->subAgente->apelido}}</span>
                            </a>
                        </div><br>
                    @endif

                    <div class="text-muted"><small>Adicionado: {{ date('d-M-y', strtotime($produto->created_at)) }}</small></div>

                    <div class="text-muted"><small>Ultima atualização: {{ date('d-M-y', strtotime($produto->updated_at)) }}</small></div>



                </div>

            </div>

            <ul class="nav nav-tabs mt-5 mb-4" id="myTab" role="tablist">
                @php
                    $num = 1;
                @endphp
                @foreach($Fases as $fase)
                    <li class="nav-item " style="width:25%">
                        @if($num == 1)
                    <a class="nav-link active" id="{{'fase'.$num.'-tab'}}" data-toggle="tab" href="#{{'fase'.$num}}" role="tab"
                            aria-controls="{{'fase'.$num}}" aria-selected="false">{{'Fase '.$num}}</a>
                        @else
                            <a class="nav-link" id="{{'fase'.$num.'-tab'}}" data-toggle="tab" href="#{{'fase'.$num}}" role="tab"
                            aria-controls="{{'fase'.$num}}" aria-selected="false">{{'Fase '.$num}}</a>
                        @endif
                    </li>
                @endforeach
            </ul>

            <div class="tab-content p-2 " id="myTabContent">
                @php
                    $num = 1;
                @endphp
                @foreach($Fases as $fase)
                    @if($num == 1)
                        <div class="tab-pane fade active show" id="{{'fase'.$num}}" role="tabpanel" aria-labelledby="{{'fase'.$num.'-tab'}}">
                    @else
                        <div class="tab-pane fade active" id="{{'fase'.$num}}" role="tabpanel" aria-labelledby="{{'fase'.$num.'-tab'}}">
                    @endif
                        {{--  DADOS DE PASSAPORTE --}}
                        <div class="row">

                            <div class="col">
                                {{--  numPassaport --}}
                                <div><span class="text-secondary">Número do passaporte:</span> {{$client->numPassaport}}</div>
                                <br>

                                {{--  dataValidPP --}}
                                <div><span class="text-secondary">Data de validade do passaporte:</span>
                                    {{$client->dataValidPP}}</div><br>

                                {{--  passaportPaisEmi --}}
                                <div><span class="text-secondary">Pais emissor do passaporte:</span>
                                    {{$client->passaportPaisEmi}}</div><br>

                                {{--  localEmissaoPP --}}
                                <div><span class="text-secondary">Local de emissão do passaporte:</span>
                                    {{$client->localEmissaoPP}}</div><br>

                            </div>

                            {{-- CC IDENTIFICAÇÃO --}}
                            <div class="col">
                                <div><span class="text-secondary">Número de cartão de cidadão:</span> {{$client->numCCid}}</div><br>
                                <div><span class="text-secondary">Número de identificação fiscal:</span> {{$client->NIF}}</div>
                            </div>
                        </div>
                        
                    </div>
                @endforeach
            </div>
        </div>
    </div>

@endsection

{{-- Scripts --}}
@section('scripts')
    {{-- <script src="{{asset('/js/NOME_DO_FICHEIR.js')}}"></script> --}}
@endsection
