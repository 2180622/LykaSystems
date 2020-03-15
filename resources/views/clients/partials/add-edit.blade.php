<ul class="nav nav-tabs" id="myTab" role="tablist">
    {{-- MENU: Informação pessoal --}}
    <li class="nav-item">
        <a class="nav-link active" id="pessoal-tab" data-toggle="tab" href="#pessoal" role="tab"
            aria-controls="contacts" aria-selected="true">Informação pessoal</a>
    </li>

    {{-- MENU: Dados académicos --}}
    <li class="nav-item">
        <a class="nav-link" id="school-tab" data-toggle="tab" href="#school" role="tab" aria-controls="school"
            aria-selected="false">Dados académicos</a>
    </li>

    {{-- MENU: Contactos --}}
    <li class="nav-item">
        <a class="nav-link" id="contacts-tab" data-toggle="tab" href="#contacts" role="tab" aria-controls="contacts"
            aria-selected="false">Contactos</a>
    </li>

    {{-- MENU: Moradas --}}
    <li class="nav-item">
        <a class="nav-link" id="adresses-tab" data-toggle="tab" href="#adresses" role="tab" aria-controls="adresses"
            aria-selected="false">Moradas</a>
    </li>

    {{-- MENU: Documentação --}}
    <li class="nav-item">
        <a class="nav-link" id="documentation-tab" data-toggle="tab" href="#documentation" role="tab"
            aria-controls="documentation" aria-selected="false">Documentação</a>
    </li>
</ul>

