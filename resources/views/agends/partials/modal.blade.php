<div class="modal fade" id="modalCalendar" tabindex="-1" role="dialog" aria-labelledby="titleModal" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="titleModal">Novo Evento</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="/agends/create" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="calendar">
                        <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.9.0/fullcalendar.min.js"></script>
                    </div>

                    <div class="row">
                        <div class="col-md-9">
                            <div class="form-group">
                                <i class="fas fa-pen mr-2" style="color: #6A74C9;"></i>
                                <label for="title">Titulo</label>
                                <input type="text" class="form-control" id="title" name="titulo"
                                       placeholder="Insira o Titulo do evento.">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <i class="fas fa-palette mr-2" style="color: #6A74C9;"></i>
                                <label for="color">Cor</label>
                                <input type="color" class="form-control" id="color" name="cor">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <i class="far fa-calendar-alt mr-2" style="color: #6A74C9;"></i>
                                <label for="startDate">Data/Hora Inicial</label>
                                <input type="date" class="form-control" id="startDate" name="dataInicio">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <i class="far fa-calendar-alt mr-2" style="color: #6A74C9;"></i>
                                <label for="endDate">Data/Hora Final</label>
                                <input type="date" class="form-control" id="endDate" name="dataFim">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <i class="fas fa-align-right mr-2" style="color: #6A74C9;"></i>
                                <label for="description">Descrição</label>
                                <input type="text" class="form-control" id="description" name="descricao"
                                       placeholder="Insira a Descrição do evento.">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="top-button mr-2" name="ok" id="buttonSubmit">Guadar</button>
                    <button type="button" class="top-button btn_submit bg-danger" data-dismiss="modal">Cancelar</button>
                </div>
            </form>
        </div>
    </div>
</div>
