<div class="row">
    <div class="col">
        <div class="form-group">
            <label for="nome">Nome:</label>
            <input type="text" class="form-control" name="nome" required value="{{old('nome', $user->admin->nome)}}">
        </div>
    </div>
    <div class="col">
        <div class="form-group">
            <label for="inputFullname">Apelido:</label>
            <input type="text" class="form-control" name="apelido" required value="{{old('apelido', $user->admin->apelido)}}">
        </div>
    </div>
</div>

<div class="row">
    <div class="col">
        <div class="form-group">
            <label for="inputEmail">E-mail:</label>
            <input type="text" class="form-control" name="email" id="inputEmail" required value="{{old('email', $user->email)}}">
        </div>
    </div>
    <div class="col">
        <div class="form-group">
            <label for="inputFullname">Data de Nascimento:</label>
            <input type="text" class="form-control" name="dataNasc" required value="{{old('dataNasc', $user->admin->dataNasc)}}">
        </div>
    </div>
</div>

<div class="row">
  <div class="col">
    <div class="form-group">
        <label for="inputFullname">Telefone Princial:</label>
        <input type="text" class="form-control" name="telefone1" required value="{{old('telefone1', $user->admin->telefone1)}}">
    </div>
  </div>
  <div class="col">
    <div class="form-group">
        <label for="inputFullname">Telefone Secundário (Opcional):</label>
        <input type="text" class="form-control" name="telefone2" value="{{old('telefone2', $user->admin->telefone2)}}">
    </div>
  </div>
</div>
