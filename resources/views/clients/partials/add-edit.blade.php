<ul class="nav nav-tabs" id="myTab" role="tablist">
    {{-- MENU: Informação pessoal --}}
    <li class="nav-item">
        <a class="nav-link active" id="pessoal-tab" data-toggle="tab" href="#pessoal" role="tab"
            aria-controls="contacts" aria-selected="true"><i
                class="fas fa-exclamation-circle text-danger warning_sign mr-2" id="warning_info_pessoal"
                title="Existem campos obrigatórios por preencher"></i>Informação pessoal</a>
    </li>


    {{-- MENU: Documentação --}}
    <li class="nav-item">
        <a class="nav-link" id="documentation-tab" data-toggle="tab" href="#documentation" role="tab"
            aria-controls="documentation" aria-selected="false"><i
                class="fas fa-exclamation-circle text-danger warning_sign mr-2" id="warning_documentation"
                title="Existem campos obrigatórios por preencher"></i>Documentos pessoais</a>
    </li>


    {{-- MENU: Dados académicos --}}
    <li class="nav-item">
        <a class="nav-link" id="school-tab" data-toggle="tab" href="#school" role="tab" aria-controls="school"
            aria-selected="false"><i class="fas fa-exclamation-circle text-danger warning_sign mr-2"
                id="warning_academico" title="Existem campos obrigatórios por preencher"></i>Dados académicos</a>
    </li>

    {{-- MENU: Contactos --}}
    <li class="nav-item">
        <a class="nav-link" id="contacts-tab" data-toggle="tab" href="#contacts" role="tab" aria-controls="contacts"
            aria-selected="false"><i class="fas fa-exclamation-circle text-danger warning_sign mr-2"
                id="warning_contactos" title="Existem campos obrigatórios por preencher"></i>Contactos</a>
    </li>

    {{-- MENU: Moradas --}}
    <li class="nav-item">
        <a class="nav-link" id="adresses-tab" data-toggle="tab" href="#adresses" role="tab" aria-controls="adresses"
            aria-selected="false"><i class="fas fa-exclamation-circle text-danger warning_sign mr-2"
                id="warning_moradas" title="Existem campos obrigatórios por preencher"></i>Moradas</a>
    </li>


</ul>

