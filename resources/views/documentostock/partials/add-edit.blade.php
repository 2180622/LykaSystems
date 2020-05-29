<div class="bg-white shadow-sm mb-4 p-4" style="border-radius:10px;" id="myTabContent">
  <div class="tab-pane fade show active" id="pessoal" role="tabpanel" aria-labelledby="pessoal-tab">
      <div class="row">
          <div class="col">
              {{-- INPUT tipo --}}
              <label for="">Tipo (DocumentoStock):</label><br>
              <select type="text" class="form-control" name="tipo" id="tipodocstock"
                onchange="myFunction()" required>
                <option value="None"></option>
                 <option value="Pessoal">Pessoal</option>
                 <option value="Academico">Academico</option>
              </select><br>
              {{-- INPUT Documento --}}
              <div class="shadow-ms" id="tipoacademico">
                <label >Documento:</label>
                <input type="text" class="form-control" name="tipoDocumento" required>
              </div>
          </div>
        </div>
    </div>
</div>

{{-- Scripts --}}
@section('scripts')
    {{-- <script src="{{asset('/js/NOME_DO_FICHEIR.js')}}"></script> --}}
@endsection
