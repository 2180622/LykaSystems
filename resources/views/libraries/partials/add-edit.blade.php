{{-- value="{{old('email',$university->email)}}" --}}

<div class="row font-weight-bold px-4" style="color:#6A74C9">

    <div class="col mr-4 col-lg-2 col-md-12  text-center" style="min-width:350px">

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
        {{-- Instruções --}}
        <div id="div_incial" class="p-3 bg-light rounded border" style="display:blcok;">
            <div><i class="fas fa-info-circle mr-2"></i>Nenhum ficheiro selecionado
                <br><br>
                <small>(Para continuar escolha um ficheiro)</small><br><br></div>
            <div></div>
        </div>


        {{-- File info --}}
        <div id="div_propriedades" class="p-3 bg-light rounded shadow-sm" style="display:none">
            <div>Nome do ficheiro: <span id="fileName" class="text-secondary"></span> </div><br>
            <div>Tipo: <span id="fileType" class="text-secondary"></span> </div><br>
            <div>Tamanho: <span id="fileSize" class="text-secondary"></span> </div><br>
            <div>Criado em: <span id="dateCreated" class="text-secondary"></span> </div>
        </div>

        <hr>

        <div class="row">
            <div class="col">
                <label for="file_name" style="font-weight: 700!important;">Nome:</label>
                <input type="text" class="form-control" name="file_name" id="file_name" maxlength="100">
            </div>
            <div class="col">
                <label for="permissao" style="font-weight: 700!important;">Tipo de acesso:</label>
                <select name="permissao" id="permissao" class="form-control" >
                    <option>Privado</option>
                    <option>Público</option>
                </select>
            </div>
        </div>

    </div>

</div>
