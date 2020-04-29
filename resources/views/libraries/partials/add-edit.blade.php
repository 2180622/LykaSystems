{{-- value="{{old('email',$university->email)}}" --}}

<div class="row font-weight-bold px-4" style="color:#6A74C9">

    <div class="col col-lg-2 col-md-12 text-center" style="min-width:350px">

                {{-- INPUT Ficheiro --}}
                <div>
                    <label for="ficheiro" style="font-weight: 700!important;">Ficheiro:</label>
                    <input type='file' id="ficheiro" name="ficheiro" style="display:none" accept="image/*" />
                </div>

                <!-- Verifica se a imagem já existe-->
                @if ( $biblioteca->ficheiro!=null )
                <a href="#" class="name_link" title="Clique para mudar">
                    <div class="card rounded shadow-sm p-2 text-center align-middle" style="height:250px">
                        <div class="my-auto">
                            <i class="far fa-file-alt" style="font-size:60px" ></i>
                            <div class="mt-3">Ficheiro atual<div>
                        </div>
                    </div>
                </a>
                @else
                    <div class="card rounded shadow-sm p-2 text-center align-middle " style="height:250px">
                        <i class="fas fa-plus-circle my-auto" style="font-size:60px;cursor:pointer" title="Clique para mudar"></i>
                    </div>
                @endif
                <div class="mt-2 mb-3"><small class="text-muted">(clique para mudar)</small></div>

    </div>



    <div class="col" style="min-width: 300px">

        <div class="row">
            <div class="col">
                <label for="file_name" style="font-weight: 700!important;">Nome:</label>
                <input type="text" class="form-control" name="file_name" id="file_name" maxlength="100">
            </div>
            <div class="col">
                <label for="acesso" style="font-weight: 700!important;">Tipo de acesso:</label>
                <select name="acesso" id="acesso" class="form-control" >
                    <option>Privado</option>
                    <option>Público</option>
                </select>
            </div>
        </div>
        <div class="row mt-3">
            <div class="col">
                <label for="descricao" style="font-weight: 700!important;">Descrição:</label>
                <input type="text" class="form-control" name="descricao" id="descricao" maxlength="100">
            </div>
        </div>

        <div id="div_incial" class="p-3 bg-light rounded border mt-4" style="display:blcok;">
            <div><i class="fas fa-info-circle mr-2"></i>Nenhum ficheiro selecionado
                <small>(Para continuar escolha um ficheiro)</small></div>
            <div></div>

        </div>


        {{-- File info --}}
        <div id="div_propriedades" class="p-3 bg-light rounded shadow-sm" style="display:none">
            <div>Nome do ficheiro: <span id="fileName" class="text-secondary"></span> </div><br>
            <div>Tipo: <span id="fileType" class="text-secondary"></span> </div><br>
            <div>Tamanho: <span id="fileSize" class="text-secondary"></span> </div><br>
            <div>Criado em: <span id="dateCreated" class="text-secondary"></span> </div>
        </div>




    </div>

</div>
