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

// Escolha de filtragem
var optionsDiv = document.getElementById("div-options");

function estudante() {
  var estudanteDiv = document.getElementById("div-estudante");
  optionsDiv.style.display = "none";
  estudanteDiv.style.display = "block";
}

function agente() {
  var agenteDiv = document.getElementById("div-agente");
  optionsDiv.style.display = "none";
  agenteDiv.style.display = "block";
}

function subagente() {
  var subagenteDiv = document.getElementById("div-subagente");
  optionsDiv.style.display = "none";
  subagenteDiv.style.display = "block";
}

function universidade() {
  var universidadeDiv = document.getElementById("div-universidade");
  optionsDiv.style.display = "none";
  universidadeDiv.style.display = "block";
}

function fornecedor() {
  var fornecedorDiv = document.getElementById("div-fornecedor");
  optionsDiv.style.display = "none";
  fornecedorDiv.style.display = "block";
}

function datas() {
  var datasDiv = document.getElementById("div-data");
  optionsDiv.style.display = "none";
  datasDiv.style.display = "block";
}
