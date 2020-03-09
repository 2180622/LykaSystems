@extends('layout.master')

{{-- Page Title --}}
@section('title', 'Página Exemplo')

{{-- CSS Style Link --}}
@section('styleLinks')
{{-- <link href="{{asset('/css/NOME_DO_FICHEIRO.css')}}" rel="stylesheet"> --}}
@endsection

{{-- Page Content --}}
@section('content')

  <form method="POST" action="{{route('users.store')}}" class="form-group"
   enctype="multipart/form-data">
  @csrf
  @include('users.partials.add-edit')
  <div class="form-group">
  <button type="submit" class="btn btn-success" name="ok">Save</button>
  <a href="{{route('users.index')}}" class="btn btn-default">Cancel</a>
  </div>
  </form>

@endsection

{{-- Scripts --}}
@section('scripts')

{{-- <script src="{{asset('/js/NOME_DO_FICHEIR.js')}}"></script> --}}

@endsection
