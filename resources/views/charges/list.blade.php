@extends('layout.master')

{{-- Titulo da Página --}}
@section('title', 'Listagem de cobranças')

{{-- Estilos de CSS --}}
@section('styleLinks')
<link href="{{asset('/css/datatables_general.css')}}" rel="stylesheet">
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
            <h6>Listagem de cobranças</h6>
        </div>
        <br>

        <div class="row mt-3 mb-4">
            <div class="col">
                @if (count($numberProducts) == 1)
                Está registada <strong>{{count($numberProducts)}}(uma)</strong> cobrança pendente.
                @else
                Estão registadas <strong>{{count($numberProducts)}}</strong> cobranças pendentes.
                @endif
            </div>
        </div>

        <div class="row mt-3 mb-4">
            <div class="col">
                <span class="mr-2">Mostrar</span>
                <select class="custom-select" id="records_per_page" style="width:80px">
                    <option selected>10</option>
                    <option>25</option>
                    <option>50</option>
                    <option>100</option>
                </select>
                <span class="ml-2">por página</span>
            </div>
            <div class="col ">
                <div class="input-group pl-0 float-right" style="width:250px">
                    <input class="form-control my-0 py-1 red-border" type="text" id="customSearchBox" placeholder="Procurar" aria-label="Procurar">
                    <div class="input-group-append">
                        <span class="input-group-text red lighten-3"><i class="fas fa-search text-grey" aria-hidden="true"></i></span>
                    </div>
                </div>
            </div>
        </div>
        <hr>
        <div class="table-responsive " style="overflow:hidden">
            <table nowarp class="table table-borderless" id="dataTable" width="100%" row-border="0" style="overflow:hidden;">
                <thead>
                    <tr>
                        <th class="text-center align-content-center">Foto</th>
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
                    @foreach ($product->fase as $fase)
                      @php
                        if(count($fase->DocTransacao)){
                          foreach ($fase->DocTransacao as $document) {
                            $valorPago = $document->valorRecebido;
                            // dd($valorPago);
                          }
                        }
                      @endphp
                    @endforeach
                    <tr>
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
                        <td class="align-middle"><a class="name_link" href="{{route('charges.show', $product)}}">{{$product->cliente->nome.' '.$product->cliente->apelido}}</a></td>
                        <td class="align-middle">{{$product->descricao}}</td>
                        <td class="align-middle">{{number_format((float)$product->valorTotal, 2, ',', '')}}€</td>
                        <td class="align-middle">Pendente</td>
                    </tr>
                    @endforeach
                    @endif
                </tbody>
            </table>
        </div>
    </div>
</div>

@endsection
