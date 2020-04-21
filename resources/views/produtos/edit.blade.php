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


            <form method="POST" action="{{route('produtos.update',$produto)}}" class="form-group needs-validation pt-3" id="form_produto"
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
                
                        <label for="anoAcademico">Ano académico:</label><br>
                        <input type="text" class="form-control" name="anoAcademico" id="anoAcademico" 
                        value="{{old('anoAcademico',$produto->anoAcademico)}}" placeholder="Ano Academico" maxlength="20" required><br>
                
                        <label for="agente">Agente:</label><br>
                        <select id="agente" name="agente" class="form-control" required>
                            <option value="" selected hidden></option>
                            @foreach($Agentes as $agente)
                                @if($agente->idAgente == $produto->idAgente)
                                    <option {{old('idAgente',$produto->idAgente)}} value="{{$agente->idAgente}}" selected>{{$agente->nome.' '.$agente->apelido.' -> '.$agente->email}}</option>
                                @else
                                    <option {{old('idAgente',$produto->idAgente)}} value="{{$agente->idAgente}}">{{$agente->nome.' '.$agente->apelido.' -> '.$agente->email}}</option>
                                @endif
                            @endforeach
                        </select><br>
                
                        <label for="subagente">Sub-Agente:</label><br>
                        <select id="subagente" name="subagente" class="form-control">
                            <option value="" selected hidden></option>
                            @foreach($SubAgentes as $subagente)
                                @if($subagente->idAgente == $produto->idSubAgente)
                                    <option {{old('idSubAgente',$produto->idSubAgente)}} value="{{$subagente->idAgente}}" selected>{{$subagente->nome.' '.$subagente->apelido.' -> '.$subagente->email}}</option>
                                @else
                                    <option {{old('idSubAgente',$produto->idSubAgente)}} value="{{$subagente->idAgente}}">{{$subagente->nome.' '.$subagente->apelido.' -> '.$subagente->email}}</option>
                                @endif
                            @endforeach
                        </select><br>
                
                        <label for="uni1">Universidade Principal:</label><br>
                        <select id="uni1" name="uni1" class="form-control" required>
                            <option value="" selected hidden></option>
                            @foreach($Universidades as $uni)
                                @if($uni->idUniversidade == $produto->idUniversidade1)
                                    <option {{old('idUniversidade1',$produto->idUniversidade1)}} value="{{$uni->idUniversidade}}" selected>{{$uni->nome.' -> '.$uni->email}}</option>
                                @else
                                    <option {{old('idUniversidade1',$produto->idUniversidade1)}} value="{{$uni->idUniversidade}}">{{$uni->nome.' -> '.$uni->email}}</option>
                                @endif
                            @endforeach
                        </select><br>
                
                        <label for="uni2">Universidade Secundária:</label><br>
                        <select id="uni2" name="uni2" class="form-control">
                            <option value="" selected hidden></option>
                            @foreach($Universidades as $uni)
                                @if($uni->idUniversidade == $produto->idUniversidade2)
                                    <option {{old('idUniversidade2',$produto->idUniversidade2)}} value="{{$uni->idUniversidade}}" selected>{{$uni->nome.' -> '.$uni->email}}</option>
                                @else
                                    <option {{old('idUniversidade2',$produto->idUniversidade2)}} value="{{$uni->idUniversidade}}">{{$uni->nome.' -> '.$uni->email}}</option>
                                @endif
                            @endforeach
                        </select>
                
                    </div>
                </div>
                <div class="tab-content p-2 mt-3" id="myTabContent">
                    <ul class="nav nav-tabs mt-5 mb-4 fases" id="myTab" role="tablist">
                        @php
                            $num=0;
                        @endphp
                        @foreach($fases as $fase)
                            @php
                                $num++;
                            @endphp
                            @if($num == 1)
                                <li class="nav-item" style="width:25%">
                                    <a class="nav-link active" id="fase{{$num}}-tab" data-toggle="tab" href="#fase{{$num}}" role="tab"
                                    aria-controls="fase{{$num}}" aria-selected="false">Fase {{$num}}</a>
                                </li>
                            @else
                                <li class="nav-item" style="width:25%">
                                    <a class="nav-link" id="fase{{$num}}-tab" data-toggle="tab" href="#fase{{$num}}" role="tab"
                                    aria-controls="fase{{$num}}" aria-selected="false">Fase {{$num}}</a>
                                </li>
                            @endif
                        @endforeach
                    </ul>
                
                    @php
                        $num=0;
                    @endphp
                    @foreach($fases as $fase)
                        @php
                            $num++;
                            $numF = 0;
                            $responsabilidade = $fase->responsabilidade;
                            $relacoes = $responsabilidade->relacao;
                        @endphp
                        @if($num == 1)
                            <div class="tab-pane fade show active" id="fase{{$fase->idFase}}" role="tabpanel" aria-labelledby="fase{{$fase->idFase}}-tab">
                        @else
                            <div class="tab-pane fade" id="fase{{$fase->idFase}}" role="tabpanel" aria-labelledby="fase{{$fase->idFase}}-tab">
                        @endif
                            <div class="row">
                                <div class="col-md-12">
                
                                    <div><span><b>Fase {{$num}}</b></span></div><br>
                
                                    <label for="descricao-fase{{$fase->idFase}}">Descrição:</label><br>
                                    <input type="text" class="form-control" name="descricao-fase{{$fase->idFase}}" id="descricao-fase{{$fase->idFase}}" 
                                    value="{{old('descricao',$fase->descricao)}}" placeholder="descricao" maxlength="20" readonly><br>
                
                                    <label for="data-fase{{$fase->idFase}}">Data de vencimento:</label><br>
                                    <input type="date" class="form-control" name="data-fase{{$fase->idFase}}" id="data-fase{{$fase->idFase}}"
                                    value="{{date_create(old('dataVencimento',$fase->dataVencimento))->format('Y-m-d')}}" style="width:250px" required><br>
                                    
                                    <div><span><b>Responsabilidades</b></span></div><br>
                                    <label for="resp-cliente-fase{{$fase->idFase}}">Valor a pagar ao cliente:</label><br>
                                    <input type="number" class="form-control" name="resp-cliente-fase{{$fase->idFase}}" id="resp-cliente-fase{{$fase->idFase}}"
                                    value="{{old('valorCliente',$responsabilidade->valorCliente)}}" style="width:250px" required><br>
                
                                    <label for="resp-agente-fase{{$fase->idFase}}">Valor a pagar ao agente:</label><br>
                                    <input type="number" class="form-control" name="resp-agente-fase{{$fase->idFase}}" id="resp-agente-fase{{$fase->idFase}}"
                                    value="{{old('valorAgente',$responsabilidade->valorAgente)}}" style="width:250px" required><br>
                
                                    <label for="resp-subagente-fase{{$fase->idFase}}">Valor a pagar ao sub-agente:</label><br>
                                    <input type="number" class="form-control" name="resp-subagente-fase{{$fase->idFase}}" id="resp-subagente-fase{{$fase->idFase}}"
                                    value="{{old('valorSubAgente',$responsabilidade->valorSubAgente)}}" style="width:250px"><br>
                
                                    <label for="resp-uni1-fase{{$fase->idFase}}">Valor a pagar á universidade principal:</label><br>
                                    <input type="number" class="form-control" name="resp-uni1-fase{{$fase->idFase}}" id="resp-uni1-fase{{$fase->idFase}}"
                                    value="{{old('valorUniversidade1',$responsabilidade->valorUniversidade1)}}" style="width:250px" required><br>
                
                                    <label for="resp-uni2-fase{{$fase->idFase}}">Valor a pagar á universidade secundária:</label><br>
                                    <input type="number" class="form-control" name="resp-uni2-fase{{$fase->idFase}}" id="resp-uni2-fase{{$fase->idFase}}"
                                    value="{{old('valorUniversidade2',$responsabilidade->valorUniversidade2)}}" style="width:250px"><br>
                
                                    @if($relacoes->toArray())

                                        <div class="col list-fornecedores" style="min-width:225px">
                                            <div><span><b>Fornecedores</b></span></div><br>
                                            <span class="numF" style="display: none;">{{count($relacoes->array())+1}}</span>
                                            <div class="fornecedor">
                                                <div class="clones" id="clonar">
                                                    <label class="label1" for="fornecedor-fase{{$fase->idFase}}">Fornecedor 0:</label><br>
                                                    <select id="fornecedor-fase{{$fase->idFase}}" name="fornecedor-fase{{$fase->idFase}}" class="form-control" required>
                                                        <option value="" selected hidden></option>
                                                        @foreach($Fornecedores as $fornecedor)
                                                            <option {{old('idFornecedor',$relacao->idFornecedor)}} value="{{$fornecedor->idFornecedor}}">{{$fornecedor->nome.' -> '.$fornecedor->descricao}}</option>
                                                        @endforeach
                                                    </select><br>
                                                    <label class="label2" for="valor-fornecedor-fase{{$fase->idFase}}">Valor a pagar:</label><br>
                                                    <input type="number" min="0" class="form-control" name="valor-fornecedor-fase{{$fase->idFase}}" id="valor-fornecedor-fase{{$fase->idFase}}"
                                                    value="{{old('valor',$relacao->valor)}}" style="width:250px" required><br>
                                                </div>
                                                @foreach ($relacoes as $relacao)
                                                    @php
                                                        $numF++;
                                                    @endphp
                                                    <div id="div-relacao{{$relacao->idRelacao}}">
                                                        <label class="label1" for="fornecedor{{$numF}}-fase{{$fase->idFase}}">Fornecedor {{$numF}}:</label><br>
                                                        <select id="fornecedor{{$numF}}-fase{{$fase->idFase}}" name="fornecedor{{$numF}}-fase{{$fase->idFase}}" class="form-control" required>
                                                            <option value="" selected hidden></option>
                                                            @foreach($Fornecedores as $fornecedor)
                                                                <option {{old('idFornecedor',$relacao->idFornecedor)}} value="{{$fornecedor->idFornecedor}}">{{$fornecedor->nome.' -> '.$fornecedor->descricao}}</option>
                                                            @endforeach
                                                        </select><br>
                                                        <label class="label2" for="valor-fornecedor{{$numF}}-fase{{$fase->idFase}}">Valor a pagar:</label><br>
                                                        <input type="number" min="0" class="form-control" name="valor-fornecedor{{$numF}}-fase{{$fase->idFase}}" id="valor-fornecedor{{$numF}}-fase{{$fase->idFase}}"
                                                        value="{{old('valor',$relacao->valor)}}" style="width:250px" required><br>
                                                        @foreach($Fornecedores as $fornecedor)
                                                            @if($fornecedor->idFornecedor == $relacao->idFornecedor)
                                                                <label for="resp-uni2-fase{{$fase->idFase}}">Valor a pagar a {{$relacao->fornecedor->nome}}:</label><br>
                                                                <input type="text" class="form-control" name="resp-uni2-fase{{$fase->idFase}}" id="resp-uni2-fase{{$fase->idFase}}"
                                                                value="{{old('valor',$relacao->valor)}}" style="width:250px"><br>
                                                            @endif
                                                        @endforeach
                                                    </div>
                                                @endforeach
                                            </div>
                                            <div>
                                                <button type="button" onclick="addFornecedor({{$fase->idFase}},$(this).closest('.list-fornecedores'))" class="top-button">Adicionar fornecedor</button>
                                            </div>
                                        </div>
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

    <script>
        var clones = $('#clonar').clone();
        $(".clones").remove();
        $("#formulario-produto").css("display", "none");
        $("#formulario-fases").css("display", "none");


        function addFornecedor(num, closest){
	        var numF = parseInt(closest.find('.numF').first().text());
			var clone = clones.clone();
	        closest.find('.numF').first().text(numF+1);
			$('.label1', clone).text("Fornecedor "+numF+":");
			$('.label1', clone).attr('for','fornecedor'+numF+'-fase'+num);
			$('select', clone).attr('id','fornecedor'+numF+'-fase'+num);
			$('select', clone).attr('name','fornecedor'+numF+'-fase'+num);
			$('.label2', clone).attr('for','valor-fornecedor'+numF+'-fase'+num);
			$('input', clone).attr('id','valor-fornecedor'+numF+'-fase'+num);
			$('input', clone).attr('name','valor-fornecedor'+numF+'-fase'+num);
	        closest.find('.fornecedor').first().append(clone);
        }
    </script>

@endsection
