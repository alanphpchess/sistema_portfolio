<div class="modal fade" id="ModalConvite" tabindex="-1" role="dialog" aria-labelledby="ModalConviteTitle"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title mt-0" id="ModalConviteTitle">Enviar Convite</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form class="form_env_convite">

                <div class="modal-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="mb-3">
                                <label class="form-label" for="email">E-mail</label>
                                <input type="text" class="form-control" id="email" name="email">
                            </div>
                        </div>

                        <div class="col-lg-12">
                            <div class="mb-3">
                                <label class="form-label" for="fonte_renda">Sede</label>
                                <select class="select_multiple" name="sedes" multiple>
                                    <?php foreach($sedes as $sede) : ?>
                                    <option value="{{ $sede->id_sede }}">{{ $sede->nome_sede }}</option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                    </div>

                </div>



            </form>

            <div class="modal-footer">
                <button type="button" class="bttn-material-flat bttn-sm bttn-danger"
                    data-bs-dismiss="modal">Fechar</button>
                <button type="button" class="bttn-material-flat bttn-sm bttn-success btn_env_convite">Enviar
                    E-mail</button>
            </div>


        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
