<div class="row mb-4" style="font-weight:bold;color:#6A74C9">

    {{-- Inputs --}}
    <div class="col">
        <label for="nome">Nome:</label><br>
        <input type="text" class="form-control" name="nome" id="nome" value="{{old('nome',$contact->nome)}}"
            required>
        <div class="invalid-feedback">O nome é necessário</div>
        <br>

        <div class="row mb-3">
            <div class="col mr-2">
                <label for="telefone1">Telefone (principal):</label><br>
                <input type="text" class="form-control" name="telefone1" id="telefone1"
                    value="{{old('telefone1',$contact->telefone1)}}" >
            </div>
            <div class="col">
                <label for="telefone2">Telefone (alternativo):</label><br>
                <input type="text" class="form-control" name="telefone2" id="telefone2"
                    value="{{old('telefone2',$contact->telefone2)}}" >
            </div>
        </div>

        <label for="fax">Fax:</label><br>
        <input type="text" class="form-control" name="fax" id="fax" value="{{old('fax',$contact->fax)}}" ><br>

        <label for="email">E-mail:</label><br>
        <input type="email" class="form-control" name="email" id="email" value="{{old('email',$contact->email)}}"><br>

        <i class="fas fa-star text-warning mr-2"></i><label for="favorito">Marcar como "favorito": </label>
            <select id="favorito" name="favorito" class="custom-select ml-2" style="width:120px">
            <option {{old('favorito',$contact->favorito)=='0'?"selected":""}} value="0" selected>Não</option>
            <option {{old('favorito',$contact->favorito)=='1'?"selected":""}} value="1">Sim</option>
        </select>
    </div>



    {{-- Fotografia --}}
    <div class="col col-4 text-center">

        <div>
            <label for="fotografia">Fotografia:</label>
            <input type='file' id="fotografia" name="fotografia" style="display:none" accept="image/*"/>

        </div>

        <!-- Verifica se a imagem já existe-->
        @if ($contact->fotografia!=null)
        <img src="{{Storage::disk('public')->url('contact-photos/').$contact->fotografia}}" id="preview"
            class="m-2 p-1 rounded bg-white shadow-sm" style="width:80%;cursor:pointer;min-width:118px"
            alt="Imagem de apresentação" title="Clique para mudar a imagem de apresentação" />
        @else
        <img src="{{Storage::disk('public')->url('default-photos/addImg.png')}}" id="preview"
            class="m-2 p-1 rounded bg-white shadow-sm" style="width:80%;cursor:pointer;min-width:118px"
            alt="Imagem de apresentação" title="Clique para mudar a imagem de apresentação" />
        @endif
        <div class="mt-3" style="min-width:139px"><a href="#" id="search_btn" class="top-button">Procurar
                ficheiro</a>
        </div>


    </div>
</div>


<div class="row"  style="font-weight:bold;color:#6A74C9">
    <div class="col">
    <label for="observacao">Observações:</label><br>
    <textarea name="observacao" id="observacao" rows="5"
        class="form-control">{{old('observacao',$contact->observacao)}}</textarea>
    </div>
</div>