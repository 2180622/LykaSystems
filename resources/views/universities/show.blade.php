@extends('layout.master')

{{-- Page Title --}}
@section('title', 'Ficha de Universidade')

{{-- CSS Style Link --}}
@section('styleLinks')
<link href="{{asset('css/university.css')}}" rel="stylesheet">
@endsection



{{-- Page Content --}}
@section('content')

<div class="container mt-2">
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
        <a href="{{route('universities.edit',$university)}}" class="top-button mr-2">Editar informação</a>
    </div>

    <br><br>

    <div class="cards-navigation">
        <div class="title">

            <h6>Ficha de Universidade</h6>

        </div>
        <br>



        <div class="row font-weight-bold border p-2 pt-3 pb-3" style="color:#6A74C9">
            <div class="col p-0 text-center" style="flex: 0 0 20%; -ms-flex: 0 0 20%; min-width:195px">

                <img class="m-2 p-1 rounded bg-white shadow-sm" src="{{Storage::disk('public')->url('default-photos/university.png')}}"
                width="100%" style="width:90%">

            </div>

            <div class="col p-2" style="min-width:280px !important">


                {{-- Informações da universidade --}}
                <div><span class="text-secondary ">Nome da Universidade:</span> {{$university->nome}}</div><br>

                <div><span class="text-secondary ">Morada:</span> {{$university->morada}}</div><br>

                <div><span class="text-secondary ">E-mail:</span> {{$university->email}}</div><br>

                <div><span class="text-secondary">Telefone :</span> {{$university->telefone}}</div><br>

                <div><span class="text-secondary">NIF:</span> {{$university->NIF}}</div><br>

                <div><span class="text-secondary">IBAN:</span> {{$university->IBAN}}</div><br>

                <div><span class="text-secondary">Observação dos Contactos:</span> {{$university->obsContactos}}</div><br>

                <div><span class="text-secondary">Observação dos Cursos:</span> {{$university->obsCursos}}</div><br>

                <div><span class="text-secondary">Observação dos Candidaturas:</span> {{$university->obsCandidaturas}}</div><br>

                <hr>

                <div class="text-muted"><small>Adicionado: {{ date('d-M-y', strtotime($university->created_at)) }}</small>
                </div>
                <div class="text-muted"><small>Ultima atualização:
                        {{ date('d-M-y', strtotime($university->updated_at)) }}</small></div>

            </div>



        </div>


    </div>
</div>

@endsection

{{-- Scripts --}}
@section('scripts')
{{-- <script src="{{asset('/js/agent.js')}}"></script> --}}
@endsection


















