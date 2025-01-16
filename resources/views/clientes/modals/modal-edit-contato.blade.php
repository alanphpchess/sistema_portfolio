<div class="modal fade" id="ModalEditContato" tabindex="-1" role="dialog" aria-labelledby="ModalEditContatoTitle"
    aria-hidden="true">
    <div class="modal-dialog  modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title mt-0" id="ModalEditContatoTitle">Editar Contatos </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form class="form_add_contato">

                <div class="modal-body">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="mb-3">
                                <label class="form-label" for="data">Data *</label>
                                <input type="date" class="form-control" id="edit_data" name="data">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="mb-3">
                                <label class="form-label" for="horario">Horário *</label>
                                <input type="time" class="form-control" id="edit_horas" name="horas">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="mb-3">
                                <label class="form-label" for="contato_realizado">Contato realizado por: *</label>
                                <select class="form-select" name="comunicacao" id="edit_comunicacao">
                                    <option>Teste</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="mb-3">
                                <label class="form-label" for="observacao">Contato realizado por: *</label>
                                <textarea class="form-control" name="observacao" rows="5" id="edit_observacao">

                                </textarea>
                            </div>
                        </div>
                    </div>


                </div>

                <div class="modal-footer">
                    <button type="button" class="bttn-material-flat bttn-sm bttn-danger"
                        data-bs-dismiss="modal">Fechar</button>
                    <button type="button" class="bttn-material-flat bttn-sm bttn-success ml-2" id="add_contato">Editar</button>
                </div>
            </form>



        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