<div class="tab-content p-2 mt-3" id="myTabContent">

    {{-- Conteudo: Informação pessoal --}}
    <div class="tab-pane fade show active" id="pessoal" role="tabpanel" aria-labelledby="pessoal-tab">
        <div class="row">
            <div class="col">

                <div class="row">
                    <div class="col">
                        {{-- INPUT nome --}}
                        <label for="nome">Nome:</label><br>
                        <input type="text" class="form-control" name="nome" id="nome"
                            value="{{old('nome',$client->nome)}}" placeholder="Insira o nome do aluno" maxlength="20"
                            required>
                    </div>
                    <div class="col">
                        {{-- INPUT apelido --}}
                        <label for="apelido">Apelido:</label><br>
                        <input type="text" class="form-control" name="apelido" id="apelido"
                            value="{{old('apelido',$client->apelido)}}" placeholder="Insira o apelido do aluno"
                            maxlength="20" required>
                    </div>
                </div>

                <br>

                <div class="row mb-4">

                    <div class="col">
                        {{-- INPUT GENERO --}}
                        <label for="genero">Género:</label><br>
                        <select id="genero" name="genero" class="form-control" required>
                            <option value="" selected hidden></option>
                            <option {{old('genero',$client->genero)=='F'?"selected":""}} value="F">Feminino</option>
                            <option {{old('genero',$client->genero)=='M'?"selected":""}} value="M">Masculino</option>
                        </select>
                    </div>

                    <div class="col">

                        {{-- INPUT paisNaturalidade --}}
                        <label for="paisNaturalidade">Naturalidade:</label><br>
                        <input type="hidden" id="hidden_paisNaturalidade"
                            value="{{old('paisNaturalidade',$client->paisNaturalidade)}}">
                        <select id="paisNaturalidade" name="paisNaturalidade" class="form-control" required>
                            @include('clients.partials.countries');
                        </select>
                    </div>

                </div>


                {{-- INPUT dataNasc --}}
                <label for="dataNasc">Data de nascimento:</label><br>
                <input type="date" class="form-control" name="dataNasc" id="dataNasc"
                    value="{{old('dataNasc',$client->dataNasc)}}" style="width:40%" required><br>
            </div>

            <div class="col col-4 text-center">
                {{-- INPUT fotografia --}}
                <div>
                    <label for="fotografia">Fotografia:</label>
                    <input type='file' id="fotografia" name="fotografia" style="display:none" accept="image/*" />

                </div>

                <!-- Verifica se a imagem já existe-->
                @if ($client->fotografia!=null)
                <img src="{{Storage::disk('public')->url('client-documents/'.$client->idCliente.$client->nome.'/').$client->fotografia}}"
                    id="preview" class="m-2 p-1 rounded bg-white shadow-sm"
                    style="width:80%;cursor:pointer;min-width:118px" alt="Imagem de apresentação"
                    title="Clique para mudar a imagem de apresentação" />
                @else
                <img src="{{Storage::disk('public')->url('default-photos/addImg.png')}}" id="preview"
                    class="m-2 p-1 rounded bg-white shadow-sm" style="width:80%;cursor:pointer;min-width:118px"
                    alt="Imagem de apresentação" title="Clique para mudar a imagem de apresentação" />
                @endif
                <br><small class="text-muted">(clique para mudar)</small>
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



    {{-- Conteudo: Documentação --}}
    <div class="tab-pane fade" id="documentation" role="tabpanel" aria-labelledby="documentation-tab">


        {{-- num_docOficial --}}
        <div class="row">
            <div class="col">

                <div class="row">
                    <div class="col">
                        <label for="num_docOficial">Número de identificação pessoal:</label><br>
                        <input type="text" class="form-control" name="num_docOficial" id="num_docOficial"
                            value="{{old('num_docOficial',$client->num_docOficial)}}" required maxlength="20">
                    </div>
                    <div class="col">
                        <label for="dataValidade_docOficial">Data de validade:</label><br>
                        <input type="date" class="form-control" name="dataValidade_docOficial"
                            id="dataValidade_docOficial" value="{{old('info_docOficial',$client->info_docOficial)}}">
                    </div>
                </div>

                <br>

                <label for="NIF">Número de identificação fiscal:</label><br>
                <input type="text" class="form-control" name="NIF" id="NIF" value="{{old('NIF',$client->NIF)}}"
                    maxlength="20"><br>

            </div>


            {{-- INPUT IMG DOCUMENTO identificação --}}
            <div class="col text-center" style="max-width:380px;min-width:298px;">
                <div>
                    <label for="img_docOficial">Documento de identificação:</label>
                    <input type='file' id="img_docOficial" name="img_docOficial" style="display:none"
                        accept="application/pdf, image/*" />
                </div>

                <div class="card mx-auto p-4 rounded shadow-sm text-center "
                    style="width:80%;min-width:118px;min-height:120px">

                    @if ( $client->img_docOficial!=null)
                    <a href="#" title="Clique para adicionar o documento de identificação" id="doc_id_preview"
                        class="name_link">
                        <i class="far fa-id-card mt-2" style="font-size:50px"></i>
                        <div id="name_doc_id_file" class="text-muted">{{old('img_docOficial',$client->img_docOficial)}}
                        </div>
                    </a>
                    @else
                    <a style="display:none;cursor:pointer" title="Clique para adicionar o documento de identificação"
                        id="doc_id_preview" class="name_link">
                        <i class="far fa-id-card mt-2" style="font-size:50px"></i>
                        <div id="name_doc_id_file" class="text-muted">
                            {{old('img_docOficial',$client->img_docOficial)}}</div>
                    </a>
                    <i id="doc_id_preview_file" class="fas fa-plus-circle mt-2" style="font-size:60px;cursor:pointer"
                        title="Clique para adicionar o documento de identificação"></i>
                    @endif

                </div>
                <small class="text-muted">(clique para mudar)</small>

            </div>

        </div>


        <hr>


        {{-- Passaporte --}}
        <div class="row">
            <div class="col">

                <div class="row">
                    <div class="col">
                        {{-- INUPUT numPassaport --}}
                        <label for="numPassaport">Número do passaporte:</label><br>
                        <input type="text" class="form-control" name="numPassaport" id="numPassaport"
                            value="{{$infosPassaport->numPassaport ?? null }}" required maxlength="20">
                    </div>
                    <div class="col">
                        {{-- INUPUT dataValidPP --}}
                        <label for="dataValidPP">Data de validade do passaporte:</label><br>
                        <input type="date" class="form-control" name="dataValidPP" id="dataValidPP"
                            value="{{$infosPassaport->dataValidPP ?? null }}" required>
                    </div>
                </div>

                <br>

                <div class="row">
                    <div class="col">
                        {{-- INUPUT passaportPaisEmi --}}
                        <label for="passaportPaisEmi">Pais emissor do passaporte:</label><br>
                        <input type="hidden" id="hidden_passaportPaisEmi"
                            value="{{$infosPassaport->passaportPaisEmi ?? null }}">
                        <select id="passaportPaisEmi" name="passaportPaisEmi" class="form-control" required>
                            @include('clients.partials.countries');
                        </select>
                    </div>
                    <div class="col">
                        {{-- INUPUT localEmissaoPP --}}
                        <label for="localEmissaoPP">Local de emissão do passaporte:</label><br>
                        <input type="text" class="form-control" name="localEmissaoPP" id="localEmissaoPP"
                            value="{{$infosPassaport->localEmissaoPP ?? null }}" maxlength="30" required>
                    </div>
                </div>

            </div>



            <div class="col text-center" style="max-width:380px;min-width:298px;">
                {{-- INPUT IMG PASSAPORTE --}}
                <div>
                    <label for="img_Passaport">Passaporte:</label>
                    <input type='file' id="img_Passaport" name="img_Passaport" style="display:none"
                        accept="application/pdf, image/*" />
                </div>

                <div class="card mx-auto p-4 rounded shadow-sm text-center "
                    style="width:80%;min-width:118px;min-height:120px">

                    @if ( $client->img_Passaport!=null)
                    <a href="#" title="Clique adicionar o passaporte" id="passport_preview" class="name_link">
                        <i class="far fa-id-card mt-2" style="font-size:50px"></i>
                        <div id="name_passaport_file" class="text-muted">{{old('img_Passaport',$client->img_Passaport)}}
                        </div>
                    </a>
                    @else
                    <a style="display:none;cursor:pointer" class="name_link" title="Clique adicionar o passaporte"
                        id="passport_preview">
                        <i class="far fa-id-card mt-2" style="font-size:50px"></i>
                        <div id="name_passaport_file" class="text-muted">{{old('img_Passaport',$client->img_Passaport)}}
                        </div>
                    </a>
                    <i id="passport_preview_file" class="fas fa-plus-circle mt-2" style="font-size:60px;cursor:pointer"
                        title="Clique adicionar o passaporte"></i>
                    @endif

                </div>
                <small class="text-muted">(clique para mudar)</small>

            </div>

        </div>


        <hr>


        <div class="row ">
            <div class="col mr-3">


                {{-- DADOS FINANCEIROS --}}
                {{-- INUPUT IBAN --}}
                <label for="IBAN" class="mr-2">IBAN: </label><br>
                <input type="text" class="form-control" name="IBAN" id="IBAN" value="{{old('IBAN',$client->IBAN)}}"
                    maxlength="25" required><br>

                {{-- INUPUT Observações Financeiras --}}
                <label for="obsFinanceiras">Observações Financeiras:</label><br>
                <textarea name="obsFinanceiras" id="obsFinanceiras" rows="5"
                    class="form-control">{{old('obsFinanceiras',$client->obsFinanceiras)}}</textarea><br><br>
            </div>


        </div>


    </div>



    {{-- Conteudo: Dados académicos --}}
    <div class="tab-pane fade" id="school" role="tabpanel" aria-labelledby="school-tab">
        <div class="row">
            <div class="col mr-3">
                {{-- INPUT nivEstudoAtual --}}
                <label for="nivEstudoAtual">Nivel de estudos(atual):</label><br>
                <select class="form-control" name="nivEstudoAtual" id="nivEstudoAtual" required>
                    <option value="" selected hidden></option>
                    <option {{old('nivEstudoAtual',$client->nivEstudoAtual)=='1'?"selected":""}}>1</option>
                    <option {{old('nivEstudoAtual',$client->nivEstudoAtual)=='2'?"selected":""}}>2</option>
                    <option {{old('nivEstudoAtual',$client->nivEstudoAtual)=='3'?"selected":""}}>3</option>
                </select><br>

                {{-- INPUT nivEstudoAtual --}}
                <label for="nomeInstituicaoOrigem">Nome da instituição de origem:</label><br>
                <input type="text" class="form-control" name="nomeInstituicaoOrigem" id="nomeInstituicaoOrigem"
                    value="{{old('nomeInstituicaoOrigem',$client->nomeInstituicaoOrigem)}}" required maxlength="50"><br>

                {{-- Cidade de Origem  --}}
                <label for="morada">Cidade da Instituição de Origem:</label><br>
                <input type="text" class="form-control" name="cidadeInstituicaoOrigem" id="cidadeInstituicaoOrigem"
                    value="{{old('cidadeInstituicaoOrigem',$client->cidadeInstituicaoOrigem)}}" required
                    maxlength="50"><br>

                {{-- INPUT obsAcademicas --}}
                <label for="obsAcademicas">Observações académicas:</label><br>
                <textarea name="obsAcademicas" id="obsAcademicas" rows="5"
                    class="form-control">{{old('obsAcademicas',$client->obsAcademicas)}}</textarea>


            </div>

            <div class="col">
                <div class="text-center">Documentos académicos</div><br>
                <div class="text-muted text-center"><small>++++ (lista de ficheiros) ++++</small></div>
            </div>


        </div>
    </div>





    {{-- Conteudo: Contactos --}}
    <div class="tab-pane fade" id="contacts" role="tabpanel" aria-labelledby="contacts-tab">
        {{-- Contactos PESSOAIS --}}
        <div class="row">
            <div class="col">
                <label for="telefone1">Telefone pessoal(1):</label><br>
                <input type="text" class="form-control" name="telefone1" id="telefone1"
                    value="{{old('telefone1',$client->telefone1)}}" maxlength="20" required maxlength="20"><br>
            </div>
            <div class="col">
                <label for="telefone2">Telefone pessoal(2):</label><br>
                <input type="text" class="form-control" name="telefone2" id="telefone2"
                    value="{{old('telefone2',$client->telefone2)}}" maxlength="20"><br>
            </div>
        </div>

        <div class="row">
            <div class="col">
                <label for="email">E-mail pessoal:</label><br>
                <input type="email" class="form-control" name="email" id="email" value="{{old('email',$client->email)}}"
                    required maxlength="250"><br>
            </div>
        </div>

        {{-- Contactos dos PAIS --}}
        <div class="row mt-4">
            <div class="col">

                <label for="nomePai">Nome do pai:</label><br>
                <input type="text" class="form-control" name="nomePai" id="nomePai"
                    value="{{old('nomePai',$client->nomePai)}}" maxlength="250"><br>

                <label for="telefonePai">Telefone do pai:</label><br>
                <input type="text" class="form-control" name="telefonePai" id="telefonePai"
                    value="{{old('telefonePai',$client->telefonePai)}}" maxlength="20"><br>

                <label for="emailPai">E-mail do pai:</label><br>
                <input type="email" class="form-control" name="emailPai" id="emailPai"
                    value="{{old('emailPai',$client->emailPai)}}" maxlength="250"><br>
            </div>

            <div class="col">
                <label for="nomeMae">Nome da mãe:</label><br>
                <input type="text" class="form-control" name="nomeMae" id="nomeMae"
                    value="{{old('nomeMae',$client->nomeMae)}}" maxlength="250"><br>

                <label for="telefoneMae">Telefone da mãe:</label><br>
                <input type="text" class="form-control" name="telefoneMae" id="telefoneMae"
                    value="{{old('telefoneMae',$client->telefoneMae)}}" maxlength="20"><br>

                <label for="emailMae">E-mail da mãe:</label><br>
                <input type="email" class="form-control" name="emailMae" id="emailMae"
                    value="{{old('emailMae',$client->emailMae)}}" maxlength="250"><br>
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
                    value="{{old('moradaResidencia',$client->moradaResidencia)}}" maxlength="255" required><br>
            </div>


        </div>


        <div class="row mt-4">

            <div class="col">
                {{-- Morada de residência no pais de origem --}}
                <label for="morada">Morada no pais de origem:</label><br>
                <input type="text" class="form-control" name="morada" id="morada"
                    value="{{old('morada',$client->morada)}}" maxlength="255" required><br>
            </div>

            <div class="col">
                {{-- Cidade de Origem  --}}
                <label for="cidade">Cidade de origem:</label><br>
                <input type="text" class="form-control" name="cidade" id="cidade"
                    value="{{old('cidade',$client->cidade)}}" maxlength="50" required><br>
            </div>

        </div>



    </div>



</div>
