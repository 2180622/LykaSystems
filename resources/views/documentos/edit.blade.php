@extends('layout.master')

{{-- Titulo da Página --}}
@section('title', 'Edição de um documento')

{{-- Estilos de CSS --}}
@section('styleLinks')
<link href="{{asset('/css/providers.css')}}" rel="stylesheet">
@endsection

{{-- Conteudo da Página --}}
@section('content')
<div class="container mt-2 ">

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
        <a href="{{route('report')}}" class="top-button">reportar problema</a>
    </div>

    <br><br>

    <div class="cards-navigation">
        <div class="title">
            <h6>Edição do {{$tipo}}:</h6>
        </div>
        <br>
        <div class="formulario-edicao shadow-sm">
            @if($tipoPAT == 'Pessoal')
                <form action="{{route('documento-pessoal.update',$documento)}}" method="post" enctype="multipart/form-data">
            @elseif($tipoPAT == 'Academico')
                <form action="{{route('documento-academico.update',$documento)}}" method="post" enctype="multipart/form-data">
            @else
                <form action="{{route('documento-transacao.update', $documento)}}" method="post" enctype="multipart/form-data">
            @endif
                @csrf
                @method('PUT')
                <div class="row">
                    <div class="col-md-12">
                        <label for="nome">Edite o documento</label>
                        <br>
                    </div>
                </div>
                <br>
                @if(strtolower($tipo) == "transacao")
                    <div class="row documento-transacao">
                        <div class="col-md-10">
                            <label for="descricao">Descrição</label>
                            <br>
                            <input value="{{old('descricao',$documento->descricao)}}" type="text" class="form-control" name="descricao" placeholder="Descrição" autocomplete="off" required><br>
                        </div>
                        <div class="col-md-2">
                            <label for="img_doc">Upload:</label>
                            <input value="{{old('img_doc',$documento->img_doc)}}" type='file' class="form-control" id="img_doc" name="img_doc" accept="application/pdf, image/*"/><br>
                        </div>
                        <div class="col-md-2">
                            <label for="valorRecebido">Valor recebido</label>
                            <br>
                            <input value="{{old('valorRecebido',$documento->valorRecebido)}}" type="number" class="form-control" name="valorRecebido" placeholder="0,00" autocomplete="off">
                        </div>
                        <div class="col-md-4">
                            <label for="tipoPagamento">Tipo pagamento</label>
                            <br>
                            <input value="{{old('tipoPagamento',$documento->tipoPagamento)}}" type="text" class="form-control" name="tipoPagamento" placeholder="Tipo pagamento" autocomplete="off" required>
                        </div>
                        <div class="col-md-3">
                            <label for="dataOperacao">Data da operação:</label>
                            <br>
                            <input value="{{old('dataOperacao',$documento->dataOperacao)}}" type="date" class="form-control" name="dataOperacao"  style="width:250px" required><br>
                        </div>
                        <div class="col-md-3">
                            <label for="dataRecebido">Data recebido:</label>
                            <br>
                            <input value="{{old('dataRecebido',$documento->dataRecebido)}}" type="date" class="form-control" name="dataRecebido" style="width:250px" ><br>
                        </div>
                        <div class="col-md-12">
                            <label for="idConta">Conta:</label><br>
                            <select name="idConta" class="form-control" required>
                                <option value="" selected></option>
                                @foreach($Contas as $conta)
                                    @if($documento->idConta == $conta->idConta)
                                        <option {{old('idConta',$documento->idConta)}} value="{{$conta->idConta}}" selected>{{$conta->numConta.' => '.$conta->descricao}}</option>
                                    @else
                                        <option {{old('idConta',$documento->idConta)}} value="{{$conta->idConta}}">{{$conta->numConta.' => '.$conta->descricao}}</option>
                                    @endif
                                @endforeach
                            </select><br>
                        </div>
                        <div class="col-md-12">
                            <label for="observacoes">Observações</label>
                            <br>
                            <textarea value="{{old('observacoes',$documento->observacoes)}}" name="observacoes" class="form-control" id="observacoes" rows="4" placeholder="Observações">
                                {{$documento->observacoes}}
                            </textarea>
                        </div>
                    </div>
                @elseif(strtolower($tipo) == "passaport")
                    <div class="row para-clone documento-passaport">
                        <span class="num" style="display: none;">2</span>

                        <div class="col-md-6">
                            <label for="img_doc">Upload:</label>
                            <input value="{{old('idConta',$documento->img_doc)}}" type='file' class="form-control" id="img_doc" name="img_doc" accept="application/pdf, image/*"/>
                        </div>
                        <div class="col-md-6">
                            <label for="numPassaport">Nº Passaport: </label>
                            <input value="{{old('idConta',$documento->numPassaport)}}" type="text" class="form-control" name="numPassaport" placeholder="Nº Passaport" autocomplete="off" required>
                        </div>
                        <div class="col-md-6">
                            <label for="dataValidPP">Data de validade: </label>
                            <input value="{{old('idConta',$documento->dataValidPP)}}" type="month" class="form-control" name="dataValidPP" value="{{date('Y-m', strtotime($documento->dataValidade))}}" style="width:250px" required><br>
                        </div>
                        <div class="col-md-6">
                            <label for="passaportPaisEmi">País de Emissão: </label>
                            <input value="{{old('idConta',$documento->passaportPaisEmi)}}" type="text" class="form-control" name="passaportPaisEmi" placeholder="Tipo pagamento" autocomplete="off" required>
                        </div>
                        <div class="col-md-6">
                            <label for="localEmissaoPP">Local de Emissão: </label>
                            <input value="{{old('idConta',$documento->localEmissaoPP)}}" type="text" class="form-control" name="localEmissaoPP" value="" style="width:250px" required ><br>
                        </div>

                        <div class="list-clones">
                            @php
                                $i=0;
                            @endphp
                            @foreach($infoKeys as $key)
                                @php
                                    $i++;
                                @endphp
                                <div class="row" id="documento-campo{{$i}}">
                                    <div class="col-md-5">
                                        <label for="nome-campo{{$i}}">Nome do Campo {{$i}}</label>
                                        <br>
                                        <input value="{{$key}}" id="nome-campo{{$i}}" type="text" class="form-control" name="nome-campo{{$i}}" placeholder="Inserir nome do campo" autocomplete="off" required>
                                    </div>
                                    <div class="col-md-5">
                                        <label for="valor-campo{{$i}}">Valor do Campo {{$i}}</label>
                                        <br>
                                        <input value="{{$infoDoc[$key]}}" id="valor-campo{{$i}}" type="text" class="form-control" name="valor-campo{{$i}}" placeholder="Inserir valor do campo" autocomplete="off" required>
                                    </div>
                                    <div class="col-md-2">
                                        <br><button type="button" onclick="removeCampo({{$i}},$(this).closest('#documento-campo{{$i}}'))" class="top-button">Remover {{$i}}</button>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        <div>
                            <button id="passaport-button" type="button" onclick="addCampo($(this).closest('.para-clone'))" class="top-button">Adicionar campo</button>
                        </div>
                    </div>
                @else
                    <div class="para-clone documento">
                        <span class="num" style="display: none;">2</span>
                        <div class="row">
                            <div class="col-md-5">
                                <label for="img_doc">Upload:</label>
                                <input type='file' class="form-control" id="img_doc" name="img_doc" accept="application/pdf, image/*" />
                            </div>
                            @if($tipoPAT == "Academico")
                                <div class="col-md-5">
                                    <label for="nome">Nome: </label>
                                    <input type="text" class="form-control" name="nome" placeholder="Nome" value="{{old('idConta',$documento->nome)}}" autocomplete="off" required>
                                </div>
                            @else
                                <div class="col-md-5">
                                    <label for="dataValidade">Data de validade: </label>
                                    <input type="month" class="form-control"  id="dataValidade" name="dataValidade" value="{{date('Y-m', strtotime($documento->dataValidade))}}" style="width:250px" required><br>
                                </div>
                            @endif
                        </div>
                        <div class="list-clones">
                            @php
                                $i=0;
                            @endphp
                            @foreach($infoKeys as $key)
                                @php
                                    $i++;
                                @endphp
                                <div class="row" id="documento-campo{{$i}}">
                                    <div class="col-md-5">
                                        <label for="nome-campo{{$i}}">Nome do Campo {{$i}}</label>
                                        <br>
                                        <input value="{{$key}}" id="nome-campo{{$i}}" type="text" class="form-control" name="nome-campo{{$i}}" placeholder="Inserir nome do campo" autocomplete="off" required>
                                    </div>
                                    <div class="col-md-5">
                                        <label for="valor-campo{{$i}}">Valor do Campo {{$i}}</label>
                                        <br>
                                        <input value="{{$infoDoc[$key]}}" id="valor-campo{{$i}}" type="text" class="form-control" name="valor-campo{{$i}}" placeholder="Inserir valor do campo" autocomplete="off" required>
                                    </div>
                                    <div class="col-md-2">
                                        <br><button type="button" onclick="removeCampo({{$i}},$(this).closest('#documento-campo{{$i}}'))" class="top-button">Remover {{$i}}</button>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        <div>
                            <br><button id="else-button" type="button" onclick="addCampo($(this).closest('.para-clone'))" class="top-button">Adicionar campo</button>
                        </div>
                    </div>
                @endif
            </div>

            <div class="row clones" id="clonar">
                <div class="col-md-5">
                    <br><label id="label1" for="nome-campo">Nome do Campo</label>
                    <br>
                    <input id="input1" type="text" class="form-control" name="nome-campo" placeholder="Inserir nome do campo" autocomplete="off" required>
                </div>
                <div class="col-md-5">
                    <br><label id="label2" for="valor-campo">Valor do Campo</label>
                    <br>
                    <input id="input2" type="text" class="form-control" name="valor-campo" placeholder="Inserir valor do campo" autocomplete="off" required>
                </div>
                <div class="col-md-2">
                    <br><br><button id="clone-button" type="button" onclick="" class="top-button">Remover 1</button>
                </div>
            </div>
            <div class="form-group text-right">
                <br>
                <button type="submit" class="top-button mr-2" name="ok" id="buttonSubmit">Alterar documento</button>
                <a href="javascript:history.go(-1)" class="cancel-button">Cancelar</a>
            </div>
        </form>
        <br>
    </div>
