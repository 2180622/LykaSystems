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
    var defaultValue = "defeito";
    // Input estudantes
    var estudanteInput = document.getElementById('estudantes');
    var valueEstudante = estudanteInput.options[estudanteInput.selectedIndex].value;

    if (valueEstudante != defaultValue) {
        var span = document.createElement("span");
        span.id = "closeEstudante";
        span.className = "closeButton"

        var x = document.createTextNode("x");
        span.appendChild(x);

        var parentDiv = estudanteInput.parentElement;
        parentDiv.appendChild(span);

        span.addEventListener("click", function() {
            var options = estudanteInput.options;
            for (var i = 0; options = options[i]; i++) {
                if (options.value == defaultValue) {
                    estudanteInput.selectedIndex = i;
                    span.style.display = "none";
                    break;
                }
            }
            document.getElementById('agentes').removeAttribute("disabled");
            document.getElementById('universidades').removeAttribute("disabled");
            document.getElementById('fornecedores').removeAttribute("disabled");
        });
        document.getElementById('agentes').setAttribute("disabled", "true");
        document.getElementById('universidades').setAttribute("disabled", "true");
        document.getElementById('fornecedores').setAttribute("disabled", "true");
    }



    // Input agentes
    var agenteInput = document.getElementById('agentes');
    var valueAgente = agenteInput.options[agenteInput.selectedIndex].value;

    if (valueAgente != defaultValue) {
        var span = document.createElement("span");
        span.id = "closeAgente";
        span.className = "closeButton"

        var x = document.createTextNode("x");
        span.appendChild(x);

        var parentDiv = agenteInput.parentElement;
        parentDiv.appendChild(span);

        span.addEventListener("click", function() {
            var options = agenteInput.options;
            for (var i = 0; options = options[i]; i++) {
                if (options.value == defaultValue) {
                    agenteInput.selectedIndex = i;
                    span.style.display = "none";
                    break;
                }
            }
            document.getElementById('estudantes').removeAttribute("disabled");
            document.getElementById('universidades').removeAttribute("disabled");
            document.getElementById('fornecedores').removeAttribute("disabled");
        });
        document.getElementById('estudantes').setAttribute("disabled", "true");
        document.getElementById('universidades').setAttribute("disabled", "true");
        document.getElementById('fornecedores').setAttribute("disabled", "true");
    }

    // Input universidades
    var universidadeInput = document.getElementById('universidades');
    var valueUni = universidadeInput.options[universidadeInput.selectedIndex].value;

    if (valueUni != defaultValue) {
        var span = document.createElement("span");
        span.id = "closeUni";
        span.className = "closeButton"

        var x = document.createTextNode("x");
        span.appendChild(x);

        var parentDiv = universidadeInput.parentElement;
        parentDiv.appendChild(span);

        span.addEventListener("click", function() {
            var options = universidadeInput.options;
            for (var i = 0; options = options[i]; i++) {
                if (options.value == defaultValue) {
                    universidadeInput.selectedIndex = i;
                    span.style.display = "none";
                    break;
                }
            }
            document.getElementById('estudantes').removeAttribute("disabled");
            document.getElementById('agentes').removeAttribute("disabled");
            document.getElementById('fornecedores').removeAttribute("disabled");
        });
        document.getElementById('estudantes').setAttribute("disabled", "true");
        document.getElementById('agentes').setAttribute("disabled", "true");
        document.getElementById('fornecedores').setAttribute("disabled", "true");
    }

    // Input fornecedores
    var fornecedorInput = document.getElementById('fornecedores');
    var valueFornecedor = fornecedorInput.options[fornecedorInput.selectedIndex].value;

    if (valueFornecedor != defaultValue) {
        var span = document.createElement("span");
        span.id = "closeFornecedor";
        span.className = "closeButton"

        var x = document.createTextNode("x");
        span.appendChild(x);

        var parentDiv = fornecedorInput.parentElement;
        parentDiv.appendChild(span);

        span.addEventListener("click", function() {
            var options = fornecedorInput.options;
            for (var i = 0; options = options[i]; i++) {
                if (options.value == defaultValue) {
                    fornecedorInput.selectedIndex = i;
                    span.style.display = "none";
                    break;
                }
            }
            document.getElementById('estudantes').removeAttribute("disabled");
            document.getElementById('agentes').removeAttribute("disabled");
            document.getElementById('universidades').removeAttribute("disabled");
        });
        document.getElementById('estudantes').setAttribute("disabled", "true");
        document.getElementById('agentes').setAttribute("disabled", "true");
        document.getElementById('universidades').setAttribute("disabled", "true");
    }
}

// Modal -> Resposanbilidades content
$('#exampleModal').on('show.bs.modal', function (event) {
  var button = $(event.relatedTarget);
  var name = button.data('nome');
  var fase = button.data('fase');
  var valorCliente = button.data('valorcliente');
  var valorAgente = button.data('valoragente');
  var valorSubAgente = button.data('valorsubagente');
  var valorUni1 = button.data('valoruni1');
  var valorUni2 = button.data('valoruni2');
  var valorUni2 = button.data('valoruni2');

  var modal = $(this);

  modal.find('.modal-title').text('Responsabilidade de ' + name + ' - ' + fase);
  modal.find('#valor-cliente').val(valorCliente);
  modal.find('#valor-agente').val(valorAgente);
  modal.find('#valor-subagente').val(valorSubAgente);
  modal.find('#valor-uni1').val(valorUni1);
  modal.find('#valor-uni2').val(valorUni2);
})
