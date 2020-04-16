<div class="row font-weight-bold" style="color:#6A74C9">

    <div class="col">

        <div class="row">

            <div class="col">
                {{-- INPUT Tipo de agente --}}



                <label for="tipo">Tipo:</label><br>
                <select id="tipo" name="tipo" class="form-control">
                    <option {{old('tipo',$agent->tipo)=='Agente'?"selected":""}} value="Agente">Agente</option>
                    <option {{old('tipo',$agent->tipo)=='Subagente'?"selected":""}} value="Subagente">Subagente</option>
                </select>
            </div>

            <div class="col">
                {{-- INPUT Subagente de...... --}}
                <label for="subagent">Subagente de:</label><br>

                {{-- campo auxiliar: id do agente --}}
                <input type="hidden" id="aux_idAgenteAssociado"
                    value="{{old('idAgenteAssociado',$agent->idAgenteAssociado)}}" disabled>


                {{-- disabled se o tipo escolhido for "subagente" --}}
                <select id="idAgenteAssociado" name="idAgenteAssociado" class="form-control" required>

                    <option hidden value="0">(escolha o agente)</option>

                    {{-- Lista todos os agentes exepto o que esta a ser editado --}}
                    @foreach($listagents as $agentx)
                        @if ($agentx->idAgente != $agent->idAgente && $agentx->tipo != "Subagente" )
                            <option value="{{$agentx->idAgente}}">{{$agentx->nome}} {{$agentx->apelido}} ({{$agentx->pais}})</option>
                        @endif
                    @endforeach

                </select>

                <div class="invalid-feedback">Escolha um subagente</div>

            </div>
        </div>

        <br>

        <div class="row">

            <div class="col">

                {{-- INPUT nome --}}
                <label for="nome">Nome:</label><br>
                <input type="text" class="form-control" name="nome" id="nome" value="{{old('nome',$agent->nome)}}"
                    placeholder="Insira o nome" maxlength="25" required>
            </div>

            <div class="col">
                {{-- INPUT apelido --}}
                <label for="apelido">Apelido:</label><br>
                <input type="text" class="form-control" name="apelido" id="apelido"
                    value="{{old('apelido',$agent->apelido)}}" placeholder="Insira o apelido" maxlength="25" required>

            </div>

        </div>


        <br>


        <div class="row">

            <div class="col">
                {{-- INPUT GENERO --}}
                <label for="genero">Género:</label><br>
                <select id="genero" name="genero" class="form-control" required>
                    <option {{old('genero',$agent->genero)=='F'?"selected":""}} value="F">Feminino</option>
                    <option {{old('genero',$agent->genero)=='M'?"selected":""}} value="M">Masculino</option>
                </select>
            </div>

            <div class="col">
                {{-- INPUT dataNasc --}}
                <label for="dataNasc">Data de nascimento:</label><br>
                <input type="date" class="form-control" name="dataNasc" id="dataNasc"
                    value="{{old('dataNasc',$agent->dataNasc)}}" required>
            </div>

        </div>


        <br>


        <div class="row">

            <div class="col">
                {{-- INPUT País --}}
                <label for="pais">País:</label><br>
                <input type="hidden" id="hidden_pais" value="{{old('pais',$agent->pais)}}">
                <select id="pais" name="pais" class="form-control" required>
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

        </div>

        <br>


        <div class="row">

            <div class="col">
                {{-- INPUT email --}}
                <label for="email">E-mail:</label><br>
                <input type="email" class="form-control" name="email" id="email" value="{{old('email',$agent->email)}}"
                    placeholder="Insira o email" required maxlength="200">
            </div>

        </div><br>



        <div class="row">

            <div class="col">
                {{-- INFO_DOC CAMPO ESCONDIDO: NÃO UTILIZADO --}}
                <input type="hidden" name="info_doc" name="info_doc" value="">


                {{-- INPUT DOC ID --}}
                <label for="num_doc">Número de identificação pessoal:</label><br>
                <input type="text" class="form-control" name="num_doc" id="num_doc"
                    value="{{old('num_doc',$agent->num_doc)}}" placeholder="Numero de identificação pessoal" required
                    maxlength="50" required>
            </div>

            <div class="col">
                {{-- INPUT NIF --}}
                <label for="NIF">NIF:</label><br>
                <input type="text" class="form-control" name="NIF" id="NIF" value="{{old('NIF',$agent->NIF)}}"
                    placeholder="Insira o NIF" maxlength="20">
            </div>

        </div>

    </div>





    <div class="col col-4 text-center">
        {{-- INPUT fotografia --}}
        <div>
            <label for="fotografia">Fotografia:</label>
            <input type='file' id="fotografia" name="fotografia" style="display:none" accept="image/*" />

        </div>

        <!-- Verifica se a imagem já existe-->
        @if ($agent->fotografia!=null)
        <img src="{{Storage::disk('public')->url('agent-photos/').$agent->fotografia}}" id="preview"
            class="m-2 p-1 rounded bg-white shadow-sm" style="width:80%;cursor:pointer;min-width:118px;"
            alt="Imagem de apresentação" title="Clique para mudar a imagem de apresentação" />

        @else
        <img src="{{Storage::disk('public')->url('default-photos/addImg.png')}}" id="preview"
            class="m-2 p-1 rounded bg-white shadow-sm" style="width:80%;cursor:pointer;min-width:118px;"
            alt="Imagem de apresentação" title="Clique para mudar a imagem de apresentação" />
        @endif
        <br><small class="text-muted">(clique para mudar)</small>
        {{--         <div class="mt-3" style="min-width:139px"><a href="#" id="search_btn" class="top-button">Procurar
                ficheiro</a></div>
 --}}


        <div class=" mt-5">
            <label for="img_doc">Documento de identificação:</label>
            <input type='file' id="img_doc" name="img_doc" style="display:none" accept="application/pdf, image/*" />
        </div>

        <div class="card mx-auto p-4 rounded shadow-sm text-center " style="width:80%;min-width:118px;min-height:120px">

            @if ( $agent->img_doc!=null)
                <a href="{{Storage::disk('public')->url('agent-docs/').$agent->img_doc}}" title="Ver documento" id="doc_preview">
                    <i class="far fa-id-card mt-2" style="font-size:50px"></i>
                    <div id="name_id_file" class="text-muted">{{old('img_doc',$agent->img_doc)}}</div>
                </a>
            @else
                <a style="display:none;cursor:pointer" title="Ver documento" id="doc_preview">
                    <i class="far fa-id-card mt-2" style="font-size:50px"></i>
                    <div id="name_id_file" class="text-muted">{{old('img_doc',$agent->img_doc)}}</div>
                </a>
                <i id="doc_preview_file" class="fas fa-plus-circle mt-2" style="font-size:60px;cursor:pointer" title="Clique adicionar o documento de identificação"></i>
            @endif

        </div>
        <small class="text-muted">(clique para mudar)</small>
        {{--         <div class="mt-3" style="min-width:139px"><a href="#" id="search_btn" class="top-button">Procurar
            ficheiro</a></div> --}}


    </div>



</div>


<br>
