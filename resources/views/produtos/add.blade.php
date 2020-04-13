@extends('layout.master')

{{-- Page Title --}}
@section('title', 'Adicionar produto')

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
            <h6>Adicionar produto</h6>
        </div>
        <br>
        <form method="POST" action="{{route('produtos.store')}}" class="form-group needs-validation pt-3" id="form_produto"
            enctype="multipart/form-data" novalidate>
            @csrf<div class="tab-content p-2 mt-3" id="myTabContent">

                {{-- Conteudo: Informação pessoal --}}
                <div>
                    <div class="row">
                        <div class="col">
                            {{-- INPUT nome --}}
                            <label for="nome">Cliente: 
                                <a class="name_link" href="{{route('clients.show',$cliente)}}">
                                    {{$cliente->nome.' '.$cliente->apelido}}
                                </a>
                            </label>
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col">
                            <label for="nome">Escolha o produto: </label>
                            <select class="form-control" id="produto" onchange="AtualizaProduto()">
                                <option value="" selected hidden></option>
                                @foreach($produtoStock as $prodS)
                                    @php
                                        $faseS = $prodS->faseStock->toArray();
                                    @endphp
                                    <option value="{{$prodS->idProdutoStock}}">{{$prodS->tipo."\t".$prodS->descricao."\t".count($faseS).' fases'}}</option>
                                @endforeach
                            </select><br><br>
            
                            <div><span><b>Produto</b></span></div><br>
            
                            <label for="tipo">Tipo:</label><br>
                            <input type="text" class="form-control" name="tipo" id="tipo" 
                            value="{{old('tipo',$produto->tipo)}}" placeholder="Tipo" maxlength="20" required {{--disabled--}}><br>
            
                            <label for="descricao">Descrição:</label><br>
                            <input type="text" class="form-control" name="descricao" id="descricao" 
                            value="{{old('descricao',$produto->descricao)}}" placeholder="Descricao" maxlength="20" required {{--disabled--}}><br>
            
                            <label for="AnoAcademico">Ano académico:</label><br>
                            <input type="text" class="form-control" name="anoAcademico" id="anoAcademico" 
                            value="{{old('anoAcademico',$produto->anoAcademico)}}" placeholder="Ano Academico" maxlength="20" required {{--disabled--}}><br>
            
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
                </div>
            

                <ul class="nav nav-tabs mt-5 mb-4" id="myTab" role="tablist">
                    @php
                        $num = 0;
                    @endphp
                    @foreach($Fases as $fase)
                        @php
                            $num++;
                        @endphp
                        @if($num == 1)
                            <li class="nav-item" style="width:25%; min-width:110px">
                                <a class="nav-link active" id="fase{{$num}}-tab" data-toggle="tab" href="#fase{{$num}}" role="tab"
                                    aria-controls="fase{{$num}}" aria-selected="false">Fase {{$num}}</a>
                            </li>
                        @else
                            <li class="nav-item" style="width:25%; min-width:144px">
                                <a class="nav-link" id="fase{{$num}}-tab" data-toggle="tab" href="#fase{{$num}}" role="tab"
                                    aria-controls="fase{{$num}}" aria-selected="false">Fase {{$num}}</a>
                            </li>
                        @endif
                    @endforeach
                </ul>

                @php
                    $num = 0;
                @endphp
                    @foreach ($Fases as $fase)
                    @php
                        $num++;
                    @endphp
                    @if($num==1)
                        <div class="tab-pane fade active show" id="fase{{$num}}" role="tabpanel" aria-labelledby="fase{{$num}}-tab">
                    @else 
                        <div class="tab-pane fade" id="fase{{$num}}" role="tabpanel" aria-labelledby="fase{{$num}}-tab">
                    @endif
                        <div class="row">
                            <div class="col-md-12">
                
                                <div><span><b>Fase {{$num}}</b></span></div><br>
                
                                <label for="des-fase{{$num}}">Descrição:</label><br>
                                <input type="text" class="form-control" name="des-fase{{$num}}" id="des-fase{{$num}}" 
                                value="{{old('descricao',$fase->descricao)}}" placeholder="descricao" maxlength="20" disabled><br>
                
                                <label for="data-fase{{$num}}">Data de vencimento:</label><br>
                                <input type="date" class="form-control" name="data-fase{{$num}}" id="data-fase{{$num}}"
                                value="{{old('dataVencimento',$fase->dataVencimento)}}" style="width:250px"><br>
                            </div>
                            <div class="col mr-3">
                                <div><span><b>Responsabilidades</b></span></div><br>
                                <label for="resp-cliente-fase{{$num}}">Valor a pagar ao cliente:</label><br>
                                <input type="number" min="0" placeholder="0.00" class="form-control" name="resp-cliente-fase{{$num}}" id="resp-cliente-fase{{$num}}"
                                value="{{old('valorCliente',$Responsabilidades[$num-1]->valorCliente)}}" style="width:250px"><br>
                
                                <label for="resp-agente-fase{{$num}}">Valor a pagar ao agente:</label><br>
                                <input type="number" min="0" placeholder="0.00" class="form-control" name="resp-agente-fase{{$num}}" id="resp-agente-fase{{$num}}"
                                value="{{old('valorAgente',$Responsabilidades[$num-1]->valorAgente)}}" style="width:250px"><br>
                
                                <label for="resp-subagente-fase{{$num}}">Valor a pagar ao sub-agente:</label><br>
                                <input type="number" min="0" placeholder="0.00" class="form-control" name="resp-subagente-fase{{$num}}" id="resp-subagente-fase{{$num}}"
                                value="{{old('valorSubAgente',$Responsabilidades[$num-1]->valorSubAgente)}}" style="width:250px"><br>
                
                                <label for="resp-uni1-fase{{$num}}">Valor a pagar á universidade principal:</label><br>
                                <input type="number" min="0" placeholder="0.00" class="form-control" name="resp-uni1-fase{{$num}}" id="resp-uni1-fase{{$num}}"
                                value="{{old('valorUniversidade1',$Responsabilidades[$num-1]->valorUniversidade1)}}" style="width:250px"><br>
                
                                <label for="resp-uni2-fase{{$num}}">Valor a pagar á universidade secundária:</label><br>
                                <input type="number" min="0" placeholder="0.00" class="form-control" name="resp-uni2-fase{{$num}}" id="resp-uni2-fase{{$num}}"
                                value="{{old('valorUniversidade2',$Responsabilidades[$num-1]->valorUniversidade2)}}" style="width:250px"><br>
                            </div>

                            <div class="col" style="min-width:225px">
                                <div><span><b>Fornecedores</b></span></div><br>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="form-group text-right">
                <br><br>
                <button type="submit" class="top-button mr-2" name="ok" id="buttonSubmit">Adicionar produto</button>
                <a href="javascript:history.go(-1)" class="top-button">Cancelar</a>
            </div>
        </form>
    </div>
