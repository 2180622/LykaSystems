@extends('layout.master')

{{-- Titulo da Página --}}
@section('title', 'Adicionar documento')

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
            <h6>Novo {{$TipoDocumento}}</h6>
        </div>
        <br>
        <div class="payment-card shadow-sm">
            @if($tipoPAT == 'Pessoal')
                <form action="{{route('documento_pessoal.store', $fase)}}" method="post" enctype="multipart/form-data">
            @elseif($tipoPAT == 'Academico')
                <form action="{{route('documento_academico.store', $fase)}}" method="post" enctype="multipart/form-data">
            @else
                <form action="{{route('documento_transacao.store', $fase)}}" method="post" enctype="multipart/form-data">
            @endif
                @csrf
                <div class="row">
                    <div class="col-md-12">
                        <label for="nome">Insira o documento</label>
                        <br>
                    </div>
                </div>
                <br><br>
                @if($TipoDocumento == "Documento Transação")
                    <div class="row para-clone documento-transacao">
                        <span class="num" style="display: none;">1</span>
                        <div class="clones" id="clonar">
                            <div class="col-md-12">
                                <label for="descricao">Descrição</label>
                                <br>
                                <input type="text" class="form-control" name="descricao" placeholder="Descrição" autocomplete="off" required>
                            </div>
                            <div class="col-md-6">
                                <label for="valorRecebido">Valor</label>
                                <br>
                                <input type="number" class="form-control" name="valorRecebido" placeholder="0,00" autocomplete="off" required>
                            </div>
                            <div class="col-md-6">
                                <label for="tipoPagamento">Tipo pagamento</label>
                                <br>
                                <input type="text" class="form-control" name="tipoPagamento" placeholder="Tipo pagamento" autocomplete="off" required>
                            </div>
                            <div class="col-md-6">
                                <label for="dataOperacao">Data da operação:</label>
                                <br>
                                <input type="date" class="form-control" name="dataOperacao" value="" style="width:250px" required><br>
                            </div>
                            <div class="col-md-6">
                                <label for="dataRecebido">Data recebido:</label>
                                <br>
                                <input type="date" class="form-control" name="dataRecebido" value="" style="width:250px" ><br>
                            </div>
                            <div class="col-md-10">
                                <label for="idConta">Conta:</label><br>
                                <select name="idConta" class="form-control" required>
                                    <option value="" selected></option>
                                    @foreach($Contas as $conta)
                                        <option {{old('idConta',$documento->idConta)}} value="{{$conta->idConta}}">{{$conta->numConta.' => '.$conta->descricao}}</option>
                                    @endforeach
                                </select><br>
                            </div>
                        </div>
                        <div>
                            <button type="button" onclick="addCampo($(this).closest('.para-clone'))" class="top-button">Adicionar campo</button>
                        </div>
                    </div>
                @elseif($TipoDocumento == "Passaport")
                    <div class="row para-clone documento-passaport">
                        <span class="num" style="display: none;">1</span>

                        <div class="col-md-6">
                            <label for="numPassaport">Nº Passaport: </label>
                            <input type="text" class="form-control" name="numPassaport" placeholder="Nº Passaport" autocomplete="off" required>
                        </div>
                        <div class="col-md-6">
                            <label for="dataValidPP">Data de validade: </label>
                            <input type="text" class="form-control" name="dataValidPP" value="" style="width:250px" required><br>
                        </div>
                        <div class="col-md-6">
                            <label for="passaportPaisEmi">País de Emissão: </label>
                            <input type="text" class="form-control" name="passaportPaisEmi" placeholder="Tipo pagamento" autocomplete="off" required>
                        </div>
                        <div class="col-md-6">
                            <label for="localEmissaoPP">Local de Emissão: </label>
                            <input type="text" class="form-control" name="localEmissaoPP" value="" style="width:250px" required ><br>
                        </div>

                        <div class="clones" id="clonar">
                            <div class="col-md-3">
                                <label for="nome-campo">Nome do Campo</label>
                                <br>
                                <input type="text" class="form-control" name="nome-campo" placeholder="Inserir nome do campo" autocomplete="off" required>
                            </div>
                            <div class="col-md-3">
                                <label for="valor-campo">Valor do Campo</label>
                                <br>
                                <input type="text" class="form-control" name="valor-campo" placeholder="Inserir valor do campo" autocomplete="off" required>
                            </div>
                        </div>
                        <div>
                            <button type="button" onclick="addCampo($(this).closest('.para-clone'))" class="top-button">Adicionar campo</button>
                        </div>
                    </div>
                @else
                    <div class="row para-clone documento">
                        <span class="num" style="display: none;">1</span>
                        <div class="clones" id="clonar">
                            <div class="col-md-3">
                                <label for="nome-campo">Nome do Campo</label>
                                <br>
                                <input type="text" class="form-control" name="nome-campo" placeholder="Inserir nome do campo" autocomplete="off" required>
                            </div>
                            <div class="col-md-3">
                                <label for="valor-campo">Valor do Campo</label>
                                <br>
                                <input type="text" class="form-control" name="valor-campo" placeholder="Inserir valor do campo" autocomplete="off" required>
                            </div>
                        </div>
                        <div>
                            <button type="button" onclick="addCampo($(this).closest('.para-clone'))" class="top-button">Adicionar campo</button>
                        </div>
                    </div>
                @endif
            </div>
            <div class="form-group text-right">
                <br>
                <button type="submit" class="top-button mr-2" name="ok" id="buttonSubmit">Adicionar documento</button>
                <a href="javascript:history.go(-1)" class="cancel-button">Cancelar</a>
            </div>
        </form>
        <br>
    </div>
</div>

@section('scripts')
    <script type="text/javascript">
        var clones = $('#clonar').clone();
        $(".clones").remove();

        function addCampo(closest){
	        var num = parseInt(closest.find('.num').first().text());
			var clone = clones.clone();
	        closest.find('.num').first().text(num+1);
			clone.attr('id','campo-documento'+num);
			$('#label1', clone).text("Fornecedor "+numF+":");
			$('#label1', clone).attr('for','fornecedor'+numF+'-fase'+idFase);
			$('select', clone).attr('id','fornecedor'+numF+'-fase'+idFase);
			$('select', clone).attr('name','fornecedor'+numF+'-fase'+idFase);
			$('#label2', clone).attr('for','valor-fornecedor'+numF+'-fase'+idFase);
			$('#valor-fornecedor-fase'+idFase, clone).attr('id','valor-fornecedor'+numF+'-fase'+idFase);
			$('#valor-fornecedor-fase'+idFase, clone).attr('name','valor-fornecedor'+numF+'-fase'+idFase);
			$('#label3', clone).text('Data de vencimento do pagamento ao fornecedor'+numF+':');
			$('#label3', clone).attr('for','data-fornecedor'+numF+'-fase'+idFase);
			$('#data-fornecedor-fase'+idFase, clone).attr('id','data-fornecedor'+numF+'-fase'+idFase);
			$('#data-fornecedor-fase'+idFase, clone).attr('name','data-fornecedor'+numF+'-fase'+idFase);
			$('button', clone).attr('onclick','removerFornecedor('+numF+','+idFase+',$(this).closest("#div-fornecedor'+numF+'-fase'+idFase+'"))');
			$('button', clone).text('Remover fornecedor '+numF);
	        closest.find('.fornecedor').first().append(clone);
        }
    </script>
@endsection

@endsection
