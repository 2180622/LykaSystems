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
       <option class="option" >Cliente</option>
     </select>
  </div>


  {{-- Form para admin --}}
  <form class="form-group" id="form-admin" action="{{route('users.storeAdmin')}}" style="display: none" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="form-group">
       <label for="inputFullname">Username</label>
       <input type="text" class="form-control" name="username" id="inputUsername1"/>
    </div>
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
       <input type="text" class="form-control" name="email" id="inputEmail"
       placeholder="username@gmail.com" />
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
       <label for="inputFullname">Password</label>
       <input type="password" class="form-control" name="password" />
    </div>
    <div class="form-group">
      <button type="submit" class="btn btn-success" name="ok">Save</button>
      <a href="{{route('users.index')}}" class="btn btn-default">Cancel</a>
    </div>
  </form>

  {{-- Form para agente --}}
  <form class="form-group" id="form-agente" action="{{route('users.storeAgente')}}" style="display: none" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="form-group">
       <label for="inputFullname">Username</label>
       <input type="text" class="form-control" name="name" id="inputUsername2"/>
    </div>
    <div class="form-group">
       <label >Nome</label>
       <input type="text" class="form-control" name="name" />
    </div>
    <div class="form-group">
       <label >Apelido</label>
       <input type="text" class="form-control" name="name" />
    </div>
    <div class="form-group">
       <label for="inputEmail">Email</label>
       <input type="text" class="form-control" name="email"
       placeholder="username@gmail.com" />
    </div>
    <div class="form-group">
       <label for="inputFullname">Data de Nascimento</label>
       <input type="text" class="form-control" name="name" />
    </div>
    <div class="form-group">
       <label for="inputFullname">Fotografia</label>
       <input type="text" class="form-control" name="name" />
    </div>
    <div class="form-group">
       <label for="inputFullname">Morada</label>
       <input type="text" class="form-control" name="name" />
    </div>
    <div class="form-group">
       <label for="inputFullname">País</label>
       <input type="text" class="form-control" name="name" />
    </div>
    <div class="form-group">
       <label for="inputFullname">NIF</label>
       <input type="text" class="form-control" name="name" />
    </div>
    <div class="form-group">
       <label for="inputFullname">Tipo de Agente</label>
       <select name="role" id="inputRoleAgente" class="form-control">
         <option class="option" >Agente</option>
         <option class="option" >Sub-Agente</option>
       </select>
    </div>
    <div class="form-group">
       <label for="inputFullname">Telefone 1</label>
       <input type="text" class="form-control" name="name" />
    </div>
    <div class="form-group">
       <label for="inputFullname">Telefone 2</label>
       <input type="text" class="form-control" name="name" />
    </div>
    <div class="form-group">
       <label for="inputFullname">Password</label>
       <input type="password" class="form-control" name="name" />
    </div>
    <div class="form-group">
      <button type="submit" class="btn btn-success" name="ok">Save</button>
      <a href="{{route('users.index')}}" class="btn btn-default">Cancel</a>
    </div>
  </form>

  {{-- Form para cliente --}}
  <form class="form-group" id="form-cliente" action="{{route('users.storeCliente')}}" style="display: none" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="form-group">
       <label for="inputFullname">Username</label>
       <input type="text" class="form-control" name="name" id="inputUsername3"/>
    </div>
    <div class="form-group">
       <label >Nome</label>
       <input type="text" class="form-control" name="name" />
    </div>
    <div class="form-group">
       <label >Apelido</label>
       <input type="text" class="form-control" name="name" />
    </div>
    <div class="form-group">
       <label for="inputEmail">Email</label>
       <input type="text" class="form-control" name="email"
       placeholder2="username@gmail.com" />
    </div>
    <div class="form-group">
       <label for="inputFullname">Telefone 1</label>
       <input type="text" class="form-control" name="name" />
    </div>
    <div class="form-group">
       <label for="inputFullname">Telefone 2</label>
       <input type="text" class="form-control" name="name" />
    </div>
    <div class="form-group">
       <label for="inputFullname">Data de Nascimento</label>
       <input type2="text" class="form-control" name="name" />
    </div>
    <div class="form-group">
       <label for="inputFullname">Número do CC</label>
       <input type="text" class="form-control" name="name" />
    </div>
    <div class="form-group">Admin
       <label for="inputFullname">Número do Passaporte</label>
       <input type="text" class="form-control" name="name" />
    </div>
    <div class="form-group">
       <label for="inputFullname">Data de Validade do Passaporte</label>
       <input type="text" class="form-control" name="name" />
    </div>
    <div class="form-group">
       <label for="inputFullname">Local de Emissão do Passaporte</label>
       <input type="text" class="form-control" name="name" />
    </div>
    <div class="form-group">
       <label for="inputFullname">País de Naturalidade</label>
       <input type="text" class="form-control" name="name" />
    </div>
    <div class="form-group">
       <label for="inputFullname">Morada</label>
       <input type="text" class="form-control" name="name" />
    </div>
    <div class="form-group">
       <label for="inputFullname">Cidade</label>
       <input type="text" class="form-control" name="name" />
    </div>
    <div class="form-group">
       <label for="inputFullname">Morada de Residência</label>
       <input type="text" class="form-control" name="name" />
    </div>
    <div class="form-group">
       <label for="inputFullname">País de Emissão de Passaporte</label>
       <input type="text" class="form-control" name="name" />
    </div>
    <div class="form-group">
       <label for="inputFullname">Nome do Pai</label>
       <input type="text" class="form-control" name="name" />
    </div>
    <div class="form-group">
       <label for="inputFullname">Telefone do Pai</label>
       <input type="text" class="form-control" name="name" />
    </div>
    <div class="form-group">
       <label for="inputFullname">Email do Pai</label>
       <input type="text" class="form-control" name="name" />
    </div>
    <div class="form-group">
       <label for="inputFullname">Nome da Mãe</label>
       <input type="text" class="form-control" name="name" />
    </div>
    <div class="form-group">
       <label for="inputFullname">Telefone da Mãe</label>
       <input type="text" class="form-control" name="name" />
    </div>
    <div class="form-group">
       <label for="inputFullname">Email da Mãe</label>
       <input type="text" class="form-control" name="name" />
    </div>
    <div class="form-group">
       <label for="inputFullname">Fotografia</label>
       <input type="file" alt="submit" class="form-control" name="name" />
    </div>
    <div class="form-group">
       <label for="inputFullname">NIF</label>
       <input type="text" class="form-control" name="name" />
    </div>
    <div class="form-group">
       <label for="inputFullname">IBAN</label>
       <input type="text" class="form-control" name="name" />
    </div>
    <div class="form-group">
       <label for="inputFullname">Nível de Estudo Atual</label>
       <input type="text" class="form-control" name="name" />
    </div>
    <div class="form-group">
       <label for="inputFullname">Nome da Instituição de Origem</label>
       <input type="text" class="form-control" name="name" />
    </div>
    <div class="form-group">
       <label for="inputFullname">Cidade da Instituição de Origem</label>
       <input type="text" class="form-control" name="name" />
    </div>
    <div class="form-group">
       <label for="inputFullname">Password</label>
       <input type="password" class="form-control" name="name" />
    </div>
    <div class="form-group">
      <button type="submit" class="btn btn-success" name="ok">Save</button>
      <a href="{{route('users.index')}}" class="btn btn-default">Cancel</a>
    </div>
  </form>

@endsection

{{-- Scripts --}}
@section('scripts')

  <script>
      function visibility() {
        var idformadmin = document.getElementById("form-admin");
        var idformagente = document.getElementById("form-agente");
        var idformcliente = document.getElementById("form-cliente");
        var x = document.getElementById("inputRole").selectedIndex;

        if(x == '1'){
          idformagente.style.display = "none";
          idformcliente.style.display = "none";
          idformadmin.style.display = "block";
        }
        else if(x == '2'){
          idformadmin.style.display = "none";
          idformcliente.style.display = "none";
          idformagente.style.display = "block";
        }
        else if(x == '3'){
          idformadmin.style.display = "none";
          idformagente.style.display = "none";
          idformcliente.style.display = "block";
        }
      }
  </script>

@endsection
