<div class="tab-content p-2 mt-3" id="myTabContent">

    {{-- Conteudo: Informação pessoal --}}
    <div class="tab-pane fade show active" id="pessoal" role="tabpanel" aria-labelledby="pessoal-tab">
        <div class="row">
            <div class="col">
              {{-- INPUT Tipo --}}
            <label for="apelido">Tipo de Produto stock:</label><br>
            <select type="text" class="form-control" name="tipoProduto" id="tipoprodstock"
             placeholder="Insira o tipo de Produto Stock" required>
               <option {{old('tipoProduto',$produtostock->tipoProduto)=='Licenciatura'?"selected":""}} value="Licenciatura">Licenciatura</option>
               <option {{old('tipoProduto',$produtostock->tipoProduto)=='Mestrado'?"selected":""}} value="Mestrado">Mestrado</option>
               <option {{old('tipoProduto',$produtostock->tipoProduto)=='Doutoramento'?"selected":""}} value="Doutoramento">Doutoramento</option>
               <option {{old('tipoProduto',$produtostock->tipoProduto)=='Curso de Verão'?"selected":""}} value="Curso de Verão">Curso de Verão</option>
               <option {{old('tipoProduto',$produtostock->tipoProduto)=='Estágio Profissional'?"selected":""}} value="Estágio Profissional">Estágio Profissional</option>
               <option {{old('tipoProduto',$produtostock->tipoProduto)=='Transferência de Curso'?"selected":""}} value="Transferência de Curso">Transferência de Curso</option>
               <option {{old('tipoProduto',$produtostock->tipoProduto)=='Curso Indiomas'?"selected":""}} value="Curso Indiomas">Curso Indiomas</option>
               <option {{old('tipoProduto',$produtostock->tipoProduto)=='Erasmus'?"selected":""}} value="Erasmus">Erasmus</option>
               <option {{old('tipoProduto',$produtostock->tipoProduto)=='Pré-Universitário'?"selected":""}} value="Pré-Universitário">Pré-Universitário</option>
             </select>
             <br>

                {{-- INPUT anoAcademico --}}
                <label for="dataNasc">Ano Académico:</label><br>
                <input type="text" class="form-control" name="anoAcademico" id="anoAcademico"
                  value="{{old('anoAcademico',$produtostock->anoAcademico)}}" required><br>

               {{-- INPUT Descrição --}}
               <label for="nome">Descrição (ProdutoStock):</label><br>
               <input type="text" class="form-control" name="descricao" id="descricao"
               value="{{old('descricao',$produtostock->descricao)}}" required><br>
            </div>
          </div>
      </div>
</div>
