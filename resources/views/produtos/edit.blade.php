@extends('layout.master')

{{-- Page Title --}}
@section('title', 'Editar informações')

{{-- CSS Style Link --}}
@section('styleLinks')
    <link href="{{asset('css/produtos.css')}}" rel="stylesheet">
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
            <a href="#" class="top-button">reportar problema</a>
        </div>

        <br><br>

        <div class="cards-navigation">
            <div class="title">
                <h6>Editar informações</h6>
            </div>
            <br>


            <form method="POST" action="{{route('produtos.update',$produto)}}" class="form-group needs-validation pt-3" id="form_client"
                  enctype="multipart/form-data" novalidate>
                @csrf
                @method("PUT")
                <div class="row">
                    <div class="col">
                        {{-- INPUT nome --}}
                        <label for="nome">Cliente: 
                            <a class="name_link" href="{{route('clients.show',$produto->cliente)}}">
                                {{$produto->cliente->nome.' '.$produto->cliente->apelido}}
                            </a>
                        </label>
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col">
                        <div><span><b>Produto</b></span></div><br>
                
                        <label for="tipo">Tipo:</label><br>
                        <input type="text" class="form-control" name="tipo" id="tipo" 
                        value="{{old('tipo',$produto->tipo)}}" placeholder="Tipo" maxlength="20" readonly><br>
                
                        <label for="descricao">Descrição:</label><br>
                        <input type="text" class="form-control" name="descricao" id="descricao" 
                        value="{{old('descricao',$produto->descricao)}}" placeholder="Descricao" maxlength="20" readonly><br>
                
                        <label for="AnoAcademico">Ano académico:</label><br>
                        <input type="text" class="form-control" name="AnoAcademico" id="AnoAcademico" 
                        value="{{old('anoAcademico',$produto->anoAcademico)}}" placeholder="Ano Academico" maxlength="20" required><br>
                
                        <label for="agente">Agente:</label><br>
                        <select id="agente" name="agente" class="form-control" required>
                            <option value="" selected hidden></option>
                            @foreach($Agentes as $agente)
                                <option {{old('idAgente',$produto->idAgente)}} value="{{$agente->idAgente}}">{{$agente->nome.' '.$agente->apelido.' -> '.$agente->email}}</option>
                            @endforeach
                        </select><br>
                
                        <label for="subagente">Sub-Agente:</label><br>
                        <select id="subagente" name="subagente" class="form-control">
                            <option value="" selected hidden></option>
                            @foreach($SubAgentes as $subagente)
                                <option {{old('idSubAgente',$produto->idSubAgente)}} value="{{$subagente->idAgente}}">{{$subagente->nome.' '.$subagente->apelido.' -> '.$subagente->email}}</option>
                            @endforeach
                        </select><br>
                
                        <label for="uni1">Universidade Principal:</label><br>
                        <select id="uni1" name="uni1" class="form-control" required>
                            <option value="" selected hidden></option>
                            @foreach($Universidades as $uni)
                                <option {{old('idUniversidade1',$produto->idUniversidade1)}} value="{{$uni->idUniversidade}}">{{$uni->nome.' -> '.$uni->email}}</option>
                            @endforeach
                        </select><br>
                
                        <label for="uni2">Universidade Secundária:</label><br>
                        <select id="uni2" name="uni2" class="form-control">
                            <option value="" selected hidden></option>
                            @foreach($Universidades as $uni)
                                <option {{old('idUniversidade2',$produto->idUniversidade2)}} value="{{$uni->idUniversidade}}">{{$uni->nome.' -> '.$uni->email}}</option>
                            @endforeach
                        </select><br>
                
                    </div>
                </div>
                <div class="tab-content p-2 mt-3" id="myTabContent">
                    <ul class="nav nav-tabs mt-5 mb-4 fases" id="myTab" role="tablist">
                        <li class="nav-item clonar" style="width:25%">
                            @php
                                $num=0;
                            @endphp
                            @foreach($fases as $fase)
                                @php
                                    $num++;
                                @endphp
                                @if($num == 1)
                                    <a class="nav-link active" id="fase{{$num}}-tab" data-toggle="tab" href="#fase{{$num}}" role="tab"
                                    aria-controls="fase{{$num}}" aria-selected="false">Fase {{$num}}</a>
                                @else
                                    <a class="nav-link" id="fase{{$num}}-tab" data-toggle="tab" href="#fase{{$num}}" role="tab"
                                    aria-controls="fase{{$num}}" aria-selected="false">Fase {{$num}}</a>
                                @endif
                            @endforeach
                        </li>
                    </ul>
                
                    @php
                        $num=0;
                    @endphp
                    @foreach($fases as $fase)
                        @php
                            $num++;
                            $responsabilidade = $fase->responsabilidade;
                            $relacoes = $responsabilidade->relacao;
                        @endphp
                        @if($num == 1)
                            <div class="tab-pane fade show active" id="fase{{$num}}" role="tabpanel" aria-labelledby="fase{{$num}}-tab">
                        @else
                            <div class="tab-pane fade" id="fase{{$num}}" role="tabpanel" aria-labelledby="fase{{$num}}-tab">
                        @endif
                            <div class="row">
                                <div class="col-md-12">
                
                                    <div><span><b>Fase {{$num}}</b></span></div><br>
                
                                    <label for="descricao-fase{{$num}}">Descrição:</label><br>
                                    <input type="text" class="form-control" name="descricao-fase{{$num}}" id="descricao-fase{{$num}}" 
                                    value="{{old('descricao',$fase->descricao)}}" placeholder="descricao" maxlength="20" readonly><br>
                
                                    <label for="data-fase{{$num}}">Data de vencimento:</label><br>
                                    <input type="date" class="form-control" name="data-fase{{$num}}" id="data-fase{{$num}}"
                                    value="{{old('dataVencimento',$fase->dataVencimento)}}" style="width:250px" required><br>
                                    
                                    <div><span><b>Responsabilidades</b></span></div><br>
                                    <label for="resp-cliente-fase{{$num}}">Valor a pagar ao cliente:</label><br>
                                    <input type="number" class="form-control" name="resp-cliente-fase{{$num}}" id="resp-cliente-fase{{$num}}"
                                    value="{{old('valorCliente',$responsabilidade->valorCliente)}}" style="width:250px" required><br>
                
                                    <label for="resp-agente-fase{{$num}}">Valor a pagar ao agente:</label><br>
                                    <input type="number" class="form-control" name="resp-agente-fase{{$num}}" id="resp-agente-fase{{$num}}"
                                    value="{{old('valorAgente',$responsabilidade->valorAgente)}}" style="width:250px" required><br>
                
                                    <label for="resp-subagente-fase{{$num}}">Valor a pagar ao sub-agente:</label><br>
                                    <input type="number" class="form-control" name="resp-subagente-fase{{$num}}" id="resp-subagente-fase{{$num}}"
                                    value="{{old('valorSubAgente',$responsabilidade->valorSubAgente)}}" style="width:250px"><br>
                
                                    <label for="resp-uni1-fase{{$num}}">Valor a pagar á universidade principal:</label><br>
                                    <input type="number" class="form-control" name="resp-uni1-fase{{$num}}" id="resp-uni1-fase{{$num}}"
                                    value="{{old('valorUniversidade1',$responsabilidade->valorUniversidade1)}}" style="width:250px" required><br>
                
                                    <label for="resp-uni2-fase{{$num}}">Valor a pagar á universidade secundária:</label><br>
                                    <input type="number" class="form-control" name="resp-uni2-fase{{$num}}" id="resp-uni2-fase{{$num}}"
                                    value="{{old('valorUniversidade2',$responsabilidade->valorUniversidade2)}}" style="width:250px"><br>
                
                                    @if($relacoes->toArray())
                                        <div><span>Fornecedores:</span></div><br>
                                        @foreach ($relacoes as $relacao)
                                            @foreach($Fornecedores as $fornecedor)
                                                @if($fornecedor->idFornecedor == $relacao->idFornecedor)
                                                    <label for="resp-uni2-fase{{$num}}">Valor a pagar a {{$relacao->fornecedor->nome}}:</label><br>
                                                    <input type="text" class="form-control" name="resp-uni2-fase{{$num}}" id="resp-uni2-fase{{$num}}"
                                                    value="{{old('valor',$relacao->valor)}}" style="width:250px" required><br>
                                            @endforeach
                                        @endforeach
                                    @endif
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                <div class="form-group text-right">
                    <br><br>
                    <button type="submit" class="top-button mr-2" name="submit"></i>Guardar ficha</button>
                    <a href="javascript:history.go(-1)" class="top-button">Cancelar</a>
                </div>
            </form>


        </div>
    </div>
@endsection





{{-- Scripts --}}
@section('scripts')

    {{-- script contem: datatable configs, input configs, validações --}}
    <script src="{{asset('/js/produtos.js')}}"></script>

    {{-- script permite definir se um input recebe só numeros OU so letras --}}
    <script src="{{asset('/js/jquery-key-restrictions.min.js')}}"></script>

@endsection
