<div class="row">
    {{-- INPUT nome --}}
    <div class="form-group col-lg-12 col-md-6">
        <label for="inputNome"><span class="text-danger small">&#10033;</span>Nome da Universidade</label>
        <input type="text" class="form-control" name="nome" id="inputNome" maxlength="150" placeholder="Insira o nome da Universidade"/>
        <h6 class="pull-right text-right small mt-2" id="count-numbers-nome"></h6>
    </div>
    {{-- INPUT morada --}}
    <div class="form-group col-lg-12 col-md-6">
        <label for="inputMorada"><span class="text-danger small">&#10033;</span>Morada</label>
        <input type="text" class="form-control" name="morada" id="inputMorada" maxlength="150" placeholder="Insira a morada da universidade"/>
        <h6 class="pull-right text-right small mt-2" id="count-numbers-morada"></h6>
    </div>
    {{-- INPUT email --}}
    <div class="form-group col-lg-6 col-md-6">
        <label for="inputEmail"><span class="text-danger small">&#10033;</span>Endereço Eletrónico</label>
        <input type="text" class="form-control" name="email" id="inputEmail" maxlength="150" value=""/>
        <h6 class="pull-right text-right small mt-2" id="count-numbers-email"></h6>
    </div>
    {{-- INPUT telefone --}}
    <div class="form-group col-lg-6 col-md-6">
        <label for="inputTelefone"><span class="text-danger small">&#10033;</span>Telefone</label>
        <input type="text" class="form-control" name="telefone" id="inputTelefone" maxlength="150" value=""/>
        <h6 class="pull-right text-right small mt-2" id="count-numbers-telefone"></h6>
    </div>
    {{-- INPUT NIF --}}
    <div class="form-group col-lg-6 col-md-6">
        <label for="inputNIF"><span class="text-danger small">&#10033;</span>NIF</label>
        <input type="text" class="form-control" name="nif" id="inputNIF" maxlength="150" value=""/>
        <h6 class="pull-right text-right small mt-2" id="count-numbers-nif"></h6>
    </div>
    {{-- INPUT IBAN --}}
    <div class="form-group col-lg-6 col-md-6">
        <label for="inputIBAN"><span class="text-danger small">&#10033;</span>IBAN</label>
        <input type="text" class="form-control" name="iban" id="inputIBAN" maxlength="150" value=""/>
        <h6 class="pull-right text-right small mt-2" id="count-numbers-iban"></h6>
    </div>
    {{-- INPUT obsCursos --}}
    <div class="form-group col-md-12">
        <br>
        <label for="inputObsCursos">Observações de Cursos</label>
        <textarea name="obsCursos" id="inputObsCursos" rows="4" class="form-control"></textarea>
    </div>
    {{-- INPUT obsCandidaturas --}}
    <div class="form-group col-md-12">
        <br>
        <label for="inputObsCandidaturas">Observações de Candidaturas</label>
        <textarea name="obsCandidaturas" id="inputObsCandidaturas" rows="4" class="form-control"></textarea>
    </div>
    {{-- INPUT obsContactos --}}
    <div class="form-group col-md-12">
        <br>
        <label for="inputObsContactos">Observações de Contactos</label>
        <textarea name="obsContactos" id="inputObsContactos" rows="4" class="form-control"></textarea>
        <br>
        <small class="text-danger">&#10033; Campo de preenchimento obrigatório</small>
    </div>
</div>
