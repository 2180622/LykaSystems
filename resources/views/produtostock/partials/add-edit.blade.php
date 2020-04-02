<div class="tab-content p-2 mt-3" id="myTabContent">

    {{-- Conteudo: Informação pessoal --}}
    <div class="tab-pane fade show active" id="pessoal" role="tabpanel" aria-labelledby="pessoal-tab">
        <div class="row">
            <div class="col">
                {{-- INPUT Descrição --}}
                <label for="nome">Descrição:</label><br>
                <input type="text" class="form-control" name="descricao" id="descricao"
                    placeholder="Insira a descrição do produto" required><br>

                {{-- INPUT Tipo --}}
                <label for="apelido">Tipo:</label><br>
                <select type="text" class="form-control" name="tipo" id="tipo"
                 placeholder="Insira o tipo de Produto Stock" required>
                   <option value="Licenciatura">Licenciatura</option>
                   <option value="Mestrado">Mestrado</option>
                   <option value="Doutoramento">Doutoramento</option>
                   <option value="Curso de Verão">Curso de Verão</option>
                   <option value="Estágio Profissional">Estágio Profissional</option>
                   <option value="Transferência de Curso">Transferência de Curso</option>
                   <option value="Curso Idiomas">Curso Idiomas</option>
                   <option value="Erasmus">Erasmus</option>
                   <option value="Pré-Universitário">Pré-Universitário</option>
                 </select>
                 <br>

                {{-- INPUT anoAcademico --}}
                <label for="dataNasc">Ano Académico:</label><br>
                <input type="date" class="form-control" name="anoAcademico" id="anoAcademico"required><br>
            </div>
          </div>
      </div>
</div>
