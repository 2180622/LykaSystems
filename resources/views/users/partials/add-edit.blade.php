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

<div class="form" id="form-admin" onchange="visibility()" style="display: none">
  <div class="form-group">
     <label for="inputFullname">Nome</label>
     <input type="text" class="form-control" name="name" id="inputFullname"
     value="{{old('name',$user->name)}}" />
  </div>
  <div class="form-group">
     <label for="inputFullname">Apelido</label>
     <input type="text" class="form-control" name="name" id="inputFullname"
     value="{{old('name',$user->name)}}" />
  </div>
  <div class="form-group">
     <label for="inputEmail">Email</label>
     <input type="text" class="form-control" name="email" id="inputEmail"
     placeholder="username@gmail.com" value="{{old('email',$user->email)}}" />
  </div>
  <div class="form-group">
     <label for="inputFullname">Data de Nascimento</label>
     <input type="text" class="form-control" name="name" id="inputFullname" />
  </div>
  <div class="form-group">
     <label for="inputFullname">Telefone 1</label>
     <input type="text" class="form-control" name="name" id="inputFullname" />
  </div>
  <div class="form-group">
     <label for="inputFullname">Telefone 2</label>
     <input type="text" class="form-control" name="name" id="inputFullname" />
  </div>
  <div class="form-group">
     <label for="inputFullname">Password</label>
     <input type="password" class="form-control" name="name" id="inputFullname" />
  </div>
</div>
