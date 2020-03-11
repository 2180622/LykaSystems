    $(document).ready(function() {




        $('#dataTable').DataTable( {


          "columnDefs": [
              { "orderable": false, "targets": 0 },
              { "orderable": false, "targets": 2 },
              { "orderable": false, "targets": 4 },
              { "width": "60px", "targets": 0 },
              { "width": "auto", "targets": 1 },
              { "width": "auto", "targets": 2 },
              { "width": "auto", "targets": 3 },
              { "width": "130px", "targets": 4 },
            ],


          "language": {
              "lengthMenu":  "Mostrar _MENU_ registos por página",
              "search":      "",
              "zeroRecords": "Sem registos",
              "paginate": {
                "first":      "Primeiro",
                "last":       "Ultimo",
                "next":       "Proximo",
                "previous":   "Anterior"
            },

              "info": "A mostrar página _PAGE_ de _PAGES_",
              "infoEmpty": "Sem registos disponiveis",
              "infoFiltered": "(filtrado de um total de _MAX_ registos)"
          },

          "order": [1, 'desc']


      } );



});




