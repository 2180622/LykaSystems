<div class="tab-content p-2 mt-3" id="myTabContent">
  <div class="tab-pane fade show active" id="pessoal" role="tabpanel" aria-labelledby="pessoal-tab">
      <div class="row">
          <div class="col">
              {{-- INPUT tipo --}}
              <label for="">Tipo (DocumentoStock):</label><br>
              <select type="text" class="form-control" name="tipo" id="tipodocstock"
                onchange="myFunction()" required>
                <option value="None">...</option>
                 <option value="Pessoal">Pessoal</option>
                 <option value="Academico">Academico</option>
              </select><br><br><br><br>
              {{-- INPUT Documento --}}
              <div class="" id="tipoacademico">
                <label for="">Documento Academico</label>
                <select class="form-control" name="tipoAcademico">
                  <option value="Exame Universitário">Exame Universitário</option>
                  <option value="Exame Nacional">Exame Nacional</option>
                  <option value="Diploma">Diploma</option>
                  <option value="Certificado">Certificado</option>
                </select>
              </div>

              <div class="" id="tipopessoal">
                <label for="">Documento Pessoal</label>
                <select class="form-control" name="tipoPessoal">
                  <option value="Passaporte">Passaporte</option>
                  <option value="Cartão Cidadão">Cartão de Cidadão</option>
                  <option value="Carta Condução">Carta de Condução</option>
                  <option value="Doc. Oficial">Documento Oficial</option>
                </select>
              </div>
          </div>
        </div>
    </div>
</div>

{{-- Scripts --}}
@section('scripts')
  <style>
  #tipopessoal {
    display: none;
  }

  #tipoacademico {
    display: none;
  }
  </style>

  <script type="text/javascript">
    function myFunction() {
        var select = document.getElementById("tipodocstock");
        var tipopessoal = document.getElementById("tipopessoal");
        var tipoacademico = document.getElementById("tipoacademico");
        tipopessoal.style.display = select.value == "Pessoal" ? "block" : "none";
        tipoacademico.style.display = select.value == "Academico" ? "block" : "none";
    }
  </script>
    {{-- <script src="{{asset('/js/NOME_DO_FICHEIR.js')}}"></script> --}}
@endsection
