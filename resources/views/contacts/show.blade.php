@extends('layout.master')

{{-- Page Title --}}
@section('title', 'Detalhes do contacto')

{{-- CSS Style Link --}}
@section('styleLinks')

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
            <a href="#" class="top-button mr-2">Editar informação</a>
        </div>

        <br><br>

        <div class="cards-navigation">
            <div class="title">
                <h6>Detalhes do contacto {{$variavel}}</h6>
            </div>
            <br>

            <div class="row font-weight-bold border p-2 pt-3 pb-3" style="color:#6A74C9">
                <div class="col p-0 text-center" style="flex: 0 0 20%; -ms-flex: 0 0 20%; min-width:195px">

                    @if($contacto->fotografia)
                        <img class="m-2 p-1 rounded bg-white shadow-sm" src="{{Storage::disk('public')->url('contact-photos/').$contacto->fotografia}}" style="width:90%">
                    @else
                        <img class="m-2 p-1 rounded bg-white shadow-sm" src="{{Storage::disk('public')->url('default-photos/M.jpg')}}" style="width:90%">
                    @endif

                </div>

                <div class="col p-2">

                    {{-- Informações Pessoais --}}
                    <div><span class="text-secondary ">Nome:</span> {{$contacto->nome}}</div><br>

                    <div><span class="text-secondary ">Telefone (1):</span> {{$contacto->nome}}</div><br>

                    <div><span class="text-secondary ">Telefone (2):</span> {{$contacto->nome}}</div><br>

                    <div><span class="text-secondary ">E-mail:</span> {{$contacto->email}}</div><br>

                    <div><span class="text-secondary ">Observações:</span> {{$contacto->nome}}</div><br>


                    <div class="text-muted"><small>Adicionado: {{ date('d-M-y', strtotime($contacto->created_at)) }}</small></div>
                    <div class="text-muted"><small>Ultima atualização: {{ date('d-M-y', strtotime($contacto->updated_at)) }}</small></div>



                </div>

            </div>





        </div>
    </div>

@endsection

{{-- Scripts --}}
@section('scripts')
    {{-- <script src="{{asset('/js/NOME_DO_FICHEIR.js')}}"></script> --}}
@endsection
