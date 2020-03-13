@extends('layout.master')

{{-- Page Title --}}
@section('title', 'Página Exemplo')

{{-- CSS Style Link --}}
@section('styleLinks')
{{-- <link href="{{asset('/css/NOME_DO_FICHEIRO.css')}}" rel="stylesheet"> --}}
@endsection

{{-- Page Content --}}
@section('content')
  <div class="form-group">
     <label for="inputRole">Role</label>
     <select name="role" id="inputRole" class="form-control" onchange="visibility()">
       <option class="option" selected>Escolha uma opção...</option>
       <option class="option" >Administrador</option>
       <option class="option" >Agente</option>
     </select>
  </div>


  {{-- Form para admin --}}
  <form class="form-group" id="form-admin" action="{{route('users.storeAdmin')}}" style="display: block" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="form-group">
       <label for="inputFullname">Nome</label>
       <input type="text" class="form-control" name="nome" />
    </div>
    <div class="form-group">
       <label for="inputFullname">Apelido</label>
       <input type="text" class="form-control" name="apelido" />
    </div>
    <div class="form-group">
       <label for="inputEmail">Email</label>
       <input type="text" class="form-control" name="email" id="inputEmail" />
    </div>
    <div class="form-group">
       <label for="inputFullname">Data de Nascimento</label>
       <input type="text" class="form-control" name="dataNasc" />
    </div>
    <div class="form-group">
       <label for="inputFullname">Telefone 1</label>
       <input type="text" class="form-control" name="telefone1" />
    </div>
    <div class="form-group">
       <label for="inputFullname">Telefone 2</label>
       <input type="text" class="form-control" name="telefone2" />
    </div>
    <div class="form-group">
      <button type="submit" class="btn btn-success">Save</button>
      <a href="{{route('users.index')}}" class="btn btn-default">Cancel</a>
    </div>
  </form>
@endsection

{{-- Scripts --}}
@section('scripts')


@endsection
