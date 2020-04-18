<div class="row" style="color:#6A74C9">
    {{-- INPUT nome --}}
    <div class="form-group cards-navigation col-lg-12 col-md-6">
        <label for="inputNome" style="font-weight: 700!important;">Nome da Universidade</label>
        <input required type="text" class="form-control" name="nome" id="inputNome"
            placeholder="Insira o nome da Universidade" value="{{old('nome',$university->nome)}}" maxlength="150"/>
        <h6 class="pull-right text-right small mt-2" id="count-numbers-nome"></h6>
    </div>
    {{-- INPUT morada --}}
    <div class="form-group cards-navigation col-lg-12 col-md-6">
        <label for="inputMorada" style="font-weight: 700!important;">Morada</label>
        <input required type="text" class="form-control" name="morada" id="inputMorada"
            placeholder="Insira a morada da universidade" value="{{old('morada',$university->morada)}}" maxlength="150" />
        <h6 class="pull-right text-right small mt-2" id="count-numbers-morada"></h6>
    </div>
    {{-- INPUT email --}}
    <div class="form-group cards-navigation col-lg-6 col-md-6">
        <label for="inputEmail" style="font-weight: 700!important;">Endereço Eletrónico</label>
        <input required type="email" class="form-control" name="email" id="inputEmail"
            value="{{old('email',$university->email)}}" maxlength="250" />
        <h6 class="pull-right text-right small mt-2" id="count-numbers-email"></h6>
    </div>
    {{-- INPUT telefone --}}
    <div class="form-group cards-navigation col-lg-6 col-md-6">
        <label for="inputTelefone" style="font-weight: 700!important;">Telefone</label>
        <input required type="text" class="form-control" name="telefone" id="inputTelefone"
            value="{{old('telefone',$university->telefone)}}" maxlength="20" />
        <h6 class="pull-right text-right small mt-2" id="count-numbers-telefone"></h6>
    </div>
    {{-- INPUT NIF --}}
    <div class="form-group cards-navigation col-lg-6 col-md-6">
        <label for="inputNIF" style="font-weight: 700!important;">NIF</label>
        <input required type="text" class="form-control" name="NIF" id="inputNIF"
            value="{{old('NIF',$university->NIF)}}" maxlength="20"/>
        <h6 class="pull-right text-right small mt-2" id="count-numbers-nif"></h6>
    </div>
    {{-- INPUT IBAN --}}
    <div class="form-group cards-navigation col-lg-6 col-md-6">
        <label for="inputIBAN" style="font-weight: 700!important;">IBAN</label>
        <input required type="text" class="form-control" name="IBAN" id="inputIBAN"
            value="{{old('IBAN',$university->IBAN)}}" maxlength="25"/>
        <h6 class="pull-right text-right small mt-2" id="count-numbers-iban"></h6>
    </div>
    {{-- INPUT obsCursos --}}
    <div class="form-group cards-navigation col-md-12">
        <label for="inputObsCursos" style="font-weight: 700!important;">Observações de Cursos</label>
        <textarea name="obsCursos" id="inputObsCursos" rows="4"
            class="form-control">{{old('obsCursos',$university->obsCursos)}}</textarea>
    </div>
    {{-- INPUT obsCandidaturas --}}
    <div class="form-group cards-navigation col-md-12">
        <label for="inputObsCandidaturas" style="font-weight: 700!important;">Observações de Candidaturas</label>
        <textarea name="obsCandidaturas" id="inputObsCandidaturas" rows="4"
            class="form-control">{{old('obsCandidaturas',$university->obsCandidaturas)}}</textarea>
    </div>
    {{-- INPUT obsContactos --}}
    <div class="form-group cards-navigation col-md-12">
        <label for="inputObsContactos" style="font-weight: 700!important;">Observações de Contactos</label>
        <textarea name="obsContactos" id="inputObsContactos" rows="4"
            class="form-control">{{old('obsContactos',$university->obsContactos)}}</textarea>
    </div>
</div>
