<style>
    .name_link {
        color: gray;
    }

    .active {
        color: #6A74C9
    }


    textarea,
    input[type="text"],
    input[type="date"],
    input[type="email"] {
        border: none;
        resize: none;
        padding: 7px 12px;
        border-radius: 5px;
        background-color: #EAEAEA;
        color: #747474;
        font-weight: 600;

    }

    .select_style {
        border: none;
        resize: none;
        padding: 7px 12px;
        border-radius: 5px;
        background-color: #EAEAEA;
        color: #747474;
        font-weight: 600;
    }

    label {
        color: #747474;
        font-weight: 700;
    }

</style>


<div class="alert alert-danger mb-3" id="warning_msg" style="display: none"><i
        class="fas fa-exclamation-triangle mr-2"></i>Existem dados obrigatórios por preencher. Verifique os campos
    assinalados.</div>


<div class="row nav nav-fill w-100 text-center mx-auto p-3 ">

    <a class="nav-item nav-link active border p-3 m-1 bg-white rounded shadow-sm name_link" id="agent-type-tab"
        data-toggle="tab" href="#agent_type" role="tab" aria-controls="agent_type" aria-selected="true">
        <div class="col"><i class="fas fa-share-alt mr-2"></i>Tipo de agente</div>
    </a>


    <a class="nav-item nav-link border p-3 m-1 bg-white rounded shadow-sm name_link" id="personal-tab" data-toggle="tab"
        href="#personal" role="tab" aria-controls="documentation" aria-selected="false">
        <div class="col"><i class="fas fa-user mr-2"></i>Dados pessoais</div>
    </a>


    <a class="nav-item nav-link border p-3 m-1 bg-white rounded shadow-sm name_link" id="documents-tab"
        data-toggle="tab" href="#documents" role="tab" aria-controls="documents" aria-selected="false">
        <div class="col" style="min-width: 197px"><i class="far fa-id-card mr-2"></i>Documentos
        </div>
    </a>


    <a class="nav-item nav-link border p-3 m-1 bg-white rounded shadow-sm name_link" id="contacts-tab" data-toggle="tab"
        href="#contacts" role="tab" aria-controls="contacts" aria-selected="false">
        <div class="col"><i class="fas fa-comments mr-2"></i>Contactos</div>
    </a>


    <a class="nav-item nav-link border p-3 m-1 bg-white rounded shadow-sm name_link border" id="financas-tab"
        data-toggle="tab" href="#financas" role="tab" aria-controls="financas" aria-selected="false">
        <div class="col"><i class="fas fa-chart-pie mr-2"></i>Financeiro</div>
    </a>


</div>


