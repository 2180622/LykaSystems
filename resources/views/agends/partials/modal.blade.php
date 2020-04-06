<div class="modal fade" id="modalCalendar" tabindex="-1" role="dialog" aria-labelledby="titleModal" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="titleModal">Novo Evento</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form>
                    <div class="form-group">
                        <label for="title">Titulo</label>
                        <input type="text" class="form-control" id="title" name="title">
                    </div>
                    <div class="form-group">
                        <label for="startDate">Data/Hora Inicial</label>
                        <input type="date" class="form-control" id="startDate" name="startDate">
                    </div>
                    <div class="form-group">
                        <label for="endDate">Data/Hora Final</label>
                        <input type="date" class="form-control" id="endDate" name="endDate">
                    </div>
                    <div class="form-group">
                        <label for="color">Cor do Evento</label>
                        <input type="color" class="form-control" id="color" name="color">
                    </div>
                    <div class="form-group">
                        <label for="description">Descrição</label>
                        <textarea type="text" class="form-control" id="description" rows="2" name="description">
                       </textarea>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="submit" class="top-button">Guadar</button>
                <button type="submit" class="top-button btn_submit bg-danger">Eliminar</button>
            </div>
        </div>
    </div>
</div>
