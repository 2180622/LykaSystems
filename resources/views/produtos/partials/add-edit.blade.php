<div class="tab-content p-2 mt-3" id="myTabContent">

    {{-- Conteudo: Informação pessoal --}}
    <div>
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
                <select class="toolbar-escolha" id="produto" onchange="AtualizaProduto()" style="width: 80%;">
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

    <div class="tab-pane fade show active" id="Fases" role="tabpanel" aria-labelledby="Fases-tab">
        <ul class="nav nav-tabs mt-5 mb-4 fases" id="myTab" role="tablist">
            <li class="nav-item clonar" style="width:25%">
                <a class="nav-link active" id="fases-tab" data-toggle="tab" href="#" role="tab"
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
    <script>
        var clones = $('.clonar').clone();
        //$('.fases').html('');
        function AtualizaProduto(){
            //$('.fases').html('');
            var idproduto = new Array;
            $("select.toolbar-escolha#produto").each(function () {
                idproduto.push(this.value);
            });
            if(idproduto){
                AjaxProdutos(idproduto);
            }
        }
        function AjaxProdutos(idproduto){
            var link = '/../api/stock/produtos'
            $.ajax({
                method:"GET",
                url:link
            })
            .done(function(response){
                var i;
                for (i = 0; i < response.results.length; i++) {
                    alert(response.results[i].idProduto)
                    if(response.results[i].idProduto == idproduto){
                        var clone = clones.clone();
                        if(i==0){
                            $('#fases-tab', clone).attr('class','nav-link');
                        }
                        $('#fases-tab', clone).attr('href','fase-'+response.results[i].idProduto);
                        $('#fases-tab', clone).attr('aria-controls','fase-'+response.results[i].idProduto);
                        $('#fases-tab', clone).attr('id','fase'+response.results[i].idProduto+'-tab');
                        $('.fases').append(clone);
                    }
                }
            })
        }
    </script>
@endsection