{{-- value="{{old('email',$university->email)}}" --}}

<div class="row font-weight-bold" style="color:#6A74C9">

    <div class="col col-2 text-center mr-4" style="min-width:250px">

        <label for="ficheiro" style="font-weight: 700!important;">Ficheiro:</label>

        <div class="card rounded shadow-sm p-2 text-center align-middle" style="height:250px">
            <input type='file' id="ficheiro" name="ficheiro" style="display:none" />
            <div class="my-auto">
                <i class="fas fa-plus-circle " style="font-size:60px;cursor:pointer" title="Clique para mudar"></i>
            </div>
        </div>

        <small class="text-muted">(clique para mudar)</small><br><br>
    </div>



    <div class="col" style="min-width: 300px">
        <div>Informação sobre o ficheiro</div><br>
        {{-- Instruçõess --}}
        <div id="div_incial" class="p-3 bg-light rounded shadow-sm text-secondary" style="display:blcok;">
            <div><i class="fas fa-info-circle mr-2"></i>Nenhum ficheiro selecionado</div><br>
            <div>Para continuar escolha um ficheiro</div>
        </div>


        {{-- File info --}}
        <div id="div_propriedades" class="p-3 bg-light rounded shadow-sm" style="display:none">
            <div>Nome do ficheiro: <span id="fileName" class="text-secondary"></span> </div><br>
            <div>Tipo: <span id="fileType" class="text-secondary"></span> </div><br>
            <div>Tamanho: <span id="fileSize" class="text-secondary"></span> </div><br>
            <div>Criado em: <span id="dateCreated" class="text-secondary"></span> </div>
        </div>

        <hr>

        <div id="div_descricao">
            <label for="descricao" style="font-weight: 700!important;">Descrição:</label>
            <input type="text" class="form-control" name="descricao" id="descricao"
                value="{{old('descricao',$library->descricao)}}" maxlength="100">
        </div>

        <br>


    </div>

</div>
