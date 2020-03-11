<div class="row">
    <div class="form-group col-lg-12 col-md-6">
        <label for="inputNome"><span class="text-danger small">&#10033;</span>Nome da Universidade</label>
        <input type="text" class="form-control" name="nome" id="inputNome" maxlength="150" value="{{old('nome',$university->nome)}}"/>
        <h6 class="pull-right text-right small mt-2" id="count-numbers-nome"></h6>
    </div>

    <div class="form-group col-lg-12 col-md-6">
        <label for="inputMorada"><span class="text-danger small">&#10033;</span>Morada</label>
        <input type="text" class="form-control" name="morada" id="inputMorada" maxlength="150" value="{{old('morada',$university->morada)}}"/>
        <h6 class="pull-right text-right small mt-2" id="count-numbers-morada"></h6>
    </div>

    <div class="form-group col-lg-12 col-md-6">
        <label for="inputTelefone"><span class="text-danger small">&#10033;</span>Telefone</label>
        <input type="text" class="form-control" name="telefone" id="inputTelefone" maxlength="150" value="{{old('telefone',$university->telefone)}}"/>
        <h6 class="pull-right text-right small mt-2" id="count-numbers-telefone"></h6>
    </div>

    <div class="form-group col-lg-12 col-md-6">
        <label for="inputEmail"><span class="text-danger small">&#10033;</span>Endereço Eletrónico</label>
        <input type="text" class="form-control" name="email" id="inputEmail" maxlength="150" value="{{old('email',$university->email)}}"/>
        <h6 class="pull-right text-right small mt-2" id="count-numbers-email"></h6>
    </div>

    <div class="form-group col-lg-12 col-md-6">
        <label for="inputNIF"><span class="text-danger small">&#10033;</span>NIF</label>
        <input type="text" class="form-control" name="nif" id="inputNIF" maxlength="150" value="{{old('NIF',$university->NIF)}}"/>
        <h6 class="pull-right text-right small mt-2" id="count-numbers-nif"></h6>
    </div>

    <div class="form-group col-lg-12 col-md-6">
        <label for="inputIBAN"><span class="text-danger small">&#10033;</span>IBAN</label>
        <input type="text" class="form-control" name="iban" id="inputIBAN" maxlength="150" value="{{old('IBAN',$university->IBAN)}}"/>
        <h6 class="pull-right text-right small mt-2" id="count-numbers-iban"></h6>
    </div>

    <div class="form-group col-lg-12 col-md-6">
        <label for="inputIBAN"><span class="text-danger small">&#10033;</span>IBAN</label>
        <input type="text" class="form-control" name="iban" id="inputIBAN" maxlength="150" value="{{old('IBAN',$university->IBAN)}}"/>
        <h6 class="pull-right text-right small mt-2" id="count-numbers-iban"></h6>
    </div>

    <div class="form-group col-md-12">
        <br>
        <span class="text-danger small">&#10033;</span><label for="inputObsCursos">Observações de Cursos</label>
        <textarea name="obsCursos" id="inputObsCursos" required>{{old('obsCursos',$university->obsCursos)}}</textarea>
    </div>

    <div class="form-group col-md-12">
        <br>
        <span class="text-danger small">&#10033;</span><label for="inputObsCandidaturas">Observações de Candidaturas</label>
        <textarea name="obsCandidaturas" id="inputObsCandidaturas" required>{{old('obsCandidaturas',$university->obsCandidaturas)}}</textarea>
    </div>

    <div class="form-group col-md-12">
        <br>
        <span class="text-danger small">&#10033;</span><label for="inputObsContactos">Observações de Contactos</label>
        <textarea name="obsContactos" id="inputObsContactos" required>{{old('obsContactos',$university->obsContactos)}}</textarea>
        <br>
        <small class="text-danger">&#10033; Campo de preenchimento obrigatório</small>
    </div>
</div>
