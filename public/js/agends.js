$(function () {
    $(".saveEvent").click(function () {
        let id = $("#modalCalendar input[name='id']").val();

        let title = $("#modalCalendar input[name='titulo']").val();

        let start = $("#modalCalendar input[name='dataInicio']").val();

        let end = $("#modalCalendar input[name='dataFim']").val();

        let color = $("#modalCalendar input[name='cor']").val();

        let description = $("#modalCalendar texterea[name='descricao']").val();
    });
});

function resetForm(form) {
    $(form)[0].reset();
}