<div class="bg-white shadow-sm mb-4 p-4" style="margin-top:-30px">

    <div class="tab-content p-2 mt-3" id="myTabContent">


        {{-- Conteudo: Tipo de Agente --}}
        <div class="tab-pane fade show active" id="agent_type" role="tabpanel" aria-labelledby="agent-type-tab">

            <div class="row">
                <div class="col" style="min-width: 300px">

                    {{-- INPUT Tipo de agente --}}
                    <label for="tipo">Tipo de agente:</label><br>
                    <select id="tipo" name="tipo" class="form-control select_style" required>
                        <option {{old('tipo',$agent->tipo)=='Agente'?"selected":""}} value="Agente">Agente</option>
                        <option {{old('tipo',$agent->tipo)=='Subagente'?"selected":""}} value="Subagente">Subagente
                        </option>
                    </select>

                    <br>

                </div>


                <div class="col" style="min-width: 300px">

                    <div id="div_subagente" style="display: none">
                        {{-- INPUT Subagente de...... --}}
                        <label for="subagent">Subagente de:</label><br>

                        {{-- campo auxiliar: id do agente --}}
                        <input type="hidden" id="aux_idAgenteAssociado"
                            value="{{old('idAgenteAssociado',$agent->idAgenteAssociado)}}">


                        {{-- disabled se o tipo escolhido for "subagente" --}}

                        <select id="idAgenteAssociado" name="idAgenteAssociado" class="form-control select_style"
                            required>

                            <option hidden value="0">(escolha o agente)</option>

                            {{-- Lista todos os agentes exepto o que esta a ser editado --}}
                            @foreach($listagents as $agentx)
                            @if ($agentx->idAgente != $agent->idAgente && $agentx->tipo != "Subagente" )
                            <option value="{{$agentx->idAgente}}">{{$agentx->nome}} {{$agentx->apelido}}
                                ({{$agentx->pais}})
                            </option>
                            @endif
                            @endforeach

                        </select>

                        <div class="invalid-feedback mt-2"><i class="fas fa-times mr-2"></i>Escolha um subagente</div>
                    </div>
                </div>

                <br>

            </div>

            <hr>

            <div class="row text-secondary mt-4">
                <div class="col">
                    <label><i class="far fa-question-circle"></i> Informações sobre permissões</label>
                </div>
            </div>

            <div class="row text-secondary">

                <div class="col p-3 m-2 bg-light border rounded" style="min-width: 280px">
                    <div><strong>O agente:</strong></div>
                    <div class="my-3">- Tem acesso à lista dos seus clientes e à dos seus subagentes</div>
                    <div class="my-3">- Tem acesso à lista dos seus subagentes</div>



                </div>

                <br><br>

                <div class="col p-3 m-2 bg-light border rounded"  style="min-width: 280px">
                    <div><strong>O subagente:</strong></div>
                    <div class="my-3">- Apenas tem acesso à lista dos seus clientes</div>
                    <div class="my-3">- Tem acesso à página de perfil do seu superior</div>
                </div>

            </div>


            <div class="row  text-secondary">

                <div class="col m-2 p-3 bg-light border rounded">
                    <div><strong>Ambos:</strong></div>
                    <div class="my-3">- Podem carregar documentos nas fichas dos seus clientes</div>
                    <div class="my-3">- Têm acesso às notificações públicas</div>
                    <div class="my-3">- Podem visualizar os ficheiros públicos inseridos na biblioteca</div>
                    <div class="my-3">- Têm agenda e lista telefónica privada</div>
                    <div class="mt-3">- Podem utilizar a funcionalidade de "Reportar problema"</div>
                </div>

            </div>

        </div>

        {{-- Conteudo: Dados pessoais --}}
        <div class="tab-pane fade" id="personal" role="tabpanel" aria-labelledby="personal-tab">

            <div class="row">
                <div class="col">

                    <div class="row">

                        <div class="col" style="min-width: 300px">
                            {{-- INPUT nome --}}
                            <label for="nome">Nome:</label><br>
                            <input type="text" class="form-control" name="nome" id="nome"
                                value="{{old('nome',$agent->nome)}}" placeholder="Insira o nome" maxlength="25"
                                required><br>
                        </div>


                        <div class="col" style="min-width: 300px">
                            {{-- INPUT apelido --}}
                            <label for="apelido">Apelido:</label><br>
                            <input type="text" class="form-control" name="apelido" id="apelido"
                                value="{{old('apelido',$agent->apelido)}}" placeholder="Insira o apelido" maxlength="25"
                                required>
                        </div>

                    </div>

                    <br>

                    <div class="row">
                        <div class="col" style="min-width: 300px">
                            {{-- INPUT GENERO --}}
                            <label for="genero">Género:</label><br>
                            <select id="genero" name="genero" class="form-control select_style" required>
                                <option value="" selected hidden>Selecione o género</option>
                                <option {{old('genero',$agent->genero)=='F'?"selected":""}} value="F">Feminino</option>
                                <option {{old('genero',$agent->genero)=='M'?"selected":""}} value="M">Masculino</option>
                            </select>

                            <br>
                        </div>

                        <div class="col" style="min-width: 300px">
                            {{-- INPUT dataNasc --}}
                            <label for="dataNasc">Data de nascimento:</label><br>
                            <input type="date" class="form-control" name="dataNasc" id="dataNasc"
                                value="{{old('dataNasc',$agent->dataNasc)}}" required>
                        </div>

                    </div>

                    <br>

                </div>

                <div class="col col-4 text-center">
                    {{-- INPUT fotografia --}}
                    <div>
                        <label for="fotografia">Fotografia:</label>
                        <input type='file' id="fotografia" name="fotografia" style="display:none" accept="image/*" />
                    </div>

                    <!-- Verifica se a imagem já existe-->
                    @if ($agent->fotografia!=null)
                    <img src="{{Storage::disk('public')->url('agent-documents/'.$agent->idAgente.'/').$agent->fotografia}}"
                        id="preview" class="m-2 p-1 border rounded bg-white shadow-sm"
                        style="width:80%;cursor:pointer;min-width:118px;" alt="Imagem de apresentação"
                        title="Clique para mudar a imagem de apresentação" />

                    @else
                    <img src="{{Storage::disk('public')->url('default-photos/addImg.png')}}" id="preview"
                        class="m-2 p-1 border rounded bg-white shadow-sm"
                        style="width:80%;cursor:pointer;min-width:118px;" alt="Imagem de apresentação"
                        title="Clique para mudar a imagem de apresentação" />
                    @endif
                    <br><small class="text-muted">(clique para mudar)</small>
                </div>

            </div>

        </div>





        {{-- Conteudo: Documentos  --}}
        <div class="tab-pane fade" id="documents" role="tabpanel" aria-labelledby="documents-tab">

            <div class="row">
                <div class="col">
                    {{-- INFO_DOC CAMPO ESCONDIDO: NÃO UTILIZADO --}}
                    <input type="hidden" name="info_doc" name="info_doc" value="">


                    {{-- INPUT DOC ID --}}
                    <label for="num_doc">Número de identificação pessoal:</label><br>
                    <input type="text" class="form-control" name="num_doc" id="num_doc"
                        value="{{old('num_doc',$agent->num_doc)}}" placeholder="Numero de identificação pessoal"
                        required maxlength="20" required>

                    <br>

                    {{-- INPUT NIF --}}
                    <label for="NIF">NIF:</label><br>
                    <input type="text" class="form-control" name="NIF" id="NIF" value="{{old('NIF',$agent->NIF)}}"
                        placeholder="Insira o NIF" maxlength="20">
                </div>


                {{-- Documento de identificação --}}
                <div class="col col-4 text-center">
                    <label for="img_doc">Documento de identificação:</label>
                    <input type='file' id="img_doc" name="img_doc" style="display:none"
                        accept="application/pdf, image/*" />


                    <div class="card mx-auto p-4 rounded shadow-sm text-center "
                        style="width:80%;min-width:118px;min-height:120px">

                        @if ( $agent->img_doc!=null)
                        <a href="#" title="Ver documento" id="doc_preview" class="name_link">
                            <i class="far fa-id-card mt-2" style="font-size:50px"></i>
                            <div id="name_id_file" class="text-muted">{{old('img_doc',$agent->img_doc)}}</div>
                        </a>
                        @else
                        <a style="display:none;cursor:pointer" title="Ver documento" id="doc_preview" class="name_link">
                            <i class="far fa-id-card mt-2" style="font-size:50px"></i>
                            <div id="name_id_file" class="text-muted">{{old('img_doc',$agent->img_doc)}}</div>
                        </a>
                        <i id="doc_preview_file" class="fas fa-plus-circle mt-2" style="font-size:60px;cursor:pointer"
                            title="Clique adicionar o documento de identificação"></i>
                        @endif

                    </div>
                    <small class="text-muted">(clique para mudar)</small>
                </div>



            </div>


        </div>


        {{-- Conteudo: Contactos --}}
        <div class="tab-pane fade " id="contacts" role="tabpanel" aria-labelledby="contacts-tab">
            <div class="row">
                <div class="col">
                    {{-- INPUT email --}}
                    <label for="email">E-mail:</label><br>
                    <input type="email" class="form-control" name="email" id="email"
                        value="{{old('email',$agent->email)}}" placeholder="Insira o email" required maxlength="200">
                </div>

            </div>

            <br>

            <div class="row">
                <div class="col">


                    {{-- INPUT País --}}
                    <label for="pais">País:</label><br>
                    <input type="hidden" id="hidden_pais" value="{{old('pais',$agent->pais)}}">
                    <select id="pais" name="pais" class="form-control select_style" required>
                        @include('agents.partials.countries');
                    </select>
                </div>

                <div class="col">
                    {{-- INPUT morada --}}
                    <label for="morada">Morada:</label><br>
                    <input type="text" class="form-control" name="morada" id="morada"
                        value="{{old('morada',$agent->morada)}}" placeholder="Insira a morada" maxlength="200" required>
                </div>

            </div>

            <br>

            <div class="row">
                <div class="col">
                    {{-- INPUT telefone1 --}}
                    <label for="telefone1">Telefone (principal):</label><br>
                    <input type="text" class="form-control" name="telefone1" id="telefone1"
                        value="{{old('telefone1',$agent->telefone1)}}" placeholder="Insira o telefone" maxlength="20"
                        required>
                </div>

                <div class="col">
                    {{-- INPUT telefone2 --}}
                    <label for="telefone2">Telefone (alternativo):</label><br>
                    <input type="text" class="form-control" name="telefone2" id="telefone2"
                        value="{{old('telefone2',$agent->telefone2)}}" placeholder="Insira o telefone" maxlength="20">
                </div>

                <br>

            </div>

        </div>



        {{-- Conteudo: Financeiro --}}
        <div class="tab-pane fade " id="financas" role="tabpanel" aria-labelledby="financas-tab">

            <div class="row">
                <div class="col">
                    {{-- INPUT IBAN --}}
                    <label for="IBAN">IBAN:</label><br>
                    <input type="text" class="form-control" name="IBAN" id="IBAN" value="{{old('IBAN',$agent->IBAN)}}"
                        placeholder="Insira o IBAN" maxlength="30">
                </div>

            </div>

            <br>

        </div>

    </div>

</div>
