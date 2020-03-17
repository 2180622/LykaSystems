@extends('layout.master')

{{-- Page Title --}}
@section('title', 'Ficha da Universidade')

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
            <a href="{{route('universities.edit',$university)}}" class="top-button mr-2">Editar informação</a>
            <a href="#" class="top-button">Imprimir</a>
        </div>

        <br><br>

        <div class="cards-navigation">
            <div class="title">
                <h6>Ficha da universidade - {{$university->nome}}</h6>
            </div>
            <br>
                <div class="row">
                    <div class="col">
                        <div><span class="text-secondary">Nome da Universidade:</span> {{$university->nome}}</div><br>

                        <div><span class="text-secondary">Morada:</span> {{$university->morada}}</div><br>

                        <div><span class="text-secondary">E-mail:</span> {{$university->email}}</div><br>

                        <div><span class="text-secondary">Telefone:</span> {{$university->telefone}}</div><br>

                        <div><span class="text-secondary">NIF:</span> {{$university->NIF}}</div><br>

                        <div><span class="text-secondary">IBAN:</span> {{$university->IBAN}}</div><br>

                        <div><span class="text-secondary">Observação dos Contactos:</span> {{$university->obsContactos}}</div><br>

                        <div><span class="text-secondary">Observação dos Cursos:</span> {{$university->obsCursos}}</div><br>

                        <div><span class="text-secondary">Observação dos Candidaturas:</span> {{$university->obsCandidaturas}}</div><br>
                    </div>
                </div>
            </div>
    </div>

@endsection

{{-- Scripts --}}
@section('scripts')
    {{-- <script src="{{asset('/js/NOME_DO_FICHEIR.js')}}"></script> --}}
@endsection
