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
