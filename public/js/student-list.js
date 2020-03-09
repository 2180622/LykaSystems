$('#dataTableUser').DataTable({
    "columnDefs": [
        {"orderable": false, "targets": 3},

        {"width": "120px", "targets": 0},

        {"width": "130px", "targets": 2},
        {"width": "120px", "targets": 3}

    ],
    "order": [[0, "desc"]],

    "language": {'url': '//cdn.datatables.net/plug-ins/1.10.19/i18n/Portuguese.json'}
});
