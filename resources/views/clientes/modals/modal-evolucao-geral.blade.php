<div class="modal fade" id="ModalEvolucaoGeral" tabindex="-1" role="dialog" aria-labelledby="ModalEvolucaoGeralTitle"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title mt-0" id="ModalEvolucaoGeralTitle">Adicionar Status </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form class="form_edit_evolucao">

                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <input type="hidden" name="cliente_id" value="{{ $cliente->id_cliente }}">
                            <select class="form-select" name="status" id="select_status">
                                <option>Selecione</option>
                                <?php foreach($status as $status): ?>
                                  <option value="<?= $status->id_status ?>"><?= $status->titulo_status ?></option>
                                <?php endforeach; ?>
                            </select>

                        </div>
                    </div>


                </div>

                <div class="modal-footer">
                    <button type="button" class="bttn-material-flat bttn-sm bttn-danger"
                        data-bs-dismiss="modal">Fechar</button>
                    <button type="button" class="bttn-material-flat bttn-sm bttn-success ml-2" id="add_status">Adicionar</button>
                </div>
            </form>



        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