</div>

@endsection


{{-- Scripts --}}
@section('scripts')
    <script>
        function AtualizaProduto(){
            var idproduto = new Array;
            $("select.toolbar-escolha#produto").each(function () {
                idproduto.push(this.value);
            });
            if(idproduto){
                AjaxProdutos(idproduto[0]);
            }
        }
        function AjaxProdutos(idproduto){
            var link = '/../api/stock/produto/'+idproduto;
            $.ajax({
                method:"GET",
                url:link
            })
            .done(function(response){
                if(response.produto != null){
                    $('#tipo', clone).attr('value', response.produto.tipo);
                    $('#descricao', clone).attr('value', response.produto.descricao);
                    $('#anoAcademico', clone).attr('value', response.produto.anoAcademico);
                    if(response.fases != null)
                        var num = 0;
                        for (var i = 0; i < response.fases.length; i++) {
                            num++;
                            $('#des-fase'+num, clone).attr('value', response.fase[i].descricao);
                            $('#descricao', clone).attr('value', response.produto.descricao);
                            $('#anoAcademico', clone).attr('value', response.produto.anoAcademico);
                        }
                    }
                }
            })
        }
    </script>

    {{-- script contem: datatable configs, input configs, validações --}}
    <script src="{{asset('/js/produtos.js')}}"></script>

    {{-- script permite definir se um input recebe só numeros OU so letras --}}
    <script src="{{asset('/js/jquery-key-restrictions.min.js')}}"></script>

@endsection
