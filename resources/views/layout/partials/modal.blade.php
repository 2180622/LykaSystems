<!-- Modal -->
<div class="modal fade" id="modalLogout" tabindex="-1" role="dialog" aria-labelledby="Modal" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Terminar sessão</h5>


                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <span>Tem a certeza que deseja terminar sessão?<br><strong>Todos os dados que não foram gravados, serão perdidos.</strong></span><br><br>

            </div>
            <div class="modal-footer">
                <a href="{{ route('logout') }}" class="top-button btn_submit bg-danger">Sim, terminar sessão
                </a>
                <button type="button" class="top-button bg-secondary mr-2" data-dismiss="modal">Cancelar</button>
            </div>
        </div>
    </div>
</div>
