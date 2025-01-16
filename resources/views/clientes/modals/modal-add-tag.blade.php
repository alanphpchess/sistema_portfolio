<div class="modal fade" id="ModalAddTag" tabindex="-1" role="dialog" aria-labelledby="ModalAddTagTitle"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title mt-0" id="ModalAddTagTitle">Adicionar TAG </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form class="form_edit_evolucao">

                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <input type="hidden" name="cliente_id" value="{{ $cliente->id }}">
                            <select class="form-select" name="tags" id="select_tag">
                                <option>Selecione</option>
                                <?php 

                                $valores_unicos = [];
                                
                                foreach($tags as $item) {
                                    if (!in_array(trim($item->titulo), $valores_unicos)) {

                                        $valores_unicos[] = trim($item->titulo);
                                ?>
                                <option value="<?= $item->id ?>"><?= $item->titulo ?></option>
                                <?php
                                    }
                                }
                                ?>
                            </select>
                        </div>
                    </div>


                </div>

                <div class="modal-footer">
                    <button type="button" class="bttn-material-flat bttn-sm bttn-danger"
                        data-bs-dismiss="modal">Fechar</button>
                    <button type="button" class="bttn-material-flat bttn-sm bttn-success ml-2" id="add_tag">Adicionar</button>
                </div>
            </form>



        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
