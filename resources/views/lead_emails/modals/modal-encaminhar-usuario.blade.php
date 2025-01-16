<div class="modal fade" id="ModalEncaminharUsuario" tabindex="-1" role="dialog"
    aria-labelledby="ModalEncaminharUsuarioTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title mt-0" id="ModalEncaminharUsuarioTitle">Encaminhar</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="form_enc_usuario">
                <div class="modal-body">
                    <input type="hidden" name="encaminhar_portal_id" id="encaminhar_portal_id" value="">
                    <div class="col-lg-6">
                        <label class="form-label" for="encaminhar_usuario">Usuário</label>

                        <select class="form-select" name="encaminhar_usuario" id="encaminhar_usuario">
                            <?php  foreach ($user_todos as $user)  :?>
                            <option value="{{ $user->id }}">{{ $user->name }}</option>
                            <?php  endforeach;  ?>
                        </select>

                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="bttn-material-flat bttn-sm bttn-danger"
                        data-bs-dismiss="modal">FECHAR</button>
                    <button type="button" class="bttn-material-flat bttn-sm bttn-success ml-2"
                        id="btn_encaminhar_cliente">ENCAMINHAR</button>
                </div>
            </form>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