</div>

@section('scripts')
    <script type="text/javascript">
        var clones = $('#clonar').clone();
        $('#clonar').remove();

        function addCampo(closest){
            var num = parseInt(closest.find('.num').first().text());
            var clone = clones.clone();
            closest.find('.num').first().text(num+1);
            clone.attr('id','documento-campo'+num);
            $('#label1', clone).text("Nome do campo "+num+":");
            $('#label1', clone).attr('for','nome-campo'+num);
            $('#input1', clone).attr('name','nome-campo'+num);
            $('#input1', clone).attr('id','nome-campo'+num);
            $('#label2', clone).text("Valor do campo "+num+":");
            $('#label2', clone).attr('for','valor-campo'+num);
            $('#input2', clone).attr('name','valor-campo'+num);
            $('#input2', clone).attr('id','valor-campo'+num);
            $('button', clone).attr('onclick','removeCampo('+num+',$(this).closest("#documento-campo'+num+'"))');
            $('button', clone).attr('id','javascript-button');
            $('button', clone).text('Remover '+num);
            closest.find('.list-clones').first().append(clone);
        }

        function removeCampo(num,closest){
            $('#nome-campo'+num).val(null);
            $('#valor-campo'+num).val(null);
            $("#nome-campo"+num).attr("required", false);
            $("#valor-campo"+num).attr("required", false);
            closest.css("display", "none");
        }
    </script>
@endsection

@endsection
