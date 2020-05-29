@extends('layout.master')

{{-- Titulo da Página --}}
@section('title', 'Adicionar documento')

{{-- Estilos de CSS --}}
@section('styleLinks')
<link href="{{asset('/css/providers.css')}}" rel="stylesheet">
<link href="{{asset('/css/inputs.css')}}" rel="stylesheet">
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

    <br><br>

    <div class="cards-navigation">
        <div class="title">
            <h6>Novo {{$tipo}}</h6>
        </div>
        <br>
        <div class="payment-card shadow-sm">
            @if($tipoPAT == 'Pessoal')
                <form action="{{route('documento-pessoal.store', [$fase,$docnecessario])}}" method="post" enctype="multipart/form-data">
            @elseif($tipoPAT == 'Academico')
                <form action="{{route('documento-academico.store', [$fase,$docnecessario])}}" method="post" enctype="multipart/form-data">
            @else
                <form action="{{route('documento-transacao.store', $fase)}}" method="post" enctype="multipart/form-data">
            @endif
                @csrf
                <div class="row">
                    <div class="col-md-12">
                        <label for="nome">Insira o documento</label>
                        <br>
                    </div>
                </div>
                <br>
                @if(strtolower($tipo) == "transacao")
                    <div class="row documento-transacao">
                        <div class="col-md-10">
                            <label for="descricao">Descrição</label>
                            <br>
                            <input type="text" class="form-control" name="descricao" placeholder="Descrição" autocomplete="off" required><br>
                        </div>
                        <div class="col-md-2">
                            <label for="img_doc">Upload:</label>
                            <input type='file' class="form-control" id="img_doc" name="img_doc" accept="application/pdf, image/*" required/><br>
                        </div>
                        <div class="col-md-2">
                            <label for="valorRecebido">Valor recebido</label>
                            <br>
                            <input type="number" class="form-control" min="0" name="valorRecebido" placeholder="0,00" autocomplete="off" ><br>
                        </div>
                        <div class="col-md-4">
                            <label for="tipoPagamento">Tipo pagamento</label>
                            <br>
                            <input type="text" class="form-control" name="tipoPagamento" placeholder="Tipo pagamento" autocomplete="off" required><br>
                        </div>
                        <div class="col-md-3">
                            <label for="dataOperacao">Data da operação:</label>
                            <br>
                            <input type="date" class="form-control" name="dataOperacao" value="" style="width:250px" required><br>
                        </div>
                        <div class="col-md-3">
                            <label for="dataRecebido">Data recebido:</label>
                            <br>
                            <input type="date" class="form-control" name="dataRecebido" value="" style="width:250px" ><br>
                        </div>
                        <div class="col-md-12">
                            <label for="idConta">Conta:</label><br>
                            <select name="idConta" class="form-control" required>
                                <option value="" selected></option>
                                @foreach($Contas as $conta)
                                    <option {{old('idConta',$documento->idConta)}} value="{{$conta->idConta}}">{{$conta->numConta.' => '.$conta->descricao}}</option>
                                @endforeach
                            </select><br>
                        </div>
                        <div class="col-md-12">
                            <label for="observacoes">Observações</label>
                            <br>
                            <textarea name="observacoes" class="form-control" id="observacoes" rows="4" placeholder="Observações"></textarea>
                        </div>
                    </div>
                @elseif(strtolower($tipo) == "passaporte")
                    <div class="row para-clone documento-passaporte">
                        <span class="num" style="display: none;">2</span>

                        <div class="col-md-6">
                            <label for="img_doc">Upload:</label>
                            <input type='file' class="form-control" id="img_doc" name="img_doc" accept="application/pdf, image/*" required/>
                        </div>
                        <div class="col-md-6">
                            <label for="numPassaporte">Nº Passaporte: </label>
                            <input type="text" class="form-control" name="numPassaporte" placeholder="Nº Passaporte" autocomplete="off" required>
                        </div>
                        <div class="col-md-6">
                            <label for="dataValidPP">Data de validade: </label>
                            <input type="month" class="form-control" name="dataValidPP" value="" style="width:250px" required><br>
                        </div>
                        <div class="col-md-6">
                            <label for="passaportPaisEmi">País de Emissão: </label>
                            <select name="passaportPaisEmi" id="passaportePaisEmi" class="form-control select_style" required>
                                @include('layout.partials.countries');
                            </select>
                            {{-- <input type="text" class="form-control" name="passaportPaisEmi" placeholder="Tipo pagamento" autocomplete="off" required> --}}
                        </div>
                        <div class="col-md-6">
                            <label for="localEmissaoPP">Local de Emissão: </label>
                            <input type="text" class="form-control" name="localEmissaoPP" value="" style="width:250px" required ><br>
                        </div>

                        <div class="list-clones">
                            <div class="row" id="documento-campo1">
                                <div class="col-md-6">
                                    <label for="nome-campo1">Nome do Campo</label>
                                    <br>
                                    <input id="nome-campo1" type="text" class="form-control" name="nome-campo1" placeholder="Inserir nome do campo" autocomplete="off" required>
                                </div>
                                <div class="col-md-6">
                                    <label for="valor-campo1">Valor do Campo</label>
                                    <br>
                                    <input id="valor-campo1" type="text" class="form-control" name="valor-campo1" placeholder="Inserir valor do campo" autocomplete="off" required>
                                </div>
                                <div class="col-md-2">
                                    <br><br><button type="button" onclick="removeCampo(1,$(this).closest('#documento-campo1'))" class="top-button">Remover 1</button>
                                </div>
                            </div>
                        </div>
                        <div>
                            <button type="button" onclick="addCampo($(this).closest('.para-clone'))" class="top-button">Adicionar campo</button>
                        </div>
                    </div>
                @else
                    <div class="para-clone documento">
                        <span class="num" style="display: none;">2</span>
                        <div class="row">
                            <div class="col-md-5">
                                <div class="text-center align-middle" style="min-width: 300px" >
                                    {{-- INPUT fotografia --}}
                                    <div>
                                        <label for="img_doc">Upload ficheiro:</label>
                                        <input type='file' id="img_doc" name="img_doc" style="display:none" accept="pplication/pdf, image/*" />
                
                                    </div>
                
                                    <div class="text-center align-self-center align-middle" style="max-height:150px; overflow:hidden;">
                                        <img src="{{Storage::disk('public')->url('default-photos/addImg.png')}}" id="preview"
                                            class="m-2 p-1 border rounded bg-white shadow-sm" style="width:100px; cursor:pointer; min-width:50px; max-height:100px;"
                                            alt="Imagem de apresentação" title="Clique para mudar a imagem de apresentação" />
                                    </div>
                                    <div class="mt-2"><small class="text-muted">(clique para mudar)</small></div>
                                    <br>
                                </div>
                            </div>
                            @if($tipoPAT == "Academico")
                                <div class="col-md-5">
                                    <label for="nome">Nome: </label>
                                    <input type="text" class="form-control" name="nome" placeholder="Nome" autocomplete="off" required>
                                </div>
                            @else
                                <div class="col-md-5">
                                    <label for="dataValidade">Data de validade: </label>
                                    <input type="month" class="form-control"  id="dataValidade" name="dataValidade" value="" style="width:250px" required><br>
                                </div>
                            @endif
                        </div>
                        <div class="list-clones">
                            <div class="row" id="documento-campo1">
                                <div class="col-md-5">
                                    <br><label for="nome-campo1">Nome do Campo</label>
                                    <br>
                                    <input id="nome-campo1" type="text" class="form-control" name="nome-campo1" placeholder="Inserir nome do campo" autocomplete="off" required>
                                </div>
                                <div class="col-md-5">
                                    <br><label for="valor-campo1">Valor do Campo</label>
                                    <br>
                                    <input id="valor-campo1" type="text" class="form-control" name="valor-campo1" placeholder="Inserir valor do campo" autocomplete="off" required>
                                </div>
                                <div class="col-md-2">
                                    <br><br><button type="button" onclick="removeCampo(1,$(this).closest('#documento-campo1'))" class="top-button">Remover 1</button>
                                </div>
                            </div>
                        </div>
                        <div>
                            <br><button type="button" onclick="addCampo($(this).closest('.para-clone'))" class="top-button">Adicionar campo</button>
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
        
        
        $('#passport_preview_file').on('click', function (e) {
            e.preventDefault();
            $('#img_Passaporte').trigger('click');
        });

        $('#passporte_preview').on('click', function (e) {
            e.preventDefault();
            $('#img_Passaporte').trigger('click');
        });


        function readPassaPortImgURL(input) {
            if (input.files && input.files[0]) {
                var iddocumento = new FileReader();
                iddocumento.onload = function (e) {
                    iddocumento.fileName = img_Passaporte.name;
                    $('#name_passaporte_file').text(input.files[0].name);
                }

                iddocumento.readAsDataURL(input.files[0]);
            }
        }

        $("#img_Passaporte").change(function () {
            readPassaPortImgURL(this);
            $('#passport_preview_file').hide();
            $('#passporte_preview').show();

        });
    </script>
@endsection

@endsection
