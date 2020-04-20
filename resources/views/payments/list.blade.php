@extends('layout.master')

{{-- Titulo da Página --}}
@section('title', 'Lista de pagamentos')

{{-- Estilos de CSS --}}
@section('styleLinks')
<link href="{{asset('/css/datatables_general.css')}}" rel="stylesheet">
<link href="{{asset('/css/payment.css')}}" rel="stylesheet">
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
        <div class="title row">
            <div class="col-md-6">
                <h6>Listagem de pagamentos</h6>
            </div>
            <div class="col-md-6" style="bottom:5px; height:32px;">
                <div class="input-group pl-0 float-right search-section" style="width:250px">
                    <input class="shadow-sm" type="text" id="customSearchBox" placeholder="Secção de procura" aria-label="Procurar">
                    <div class="search-button input-group-append">
                        <ion-icon name="search-outline" class="search-icon"></ion-icon>
                    </div>
                </div>
            </div>
        </div>
        <br>
        <div class="row mt-2 mb-4">
            <div class="col-md-6">
                @if (count($numberProducts) == 1)
                Está registado <strong>{{count($numberProducts)}}</strong> pagamento pendente.
                @else
                Estão registados <strong>{{count($numberProducts)}}</strong> pagamentos pendentes.
                @endif
            </div>
        </div>

        <div class="table-responsive " style="overflow:hidden">
            <table nowarp class="table" id="dataTable" width="100%" row-border="0" style="overflow:hidden;">
                <thead>
                    <tr>
                        <th>Foto</th>
                        <th>Nome</th>
                        <th>Descrição</th>
                        <th>Valor</th>
                        <th>Estado</th>
                    </tr>
                </thead>
                <tbody>
                    @if (!count($products))
                    <h6>Não existem pagamentos a ser feitos.</h6>
                    @else
                    @foreach ($products as $product)
                    <tr data-href="{{route('payments.show', $product)}}">
                        <td>
                            <div class="align-middle mx-auto rounded bg-white" style="overflow:hidden; width:50px; height:50px">
                                @if($product->cliente->fotografia)
                                    <img src="{{Storage::disk('public')->url('client-photos/').$product->cliente->fotografia}}" width="100%" class="mx-auto">
                                    @elseif($product->cliente->genero == 'F')
                                        <img src="{{Storage::disk('public')->url('default-photos/F.jpg')}}" width="100%" class="mx-auto">
                                        @else
                                        <img src="{{Storage::disk('public')->url('default-photos/M.jpg')}}" width="100%" class="mx-auto">
                                        @endif
                            </div>
                        </td>
                        <td class="align-middle">{{$product->cliente->nome.' '.$product->cliente->apelido}}</td>
                        <td class="align-middle">{{$product->descricao}}</td>
                        <td class="align-middle">{{$product->valorTotal}}€</td>
                        <td class="align-middle">Pendente</td>
                    </tr>
                    @endforeach
                    @endif
                </tbody>
            </table>
        </div>
    </div>
</div>

@section('scripts')
<script src="{{asset('/js/payments.js')}}"></script>
@endsection
@endsection
