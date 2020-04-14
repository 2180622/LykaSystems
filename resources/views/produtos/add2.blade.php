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
                            value="{{old('tipo',$produto->tipo)}}" placeholder="Tipo" maxlength="20" required disabled><br>
            
                            <label for="descricao">Descrição:</label><br>
                            <input type="text" class="form-control" name="descricao" id="descricao" 
                            value="{{old('descricao',$produto->descricao)}}" placeholder="Descricao" maxlength="20" required disabled><br>
            
                            <label for="AnoAcademico">Ano académico:</label><br>
                            <input type="text" class="form-control" name="AnoAcademico" id="AnoAcademico" 
                            value="{{old('anoAcademico',$produto->anoAcademico)}}" placeholder="Ano Academico" maxlength="20" required disabled><br>
            
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
            
                <div class="tab-pane fade show active" id="Fases" role="tabpanel" aria-labelledby="Fases-tab">
                    <ul class="nav nav-tabs mt-5 mb-4 fases" id="myTab" role="tablist">
                        <li class="nav-item clonar" style="width:25%">
                            <a class="nav-link active" id="fases-tab" data-toggle="tab" href="#" role="tab"
                                aria-controls="fase" aria-selected="false">Fase</a>
                        </li>
                    </ul>
            
                    <div class="row">
                        <div class="col-md-12">
            
                            <div><span><b>Fase</b></span></div><br>
            
                            <label for="des-fase">Descrição:</label><br>
                            <input type="text" class="form-control" name="des-fase" id="des-fase" 
                            value="???" placeholder="descricao" maxlength="20" required disabled><br>
            
                            <label for="data-fase">Data de vencimento:</label><br>
                            <input type="date" class="form-control" name="data-fase" id="data-fase"
                            value="???" style="width:250px" required><br>
                            
                            <div><span><b>Responsabilidades</b></span></div><br>
            
                            <label for="resp-cliente-fase">Valor a pagar ao cliente:</label><br>
                            <input type="date" class="form-control" name="resp-cliente-fase" id="resp-cliente-fase"
                            value="???" style="width:250px" required><br>
            
                            <label for="resp-agente-fase">Valor a pagar ao agente:</label><br>
                            <input type="date" class="form-control" name="resp-agente-fase" id="resp-agente-fase"
                            value="???" style="width:250px" required><br>
            
                            <label for="resp-subagente-fase">Valor a pagar ao sub-agente:</label><br>
                            <input type="date" class="form-control" name="resp-subagente-fase" id="resp-subagente-fase"
                            value="???" style="width:250px" required><br>
            
                            <label for="resp-uni1-fase">Valor a pagar á universidade principal:</label><br>
                            <input type="date" class="form-control" name="resp-uni1-fase" id="resp-uni1-fase"
                            value="???" style="width:250px" required><br>
            
                            <label for="resp-uni2-fase">Valor a pagar á universidade secundária:</label><br>
                            <input type="date" class="form-control" name="resp-uni2-fase" id="resp-uni2-fase"
                            value="???" style="width:250px" required><br>
            
                        </div>
                    </div>
                </div>
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
        var clones = $('.clonar').clone();
        //$('.fases').html('');
        function AtualizaProduto(){
            //$('.fases').html('');
            var idproduto = new Array;
            $("select.toolbar-escolha#produto").each(function () {
                idproduto.push(this.value);
            });
            if(idproduto){
                AjaxProdutos(idproduto[0]);
            }
        }
        function AjaxProdutos(idproduto){
            var link = '/../api/stock/produtos'
            $.ajax({
                method:"GET",
                url:link
            })
            .done(function(response){
                var i;
                for (i = 0; i < response.results.length; i++) {
                    alert(response.results[i].idProduto)
                    if(response.results[i].idProduto == idproduto){
                        var clone = clones.clone();
                        if(i==0){
                            $('#fases-tab', clone).attr('class','nav-link');
                        }
                        $('#fases-tab', clone).attr('href','fase-'+response.results[i].idProduto);
                        $('#fases-tab', clone).attr('aria-controls','fase-'+response.results[i].idProduto);
                        $('#fases-tab', clone).attr('id','fase'+response.results[i].idProduto+'-tab');
                        $('.fases').append(clone);
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
