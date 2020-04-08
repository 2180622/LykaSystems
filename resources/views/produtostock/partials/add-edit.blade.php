<div class="tab-content p-2 mt-3" id="myTabContent">

    {{-- Conteudo: Informação pessoal --}}
    <div class="tab-pane fade show active" id="pessoal" role="tabpanel" aria-labelledby="pessoal-tab">
        <div class="row">
            <div class="col">
                {{-- INPUT Descrição --}}
                <label for="nome">Descrição (ProdutoStock):</label><br>
                <input type="text" class="form-control" name="descricao" id="descricao"
                    placeholder="Insira a descrição do produto" required><br>

                {{-- INPUT Tipo --}}
                <label for="apelido">Tipo de Produto stock:</label><br>
                <select type="text" class="form-control" name="tipoprodstock" id="tipoprodstock"
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

                {{-- INPUT descricao fasestock --}}
                <label for="descricao">Descrição (FaseStock):</label><br>
                <input type="text" class="form-control" name="descricaofase" id="descricaofase"required><br>

                {{-- INPUT tipo DocStock --}}
                <label for="tipodocstock">Tipo (DocStock):</label><br>
                <select type="text" class="form-control" name="tipodoc" id="tipodoc"
                 placeholder="Insira o tipo de Documento Stock" required>
                   <option value="Pessoal">Pessoal</option>
                   <option value="Academico">Académico</option>
                </select>
                <br>
                {{-- INPUT tipoPessoal DocStock --}}
                <label for="tipopessoal">TipoPessoal:</label>
                <select type="text" class="form-control" name="tipopessoaldoc" id="tipopessoaldoc"
                 placeholder="Insira o tipo Pessoal de Documento Stock" required>
                  <option value="Passaport">Passaporte</option>
                  <option value="Cartão Cidadão">Cartão de Cidadão</option>
                  <option value="Carta de Condução">Carta de Condução</option>
                  <option value="Doc. Oficial">Documento Oficial</option>
                </select><br>

                {{-- INPUT tipoAcademico DocStock --}}
                <label for="tipoacademico">TipoAcademico:</label>
                <select type="text" class="form-control" name="tipoacademicodoc" id="tipoacademicodoc"
                 placeholder="Insira o tipo Académico de Documento Stock">
                  <option value="Exame Universitário">Exame Universitário</option>
                  <option value="Exame Nacional">Exame Nacional</option>
                  <option value="Diploma">Diploma</option>
                  <option value="Certificado">Certificado</option>
                </select><br>
            </div>
          </div>
      </div>
</div>