<div class="tab-content p-2 mt-3" id="myTabContent">

    {{-- Conteudo: Informação pessoal --}}
    <div class="tab-pane fade show active" id="pessoal" role="tabpanel" aria-labelledby="pessoal-tab">
        <div class="row">
            <div class="col">
                {{-- INPUT nome --}}
                <label for="nome">Nome:</label><br>
                <input type="text" class="form-control" name="nome" id="nome" value="{{old('nome',$client->nome)}}"
                    placeholder="Insira o nome do aluno"><br>

                {{-- INPUT apelido --}}
                <label for="apelido">Apelido:</label><br>
                <input type="text" class="form-control" name="apelido" id="apelido"
                    value="{{old('apelido',$client->apelido)}}" placeholder="Insira o apelido do aluno"><br>

                {{-- INPUT paisNaturalidade --}}
                <label for="paisNaturalidade">Naturalidade:</label><br>
                <select id="paisNaturalidade" name="paisNaturalidade" class="form-control">
                    @include('clients.partials.countries');
                </select><br>

                {{-- INPUT dataNasc --}}
                <label for="dataNasc">Data de nascimento:</label><br>
                <input type="date" class="form-control" name="dataNasc" id="dataNasc"
                    value="{{old('dataNasc',$client->dataNasc)}}" style="width:250px"><br>
            </div>

            <div class="col col-4 text-center">
                {{-- INPUT fotografia --}}
                <div>
                    <label for="fotografia">Fotografia:</label>
                    <input type='file' id="fotografia" name="fotografia" style="display:none" />

                </div>

                <!-- Verifica se a imagem já existe-->
                @if ($client->fotografia!=null)
                <img src="{{Storage::disk('public')->url('client-photos/').$client->fotografia}}" id="preview"
                    class="m-2 p-1 rounded bg-white shadow-sm" style="width:80%;cursor:pointer;min-width:118px"
                    alt="Imagem de apresentação" title="Clique para mudar a imagem de apresentação" />
                @else
                <img src="{{Storage::disk('public')->url('client-photos/').'default.png'}}" id="preview"
                    class="m-2 p-1 rounded bg-white shadow-sm" style="width:80%;cursor:pointer;min-width:118px"
                    alt="Imagem de apresentação" title="Clique para mudar a imagem de apresentação" />
                @endif
                <div class="mt-2" style="min-width:139px"><a href="#" id="search_btn" class="top-button">Procurar ficheiro</a></div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                {{-- INPUT obsPessoais --}}
                <label for="obsPessoais">Observações pessoais:</label><br>
                <textarea name="obsPessoais" id="obsPessoais" rows="5"
                    class="form-control">{{old('obsPessoais',$client->obsPessoais)}}</textarea>
            </div>
        </div>
    </div>

    {{-- Conteudo: Dados académicos --}}
    <div class="tab-pane fade" id="school" role="tabpanel" aria-labelledby="school-tab">
        <div class="row">
            <div class="col">
                {{-- INPUT nivEstudoAtual --}}
                <label for="nivEstudoAtual">Nivel de estudos(atual):</label><br>
                <select class="form-control" name="nivEstudoAtual" id="nivEstudoAtual">
                    <option selected hidden></option>
                    <option {{old('nivEstudoAtual',$client->nivEstudoAtual)=='1'?"selected":""}}>1</option>
                    <option {{old('nivEstudoAtual',$client->nivEstudoAtual)=='2'?"selected":""}}>2</option>
                    <option {{old('nivEstudoAtual',$client->nivEstudoAtual)=='3'?"selected":""}}>3</option>
                </select><br>
            </div>
        </div>


        <div class="row">
            <div class="col">
                {{-- INPUT nivEstudoAtual --}}
                <label for="nomeInstituicaoOrigem">Nome da instituição de origem:</label><br>
                <input type="text" class="form-control" name="nomeInstituicaoOrigem" id="nomeInstituicaoOrigem"
                    value="{{old('nomeInstituicaoOrigem',$client->nomeInstituicaoOrigem)}}"><br>
            </div>


            <div class="col">
                {{-- Cidade de Origem  --}}
                <label for="morada">Cidade da Instituição de Origem:</label><br>
                <input type="text" class="form-control" name="cidadeInstituicaoOrigem" id="morada"
                    value="{{old('cidadeInstituicaoOrigem',$client->cidadeInstituicaoOrigem)}}"><br>
            </div>

        </div>

        <div class="row">
            <div class="col-md-12">
                {{-- INPUT obsAcademicas --}}
                <label for="obsAcademicas">Observações académicas:</label><br>
                <textarea name="obsAcademicas" id="obsAcademicas" rows="5"
                    class="form-control">{{old('obsAcademicas',$client->obsAcademicas)}}</textarea>
            </div>
        </div>
    </div>


    {{-- Conteudo: Contactos --}}
    <div class="tab-pane fade" id="contacts" role="tabpanel" aria-labelledby="contacts-tab">
        {{-- Contactos PESSOAIS --}}
        <div class="row">
            <div class="col">
                <label for="telefone1">Telefone pessoal:</label><br>
                <input type="text" class="form-control" name="telefone1" id="telefone1"
                    value="{{old('telefone1',$client->telefone1)}}"><br>
            </div>
            <div class="col">
                <label for="telefone2">Telemóvel pessoal:</label><br>
                <input type="text" class="form-control" name="telefone2" id="telefone2"
                    value="{{old('telefone2',$client->telefone2)}}"><br>
            </div>
        </div>

        <div class="row">
            <div class="col">
                <label for="email">E-mail pessoal:</label><br>
                <input type="text" class="form-control" name="email" id="email"
                    value="{{old('email',$client->email)}}"><br>
            </div>
        </div>

        {{-- Contactos dos PAIS --}}
        <div class="row mt-4">
            <div class="col">

                <label for="nomePai">Nome do pai:</label><br>
                <input type="text" class="form-control" name="nomePai" id="nomePai"
                    value="{{old('nomePai',$client->nomePai)}}"><br>

                <label for="telefonePai">Telefone do pai:</label><br>
                <input type="text" class="form-control" name="telefonePai" id="telefonePai"
                    value="{{old('telefonePai',$client->telefonePai)}}"><br>

                <label for="emailPai">E-mail do pai:</label><br>
                <input type="text" class="form-control" name="emailPai" id="emailPai"
                    value="{{old('emailPai',$client->emailPai)}}"><br>
            </div>

            <div class="col">
                <label for="nomeMae">Nome da mãe:</label><br>
                <input type="text" class="form-control" name="nomeMae" id="nomeMae"
                    value="{{old('nomeMae',$client->nomeMae)}}"><br>

                <label for="telefoneMae">Telefone da mãe:</label><br>
                <input type="text" class="form-control" name="telefoneMae" id="telefoneMae"
                    value="{{old('telefoneMae',$client->telefoneMae)}}"><br>

                <label for="emailMae">E-mail da mãe:</label><br>
                <input type="text" class="form-control" name="emailMae" id="emailMae"
                    value="{{old('emailMae',$client->emailMae)}}"><br>
            </div>

        </div>

    </div>


    {{-- Conteudo: Moradas --}}
    <div class="tab-pane fade" id="adresses" role="tabpanel" aria-labelledby="adresses-tab">

        <div class="row ">
            <div class="col">
                {{-- Morada de residência em Portugal --}}
                <label for="moradaResidencia">Morada de residência em Portugal:</label><br>
                <input type="text" class="form-control" name="moradaResidencia" id="moradaResidencia"
                    value="{{old('moradaResidencia',$client->moradaResidencia)}}"><br>
            </div>


        </div>


        <div class="row mt-4">

            <div class="col">
                {{-- Morada de residência no pais de origem --}}
                <label for="morada">Morada no pais de origem:</label><br>
                <input type="text" class="form-control" name="morada" id="morada"
                    value="{{old('morada',$client->morada)}}"><br>
            </div>

            <div class="col">
                {{-- Cidade de Origem  --}}
                <label for="morada">Cidade de origem:</label><br>
                <input type="text" class="form-control" name="cidade" id="cidade"
                    value="{{old('cidade',$client->cidade)}}"><br>
            </div>

        </div>



    </div>


    {{-- Conteudo: Documentação --}}
    <div class="tab-pane fade" id="documentation" role="tabpanel" aria-labelledby="documentation-tab">

        {{-- INUPUT IDENTIFICAÇÃO --}}
        <div class="row">
            <div class="col">
                <label for="numCCid">Número de cartão de cidadão:</label><br>
                <input type="text" class="form-control" name="numCCid" id="numCCid"
                    value="{{old('numCCid',$client->numCCid)}}"><br>
            </div>
            <div class="col">
                <label for="NIF">Número de identificação fiscal:</label><br>
                <input type="text" class="form-control" name="NIF" id="NIF" value="{{old('NIF',$client->NIF)}}"><br>
            </div>
        </div>




        {{-- INUPUTS DADOS DE PASSAPORTE --}}
        <div class="row mt-4">

            <div class="col">
                {{-- INUPUT numPassaport --}}
                <label for="numPassaport">Numero do passaporte:</label><br>
                <input type="text" class="form-control" name="numPassaport" id="numPassaport"
                    value="{{old('numPassaport',$client->numPassaport)}}"><br>
            </div>
            <div class="col">
                {{-- INUPUT dataValidPP --}}
                <label for="dataValidPP">Data de validade do passaporte:</label><br>
                <input type="date" class="form-control" name="dataValidPP" id="dataValidPP"
                    value="{{old('dataValidPP',$client->dataValidPP)}}"><br>
            </div>
        </div>

        <div class="row">

            <div class="col">
                {{-- INUPUT numPassaport --}}
                <label for="passaportPaisEmi">Pais emissor do passaporte:</label><br>
                <select id="passaportPaisEmi" name="passaportPaisEmi" class="form-control">
                    @include('clients.partials.countries');
                </select>
            </div>
            <div class="col">
                {{-- INUPUT dataValidPP --}}
                <label for="localEmissaoPP">Local de emissão do passaporte:</label><br>
                <input type="text" class="form-control" name="localEmissaoPP" id="localEmissaoPP"
                    value="{{old('localEmissaoPP',$client->localEmissaoPP)}}"><br>
            </div>
        </div>


        {{-- DADOS FINANCEIROS --}}
        <div class="row mt-4">
            <div class="col">
                <label for="IBAN" class="mr-2">IBAN: </label><small>(25 caracteres)</small><br>
                <input type="text" class="form-control" name="IBAN" id="IBAN" value="{{old('IBAN',$client->IBAN)}}"><br>

                <label for="obsFinanceiras">Observações Financeiras:</label><br>
                <textarea name="obsFinanceiras" id="obsFinanceiras" rows="5"
                    class="form-control">{{old('obsFinanceiras',$client->obsFinanceiras)}}</textarea>
            </div>
        </div>


    </div>



</div>
