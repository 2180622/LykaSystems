<div class="row font-weight-bold px-4" style="color:#6A74C9">

    <div class="col col-lg-2 col-md-12 text-center" style="min-width:350px">

        {{-- INPUT Ficheiro --}}
        <div>
            <label for="ficheiro" style="font-weight: 700!important;">Ficheiro:</label>
            <input type='file' id="ficheiro" name="ficheiro" style="display:none" required/>

        </div>



        {{-- NÃO EXISTE FICHEIRO --}}
        <div id="add_file" class="card rounded shadow-sm p-2 text-center align-middle "
            style="height:250px;cursor:pointer">
            <i class="fas fa-plus-circle my-auto" style="font-size:60px;" title="Clique para mudar"></i>
        </div>


        {{-- EXISTE FICHEIRO --}}

        <a id="replace_file" href="#" class="name_link" title="Clique para mudar">
            <div id="file_frame" class="card rounded shadow-sm p-2 text-center align-middle " style="height:250px;cursor:pointer">
                <div class="my-auto">
                    <i class="far fa-file-alt" style="font-size:60px"></i>
                    <div class="mt-3" id="aux_file_name">{{old('ficheiro',$biblioteca->ficheiro)}}</div>
                </div>
            </div>
        </a>
        <div id="warning-file" style="display:none;"><small class="text-danger"><strong>É necessário escolher um ficheiro</strong></small></div>
        <div class="mt-2 mb-3"><small class="text-muted">(clique para mudar)</small></div>

    </div>



    <div class="col" style="min-width: 300px">

        <div class="row">

            {{-- Nome do ficheiro --}}
            <input type="hidden" value="{{old('ficheiro',$biblioteca->ficheiro)}}" class="form-control" name="file_name"
                id="file_name" maxlength="30" required>

            <div class="col">
                {{-- Tipo de acesso --}}
                <label for="acesso" style="font-weight: 700!important;">Tipo de acesso:</label>
                <select name="acesso" id="acesso" class="form-control" required>
                    <option {{old('acesso',$biblioteca->acesso)=='Privado'?"selected":""}} value="Privado">Privado
                    </option>
                    <option {{old('acesso',$biblioteca->acesso)=='Público'?"selected":""}} value="Público">Público
                    </option>
                </select>
            </div>

        </div>
        <div class="row mt-3">
            <div class="col">
                <label for="descricao" style="font-weight: 700!important;">Descrição curta:</label>
                <input value="{{old('descricao',$biblioteca->descricao)}}" type="text" class="form-control"
                    name="descricao" id="descricao" maxlength="100" required>
                    <div class="invalid-feedback">É necessário inserir uma descricão curta</div>
            </div>

            {{-- Inputs auxiliares --}}
            <input type="hidden" name="tipo" id="tipo" value="{{old('tipo',$biblioteca->tipo)}}">
            <input type="hidden" name="tamanho" id="tamanho" value="{{old('tamanho',$biblioteca->tamanho)}}">
        </div>

        <div class="p-3 bg-light rounded border mt-4">

            {{-- Quando NÃO EXISTE ficheiro --}}
            <div id="div_nofile">
                <i class="fas fa-info-circle mr-2"></i>Nenhum ficheiro selecionado
                <small>(Para continuar escolha um ficheiro)</small>
            </div>


            {{-- Quand EXISTE ficheiro --}}
            {{-- File info --}}
            <div id="div_propriedades">
                <div><i class="fas fa-info-circle mr-2"></i>Informação do ficheiro</div>
                <div class="mt-3">Tipo de ficheiro: <span id="info_fileType"
                        class="text-secondary">{{old('ficheiro',$biblioteca->tipo)}}</span> </div>
                <div class="mt-2">Tamanho: <span id="info_fileSize"
                        class="text-secondary">{{old('ficheiro',$biblioteca->tamanho)}}</span> </div>

                <div class="mt-2">Última modificação: <span id="info_dateCreated"
                        class="text-secondary">{{old('ficheiro',$biblioteca->created_ate)}}</span></div>
            </div>


        </div>




    </div>

</div>
