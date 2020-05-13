// Tooltip
$(function() {
    $('[data-toggle="tooltip"]').tooltip()
});

// Custom upload file area
function getFileCliente() {
    document.getElementById("upfileCliente").click();
}

function getFileAgente() {
    document.getElementById("upfileAgente").click();
}

function getFileSubAgente() {
    document.getElementById("upfileSubAgente").click();
}

function getFileUni1() {
    document.getElementById("upfileUni1").click();
}

function getFileUni2() {
    document.getElementById("upfileUni2").click();
}


function sub(obj) {
    var file = obj.value;
    var fileName = file.split("\\");

    if (obj.id == "upfileCliente") {
        document.getElementById("addFileButtonCliente").innerHTML = fileName[fileName.length - 1];
    }
    if (obj.id == "upfileAgente") {
        document.getElementById("addFileButtonAgente").innerHTML = fileName[fileName.length - 1];
    }
    if (obj.id == "upfileSubAgente") {
        document.getElementById("addFileButtonSubAgente").innerHTML = fileName[fileName.length - 1];
    }
    if (obj.id == "upfileUni1") {
        document.getElementById("addFileButtonUni1").innerHTML = fileName[fileName.length - 1];
    }
    if (obj.id == "upfileUni2") {
        document.getElementById("addFileButtonUni2").innerHTML = fileName[fileName.length - 1];
    }
}

function removeFile() {
    document.getElementById("upfile").value = "";
    document.getElementById("addFileButton").innerHTML = 'Adicionar um ficheiro';
}

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
    var defaultValue = "default";
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


$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': "{{csrf_token()}}"
    }
});

