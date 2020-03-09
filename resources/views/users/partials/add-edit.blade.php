<div class="form-group">
   <label for="inputFullname">Username</label>
   <input type="text" class="form-control" name="name" id="inputFullname"
   value="{{old('name',$user->name)}}" />
</div>
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
{{-- <div class="form-group">
   <label for="inputFullname">Password</label>
   <input type="password" class="form-control" name="name" id="inputFullname" />
</div> --}}
{{-- <div class="form-group">
   <label for="inputRole">Role</label>
   <select name="role" id="inputRole" class="form-control">
     <option {{old('role',$user->role)=='A'?"selected":""}} value="A" >Administrador</option>
     <option {{old('role',$user->role)=='N'?"selected":""}} value="N" selected>Agente</option>
     <option {{old('role',$user->role)=='N'?"selected":""}} value="N" selected>Cliente</option>
   </select>
</div> --}}
