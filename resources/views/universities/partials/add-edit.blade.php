<div class="row">
    {{-- INPUT nome --}}
    <div class="form-group col-lg-12 col-md-6">
        <label for="inputNome" style="font-weight: 700!important;"><span class="text-danger small">&#10033;</span>Nome da Universidade</label>
        <input type="text" class="form-control" name="nome" id="inputNome" maxlength="150" placeholder="Insira o nome da Universidade" value="{{old('nome',$universidade->nome)}}"/>
        <h6 class="pull-right text-right small mt-2" id="count-numbers-nome"></h6>
    </div>
    {{-- INPUT morada --}}
    <div class="form-group col-lg-12 col-md-6">
        <label for="inputMorada" style="font-weight: 700!important;"><span class="text-danger small">&#10033;</span>Morada</label>
        <input type="text" class="form-control" name="morada" id="inputMorada" maxlength="150" placeholder="Insira a morada da universidade" value="{{old('morada',$universidade->morada)}}"/>
        <h6 class="pull-right text-right small mt-2" id="count-numbers-morada"></h6>
    </div>
    {{-- INPUT email --}}
    <div class="form-group col-lg-6 col-md-6">
        <label for="inputEmail" style="font-weight: 700!important;"><span class="text-danger small">&#10033;</span>Endereço Eletrónico</label>
        <input type="text" class="form-control" name="email" id="inputEmail" maxlength="150" value="{{old('email',$universidade->email)}}"/>
        <h6 class="pull-right text-right small mt-2" id="count-numbers-email"></h6>
    </div>
    {{-- INPUT telefone --}}
    <div class="form-group col-lg-6 col-md-6">
        <label for="inputTelefone" style="font-weight: 700!important;"><span class="text-danger small">&#10033;</span>Telefone</label>
        <input type="text" class="form-control" name="telefone" id="inputTelefone" maxlength="150" value="{{old('telefone',$universidade->telefone)}}"/>
        <h6 class="pull-right text-right small mt-2" id="count-numbers-telefone"></h6>
    </div>
    {{-- INPUT NIF --}}
    <div class="form-group col-lg-6 col-md-6">
        <label for="inputNIF"><span class="text-danger small">&#10033;</span>NIF</label>
        <input type="text" class="form-control" name="nif" id="inputNIF" maxlength="150" value="{{old('NIF',$universidade->NIF)}}"/>
        <h6 class="pull-right text-right small mt-2" id="count-numbers-nif"></h6>
    </div>
    {{-- INPUT IBAN --}}
    <div class="form-group col-lg-6 col-md-6">
        <label for="inputIBAN" style="font-weight: 700!important;"><span class="text-danger small">&#10033;</span>IBAN</label>
        <input type="text" class="form-control" name="iban" id="inputIBAN" maxlength="150" value="{{old('IBAN',$universidade->IBAN)}}"/>
        <h6 class="pull-right text-right small mt-2" id="count-numbers-iban"></h6>
    </div>
    {{-- INPUT obsCursos --}}
    <div class="form-group col-md-12">
        <label for="inputObsCursos" style="font-weight: 700!important;">Observações de Cursos</label>
        <textarea name="obsCursos" id="inputObsCursos" rows="4" class="form-control">{{old('obsCursos',$universidade->obsCursos)}}</textarea>
    </div>
    {{-- INPUT obsCandidaturas --}}
    <div class="form-group col-md-12">
        <label for="inputObsCandidaturas" style="font-weight: 700!important;">Observações de Candidaturas</label>
        <textarea name="obsCandidaturas" id="inputObsCandidaturas" rows="4" class="form-control">{{old('obsCandidaturas',$universidade->obsCandidaturas)}}</textarea>
    </div>
    {{-- INPUT obsContactos --}}
    <div class="form-group col-md-12">
        <label for="inputObsContactos" style="font-weight: 700!important;">Observações de Contactos</label>
        <textarea name="obsContactos" id="inputObsContactos" rows="4" class="form-control">{{old('obsContactos',$universidade->obsContactos)}}</textarea>
        <br>
        <small class="text-danger mt-3">&#10033;<b>Campo de preenchimento obrigatório</b></small>
    </div>
</div>
