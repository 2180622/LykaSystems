<div class="form-group">
   <label for="inputFullname">Username</label>
   <input type="text" class="form-control" name="name" id="inputFullname"
   value="{{old('name',$user->name)}}" />
</div>
<div class="form-group">
   <label for="inputRole">Role</label>
   <select name="role" id="inputRole" class="form-control" onchange="visibility()">
     <option class="option" >Administrador</option>
     <option class="option" >Agente</option>
     <option class="option" selected>Cliente</option>
   </select>
</div>

<script>
    function visibility() {
      var idformadmin = document.getElementById("form-admin");
      var idformagente = document.getElementById("form-agente");
      var idformcliente = document.getElementById("form-cliente");
      var idrole = document.getElementsByClassName("option");
      var x = document.getElementById("inputRole").selectedIndex;

      console.log(x);

      if(x == '0'){
        idformagente.style.display = "none";
        idformcliente.style.display = "none"
        idformadmin.style.display = "block";
      }
      else if(x == '1'){
        idformadmin.style.display = "none";
        idformcliente.style.display = "none"
        idformagente.style.display = "block";
      }
      else if(x == '2'){
        idformadmin.style.display = "none";
        idformagente.style.display = "none";
        idformcliente.style.display = "block"
      }
    }
</script>

{{-- Form para admin --}}
<div class="form" id="form-admin" onchange="visibility()" style="display: none">
  <div class="form-group">
     <label for="inputFullname">Nome</label>
     <input type="text" class="form-control" name="name"
     value="{{old('name',$user->name)}}" />
  </div>
  <div class="form-group">
     <label for="inputFullname">Apelido</label>
     <input type="text" class="form-control" name="name"
     value="{{old('name',$user->name)}}" />
  </div>
  <div class="form-group">
     <label for="inputEmail">Email</label>
     <input type="text" class="form-control" name="email" id="inputEmail"
     placeholder="username@gmail.com" value="{{old('email',$user->email)}}" />
  </div>
  <div class="form-group">
     <label for="inputFullname">Data de Nascimento</label>
     <input type="text" class="form-control" name="name" />
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
</div>

{{-- Form para agente --}}
<div class="form" id="form-agente" onchange="visibility()" style="display: none">
  <div class="form-group">
     <label >Nome</label>
     <input type="text" class="form-control" name="name"
     value="{{old('name',$user->name)}}" />
  </div>
  <div class="form-group">
     <label >Apelido</label>
     <input type="text" class="form-control" name="name"
     value="{{old('name',$user->name)}}" />
  </div>
  <div class="form-group">
     <label for="inputEmail">Email</label>
     <input type="text" class="form-control" name="email"
     placeholder="username@gmail.com" value="{{old('email',$user->email)}}" />
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
     <select name="role" id="inputRole" class="form-control">
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
</div>

{{-- Form para cliente --}}
<div class="form" id="form-cliente" onchange="visibility()" style="display: none">
  <div class="form-group">
     <label >Nome</label>
     <input type="text" class="form-control" name="name"
     value="{{old('name',$user->name)}}" />
  </div>
  <div class="form-group">
     <label >Apelido</label>
     <input type="text" class="form-control" name="name"
     value="{{old('name',$user->name)}}" />
  </div>
  <div class="form-group">
     <label for="inputEmail">Email</label>
     <input type="text" class="form-control" name="email"
     placeholder="username@gmail.com" value="{{old('email',$user->email)}}" />
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
     <input type="text" class="form-control" name="name" />
  </div>
  <div class="form-group">
     <label for="inputFullname">Número do CC</label>
     <input type="text" class="form-control" name="name" />
  </div>
  <div class="form-group">
     <label for="inputFullname">Número do Passaporte</label>
     <input type="text" class="form-control" name="name" />
  </div>
  <div class="form-group">
     <label for="inputFullname">Data de Validade do Passaporte</label>
     <input type="text" class="form-control" name="name" />
  </div>
  <div class="form-group">
     <label for="inputFullname">País de Emissão do Passaporte</label>
     <input type="text" class="form-control" name="name" />
  </div>
  <div class="form-group">
     <label for="inputFullname">País de Naturalidade</label>
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
     <label for="inputFullname">Cidade</label>
     <input type="text" class="form-control" name="name" />
  </div>
  <div class="form-group">
     <label for="inputFullname">Morada de Residência</label>
     <input type="text" class="form-control" name="name" />
  </div>
  <div class="form-group">
     <label for="inputFullname"></label>
     <input type="text" class="form-control" name="name" />
  </div>
  <div class="form-group">
     <label for="inputFullname">NIF</label>
     <input type="text" class="form-control" name="name" />
  </div>
  <div class="form-group">
     <label for="inputFullname">Password</label>
     <input type="password" class="form-control" name="name" />
  </div>
</div>
