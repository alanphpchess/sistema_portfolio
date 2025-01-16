<div class="modal fade" id="ModalAddAlerta" tabindex="-1" role="dialog" aria-labelledby="ModalAddAlertaTitle"
    aria-hidden="true">
    <div class="modal-dialog  modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title mt-0" id="ModalAddAlertaTitle">Adicionar Alerta </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form class="form_add_alerta">

                <div class="modal-body">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="mb-3">
                                <label class="form-label" for="data">Data *</label>
                                <input type="date" class="form-control" id="data" name="data_alerta" required>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="mb-3">
                                <label class="form-label" for="horario">Horário *</label>
                                <input type="time" class="form-control" id="horario" name="horario_alerta" required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="mb-3">
                                <label for="cor">Cor</label>
                                <input type="color" id="cor" name="cor_alerta" class="form-control" required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="mb-3">
                                <label class="form-label" for="mensagem_alerta">Mensagem: *</label>
                                <textarea class="form-control" name="mensagem_alerta" rows="5" id="mensagem_alerta" required>
                                </textarea>
                            </div>
                        </div>
                    </div>

                </div>

                <div class="modal-footer">
                    <button type="button" class="bttn-material-flat bttn-sm bttn-danger"
                        data-bs-dismiss="modal">Fechar</button>
                    <button type="button" class="bttn-material-flat bttn-sm bttn-success ml-2" id="add_alerta">Adicionar</button>
                </div>
            </form>



        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