$('#search-form').submit(function(event) {
    event.preventDefault();
    info = {
        estudante: $("#estudantes").find(":selected").val(),
        agente: $("#agentes").find(":selected").val(),
        universidade: $("#universidades").find(":selected").val(),
        fornecedor: $("#fornecedores").find(":selected").val(),
        datainicio: $("#dataInicio").val(),
        datafim: $("#dataFim").val()
    };
    $.ajax({
        type: "post",
        url: "/pagamentos/pesquisa",
        context: this,
        data: info,
        success: function(data) {
            $(".payments").remove();
            div = "<div class='payments'><div>";
            $("#append-payment").append(div);

            for (var i = 0; i < data.length; i++) {
                // Pagamentos aos CLIENTES
                if (data[i].valorCliente != null && $("#estudantes").find(":selected").val() != 'default') {
                    // Formato da DATA DE VENCIMENTO
                    const d = new Date(data[i].dataVencimentoCliente);
                    const da = new Intl.DateTimeFormat('pt', { day: '2-digit' }).format(d);
                    const mo = new Intl.DateTimeFormat('pt', { month: '2-digit' }).format(d);
                    const ye = new Intl.DateTimeFormat('pt', { year: 'numeric' }).format(d);
                    date = `${da}/${mo}/${ye}`;

                    // Seleções de CORES _ Estado de PAGAMENTOS
                    if (data[i].verificacaoPagoCliente == true) {
                        status = "Pago";
                        color = "#47BC00"; // VERDE
                    }else if (data[i].verificacaoPagoCliente == false && data[i].dataVencimentoCliente < date) {
                        status = "Dívida";
                        color = "#FF3D00"; // VERMELHO
                    }else if (data[i].verificacaoPagoCliente == false && data[i].dataVencimentoCliente > date) {
                        status = "Pendente";
                        color = "#747474"; // CINZENTO (DEFAULT)
                    }

                    html = "<a href='#'><div class='row charge-div'> <div class='col-md-1 align-self-center'><div class='white-circle'><img src='http://lykasystems.test/storage/default-photos/M.jpg' width='100%' class='mx-auto'></div></div> <div class='col-md-3 text-truncate align-self-center ml-4'><p class='text-truncate' title='"+ data[i].cliente.nome + ' ' + data[i].cliente.apelido +"'>"+ data[i].cliente.nome + ' ' + data[i].cliente.apelido +"</p></div> <div class='col-md-2 text-truncate align-self-center'><p class='text-truncate'>"+ data[i].valorCliente.split('.').join(',') +"€</p></div> <div class='col-md-2 align-self-center ml-4'><p class='text-truncate' title='"+ date +"'>"+ date +"</p></div> <div class='col-md-2 text-truncate align-self-center ml-auto'><p class='text-truncate' style='color:"+color+";'>"+status+"</p></div> </div></a>";
                    $(".payments").append(html);
                }

                // Pagamentos aos AGENTES
                if (data[i].valorAgente != null && $("#agentes").find(":selected").val() != 'default') {
                    // Formato da DATA DE VENCIMENTO
                    const d = new Date(data[i].dataVencimentoAgente);
                    const da = new Intl.DateTimeFormat('pt', { day: '2-digit' }).format(d);
                    const mo = new Intl.DateTimeFormat('pt', { month: '2-digit' }).format(d);
                    const ye = new Intl.DateTimeFormat('pt', { year: 'numeric' }).format(d);
                    date = `${da}/${mo}/${ye}`;

                    // Seleções de CORES _ Estado de PAGAMENTOS
                    if (data[i].verificacaoPagoAgente == true) {
                        status = "Pago";
                        color = "#47BC00"; // VERDE
                    }else if (data[i].verificacaoPagoAgente == false && data[i].dataVencimentoAgente < date) {
                        status = "Dívida";
                        color = "#FF3D00"; // VERMELHO
                    }else if (data[i].verificacaoPagoAgente == false && data[i].dataVencimentoAgente > date) {
                        status = "Pendente";
                        color = "#747474"; // CINZENTO (DEFAULT)
                    }

                    html = "<a href='#'><div class='row charge-div'> <div class='col-md-1 align-self-center'><div class='white-circle'><img src='http://lykasystems.test/storage/default-photos/M.jpg' width='100%' class='mx-auto'></div></div> <div class='col-md-3 text-truncate align-self-center ml-4'><p class='text-truncate' title='"+data[i].agente.nome + ' ' + data[i].cliente.apelido +"'>"+ data[i].agente.nome + ' ' + data[i].cliente.apelido +"</p></div> <div class='col-md-2 text-truncate align-self-center'><p class='text-truncate'>"+ data[i].valorAgente.split('.').join(',') +"€</p></div> <div class='col-md-2 align-self-center ml-4'><p class='text-truncate' title='"+ date +"'>"+ date +"</p></div> <div class='col-md-2 text-truncate align-self-center ml-auto'><p class='text-truncate' style='color:"+color+";'>"+status+"</p></div> </div></a>";
                    $(".payments").append(html);
                }

                // Pagamentos as UNIVERSIDADES
                if (data[i].valorUniversidade1 != null && $("#universidades").find(":selected").val() != 'default') {
                    // Formato da DATA DE VENCIMENTO
                    const d = new Date(data[i].dataVencimentoUni1);
                    const da = new Intl.DateTimeFormat('pt', { day: '2-digit' }).format(d);
                    const mo = new Intl.DateTimeFormat('pt', { month: '2-digit' }).format(d);
                    const ye = new Intl.DateTimeFormat('pt', { year: 'numeric' }).format(d);
                    date = `${da}/${mo}/${ye}`;

                    // Seleções de CORES _ Estado de PAGAMENTOS
                    if (data[i].verificacaoPagoUni1 == true) {
                        status = "Pago";
                        color = "#47BC00"; // VERDE
                    }else if (data[i].verificacaoPagoUni1 == false && data[i].dataVencimentoUni1 < date) {
                        status = "Dívida";
                        color = "#FF3D00"; // VERMELHO
                    }else if (data[i].verificacaoPagoUni1 == false && data[i].dataVencimentoUni1 > date) {
                        status = "Pendente";
                        color = "#747474"; // CINZENTO (DEFAULT)
                    }

                    html = "<a href='#'><div class='row charge-div'> <div class='col-md-1 align-self-center'><div class='white-circle'><img src='http://lykasystems.test/storage/default-photos/M.jpg' width='100%' class='mx-auto'></div></div> <div class='col-md-3 text-truncate align-self-center ml-4'><p class='text-truncate' title='"+data[i].universidade1.nome+"'>"+data[i].universidade1.nome+"</p></div> <div class='col-md-2 text-truncate align-self-center'><p class='text-truncate'>"+ data[i].valorUniversidade1.split('.').join(',') +"€</p></div> <div class='col-md-2 align-self-center ml-4'><p class='text-truncate' title='"+ date +"'>"+ date +"</p></div> <div class='col-md-2 text-truncate align-self-center ml-auto'><p class='text-truncate' style='color:"+color+";'>"+status+"</p></div> </div></a>";
                    $(".payments").append(html);
                }

                // Pagamentos aos FORNECEDORES
                if ($("#fornecedores").find(":selected").val() != 'default') {
                    var relacao = data[i].relacao;
                    for (var j = 0; j < relacao.length; j++) {
                        // Formato da DATA DE VENCIMENTO
                        const d = new Date(relacao[j].dataVencimentoUni1);
                        const da = new Intl.DateTimeFormat('pt', { day: '2-digit' }).format(d);
                        const mo = new Intl.DateTimeFormat('pt', { month: '2-digit' }).format(d);
                        const ye = new Intl.DateTimeFormat('pt', { year: 'numeric' }).format(d);
                        date = `${da}/${mo}/${ye}`;

                        // Seleções de CORES _ Estado de PAGAMENTOS
                        if (relacao[j].verificacaoPago == true) {
                            status = "Pago";
                            color = "#47BC00"; // VERDE
                        }else if (relacao[j].verificacaoPago == false && relacao[j].dataVencimento < date) {
                            status = "Dívida";
                            color = "#FF3D00"; // VERMELHO
                        }else if (relacao[j].verificacaoPago == false && relacao[j].dataVencimento > date) {
                            status = "Pendente";
                            color = "#747474"; // CINZENTO (DEFAULT)
                        }

                        html = "<a href='#'><div class='row charge-div'> <div class='col-md-1 align-self-center'><div class='white-circle'><img src='http://lykasystems.test/storage/default-photos/M.jpg' width='100%' class='mx-auto'></div></div> <div class='col-md-3 text-truncate align-self-center ml-4'><p class='text-truncate' title='"+relacao[j].fornecedor.nome+"'>"+relacao[j].fornecedor.nome+"</p></div> <div class='col-md-2 text-truncate align-self-center'><p class='text-truncate'>"+ relacao[j].valor.split('.').join(',') +"€</p></div> <div class='col-md-2 align-self-center ml-4'><p class='text-truncate' title='"+ date +"'>"+ date +"</p></div> <div class='col-md-2 text-truncate align-self-center ml-auto'><p class='text-truncate' style='color:"+color+";'>"+status+"</p></div> </div></a>";
                        $(".payments").append(html);
                    }
                    }
            }

            window.location.assign("http://lykasystems.test/pagamentos#append-payment");
            history.pushState("", document.title, window.location.pathname);
        },
        error: function() {
            console.log('NOK');
        }
    });
});
