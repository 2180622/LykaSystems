// Tooltip
$(function() {
    $('[data-toggle="tooltip"]').tooltip()
});

// Filters
var closeButton = document.getElementById('close-icon-div');
var filterButton = document.getElementById('filter-icon-div');

function showCloseIcon() {
    filterButton.style.display = "none";
    closeButton.style.display = "inline-block";
    closeButton.style.float = "right";
}

function showFunnelIcon() {
    filterButton.style.display = "inline-block";
    filterButton.style.float = "right";
    closeButton.style.display = "none";
}

// Valor dos inputs -> Bloquear inputs -> .setAttribute("disabled", "true");

function selected() {
    // Input estudantes
    var estudanteInput = document.getElementById('estudantes');
    var valueEstudante = estudanteInput.options[estudanteInput.selectedIndex].value;

    if (valueEstudante != 'defeito') {
      var span = document.createElement("span");
        span.style.position = "absolute";
        span.style.right = "30px";
        span.style.top = "38px";
        span.style.fontWeight = "800";
        span.style.color = "#747474";
        span.style.cursor = "default";
      var x = document.createTextNode("x");
      span.appendChild(x);

      var parentDiv = estudanteInput.parentElement;
      parentDiv.appendChild(span);
    }


    // Input agentes
    var agenteInput = document.getElementById('agentes');
    var valueAgente = agenteInput.options[agenteInput.selectedIndex].value;

    // Input universidades
    var universidadeInput = document.getElementById('universidades');
    var valueUni = universidadeInput.options[universidadeInput.selectedIndex].value;

    // Input fornecedores
    var fornecedorInput = document.getElementById('fornecedores');
    var valueFornecedor = fornecedorInput.options[fornecedorInput.selectedIndex].value;

    // // Input Estudante -> Desativa os outros inputs
    // if (valueEstudante != 'defeito') {
    //     agenteInput.setAttribute("disabled", "true");
    //     universidadeInput.setAttribute("disabled", "true");
    //     fornecedorInput.setAttribute("disabled", "true");
    // }
    //
    // if (valueEstudante == 'nenhum') {
    //     agenteInput.removeAttribute("disabled");
    //     universidadeInput.removeAttribute("disabled");
    //     fornecedorInput.removeAttribute("disabled");
    // }
    //
    // // Input Agente -> Desativa os outros inputs
    // if (valueAgente != 'defeito') {
    //     estudanteInput.setAttribute("disabled", "true");
    //     universidadeInput.setAttribute("disabled", "true");
    //     fornecedorInput.setAttribute("disabled", "true");
    // }
    //
    // if (valueAgente == 'nenhum') {
    //     estudanteInput.removeAttribute("disabled");
    //     universidadeInput.removeAttribute("disabled");
    //     fornecedorInput.removeAttribute("disabled");
    // }
    //
    // // Input Universidade -> Desativa os outros inputs
    // if (valueUni != 'defeito') {
    //     estudanteInput.setAttribute("disabled", "true");
    //     agenteInput.setAttribute("disabled", "true");
    //     fornecedorInput.setAttribute("disabled", "true");
    // }
    //
    // if (valueUni == 'nenhum') {
    //     estudanteInput.removeAttribute("disabled");
    //     agenteInput.removeAttribute("disabled");
    //     fornecedorInput.removeAttribute("disabled");
    // }
    //
    // // Input Fornecedor -> Desativa os outros inputs
    // if (valueFornecedor != 'defeito') {
    //     estudanteInput.setAttribute("disabled", "true");
    //     agenteInput.setAttribute("disabled", "true");
    //     universidadeInput.setAttribute("disabled", "true");
    // }
    //
    // if (valueFornecedor == 'nenhum') {
    //     estudanteInput.removeAttribute("disabled");
    //     agenteInput.removeAttribute("disabled");
    //     universidadeInput.removeAttribute("disabled");
    // }
}
