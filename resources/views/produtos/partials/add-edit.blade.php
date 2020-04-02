<div class="tab-content p-2 mt-3" id="myTabContent">

    {{-- Conteudo: Informação pessoal --}}
    <div class="tab-pane fade show active" id="pessoal" role="tabpanel" aria-labelledby="pessoal-tab">
        <div class="row">
            <div class="col">
                {{-- INPUT nome --}}
                <label for="nome">Cliente: 
                    <a class="name_link" href="{{route('clients.show',$cliente)}}">
                        {{$cliente->nome.' '.$cliente->apelido}}
                    </a>
                </label>
            </div>
        </div>
        <br>
        <div class="row">
            <div class="col">
                <label for="nome">Escolha o produto: </label>
                <select class="toolbar-escolha" id="produto" onchange="AtualizaProduto({{$produtoStock}})" style="width: 80%;">
                    <option value="null"></option>
                    @foreach($produtoStock as $prodS)
                        @php
                            $faseS = $prodS->faseStock->toArray();
                        @endphp
                        <option value="{{$prodS->idProdutoStock}}">{{$prodS->tipo."\t".$prodS->descricao."\t".count($faseS).' fases'}}</option>
                    @endforeach
                </select>
            </div>
        </div>
    </div>

    <div class="tab-pane fade" id="school" role="tabpanel" aria-labelledby="school-tab">
        <ul class="nav nav-tabs mt-5 mb-4 fases" id="myTab" role="tablist">
            <li class="nav-item active clonar" style="width:25%">
                <a class="nav-link" id="fases-tab" data-toggle="tab" href="#" role="tab"
                    aria-controls="fase" aria-selected="false">Fase</a>
            </li>
        </ul>

        <div class="row">
            <div class="col-md-12">
                
            </div>
        </div>
    </div>
</div>
@section('scripts')
    {{-- <script src="{{asset('/js/NOME_DO_FICHEIR.js')}}"></script> --}}
    <script>
        var clones = $('.clonar').clone();
        $('.fases').html('');
        function AtualizaProduto(Produtos){
            var idproduto = new String;
            $("select.toolbar-escolha#produto").each(function () {
                idproduto.push(this.value);
            });
            var filtros = null;
            var i;
            for (i = 0; i < Produtos.length; i++) {
                filtros = filtros + filtroCB[i] + "_" + checkbox[i] + "__";
                if(Produtos[i].idProduto == idproduto){
                    var clone = clones.clone();
                    $('#fases-tab', clone).attr('href','fase-'+Produtos[i].idProduto);
                    $('#fases-tab', clone).attr('aria-controls','fase-'+Produtos[i].idProduto);
                    $('#fases-tab', clone).attr('id','fase'+Produtos[i].idProduto+'-tab');
                    $('.fases').append(clone);
                }
            }
        }
    </script>
@endsection