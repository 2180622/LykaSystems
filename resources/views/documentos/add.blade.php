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
            <form action="{{route('provider.store')}}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-md-12">
                        <label for="nome">Insira o documento</label>
                        <br>
                        <input type="text" name="nome" placeholder="Inserir o nome do fornecedor" autocomplete="off" required>
                    </div>
                </div>
                <br><br>
                @if($TipoDocumento == "Documento Transação")
                    <div class="row documento-transacao">
                        <span class="num" style="display: none;">1</span>
                        <div class="clones" id="clonar">
                            <div class="col-md-6">
                                <label for="nome-campo">Nome do Campo</label>
                                <br>
                                <input type="text" name="nome-campo" placeholder="Inserir nome do campo" autocomplete="off" required>
                            </div>
                            <div class="col-md-6">
                                <label for="valor-campo">Valor do Campo</label>
                                <br>
                                <input type="text" name="nome-campo" placeholder="Inserir valor do campo" autocomplete="off" required>
                            </div>
                        </div>
                        <div>
                            <button type="button" onclick="addFornecedor({{$num}},$(this).closest('.list-fornecedores'))" class="top-button">Adicionar fornecedor</button>
                        </div>
                    </div>
                @elseif($TipoDocumento == "Passaport")
                    <div class="row documento-passaport">
                        <span class="num" style="display: none;">1</span>
                        <div class="clones" id="clonar">
                            <div class="col-md-6">
                                <label for="contacto">Nome do Campo</label>
                                <br>
                                <input type="text" name="contacto" placeholder="Inserir o contacto do fornecedor" autocomplete="off" required>
                            </div>
                            <div class="col-md-6">
                                <label for="morada">Valor do Campo</label>
                                <br>
                                <input type="text" name="morada" placeholder="Inserir a morada do fornecedor" autocomplete="off" required>
                            </div>
                        </div>
                        <div>
                            <button type="button" onclick="addFornecedor({{$num}},$(this).closest('.list-fornecedores'))" class="top-button">Adicionar fornecedor</button>
                        </div>
                    </div>
                @else
                    <div class="row documento">
                        <span class="num" style="display: none;">1</span>
                        <div class="clones" id="clonar">
                            <div class="col-md-6">
                                <label for="nome-campo">Nome do Campo</label>
                                <br>
                                <input type="text" name="nome-campo" placeholder="Inserir nome do campo" autocomplete="off" required>
                            </div>
                            <div class="col-md-6">
                                <label for="valor-campo">Valor do Campo</label>
                                <br>
                                <input type="text" name="nome-campo" placeholder="Inserir valor do campo" autocomplete="off" required>
                            </div>
                        </div>
                        <div>
                            <button type="button" onclick="addFornecedor($(this).closest('.documento'))" class="top-button">Adicionar fornecedor</button>
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

    </script>
@endsection

@endsection
