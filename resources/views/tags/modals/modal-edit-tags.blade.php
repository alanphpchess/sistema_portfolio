<div class="modal fade" id="ModalEditTags" tabindex="-1" role="dialog" aria-labelledby="ModalEditTagsTitle"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title mt-0" id="ModalEditTagsTitle">Editar Tags</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form class="form_edit_tags">

                <div class="modal-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="mb-3">
                                <label class="form-label" for="nome">Nome</label>
                                <input type="text" class="form-control" id="nome_edit" name="nome">
                                <input type="hidden" class="id_tags" id="id_tags_edit" value="">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-12">
                            <div class="mb-3">
                                <label for="cor">Cor</label>
                                <input type="color" id="cor_edit" name="cor" class="form-control">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger waves-effect" data-bs-dismiss="modal">Fechar</button>
                    <button type="button"
                        class="btn btn-success waves-effect waves-light btn_edit_tags">Salvar</button>
                </div>
            </form>



        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
