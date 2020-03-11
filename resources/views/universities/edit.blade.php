@extends('layout.master')


{{-- Titulo da Página --}}
@section('title', 'Editar Universidade')


{{-- Estilos de CSS --}}
@section('styleLinks')
    <link href="{{asset('css/university.css')}}" rel="stylesheet">
@endsection


{{-- Conteudo da Página --}}
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <form method="POST" action="{{route('universities.update',$university)}}" class="form-group"
                              enctype="multipart/form-data">
                            @csrf
                            @method("PUT")
                            @include('universities.partials.add-edit')
                            <div class="text-right">
                                <div class="form-group col-md-12 text-right mt-3 ml-3">
                                    <button type="submit" class="btn btn-md btn-success text-white mr-1" name="ok"
                                            title="Guardar"><i class="far fa-save mr-2"></i> Guardar
                                    </button>
                                    <a href="{{route('universities.index')}}"
                                       class="btn btn-md btn-secondary text-white mr-1 my-1"
                                       title="Cancelar">Cancelar</a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
