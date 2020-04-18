{{-- value="{{old('email',$university->email)}}" --}}

<div class="row font-weight-bold" style="color:#6A74C9">

    <div class="col col-2 text-center mr-4" style="min-width:250px">

        <label for="ficheiro" style="font-weight: 700!important;">Ficheiro:</label>

        <div class="card rounded shadow-sm p-2 text-center align-middle" style="height:250px">
            <input type='file' id="ficheiro" name="ficheiro" style="display:none" />
            <div class="my-auto">
                <i class="fas fa-plus-circle " style="font-size:60px;cursor:pointer"
                title="Clique para adicionar o ficheiro"></i>
            </div>
        </div>

        <small class="text-muted">(clique para mudar)</small>
    </div>



    <div class="col" style="min-width: 300px">
        <div>
            <label for="descricao" style="font-weight: 700!important;">Descrição:</label>
            <input type="text" class="form-control" name="descricao" id="descricao" value="{{old('descricao',$library->descricao)}}" maxlength="100">
        </div>

        <br>


    </div>

</div>
