<div class="modal fade" id="ModalAddCliente" tabindex="-1" role="dialog" aria-labelledby="ModalAddClienteTitle"
    aria-hidden="true">
    <div class="modal-dialog  modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title mt-0" id="ModalAddClienteTitle">Adicionar Cliente </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>


            <div class="modal-body">
                <form id="form_add_cli">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="mb-3">
                                <label class="form-label" for="finalidade">Nome</label>
                                <input type="text" class="form-control" id="nome" name="nome">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="mb-3">
                                <label class="form-label" for="fonte_renda">Sede</label>
                                <select class="select_sedes_2 ids_sedes" name="id_sedes[]" class="ids_sedes" multiple>
                                    <?php foreach($sedes as $sede) : ?>
                                    <option value="{{ $sede->id_sede }}">{{ $sede->nome_sede }}</option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="mb-3">
                                <label class="form-label" for="finalidade">Empreendimentos</label>
                                <select class="select_empreendimentos_2 ids_empreendimentos"
                                    name="id_empreendimentos[]">

                                </select>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="mb-3">
                                <label class="form-label" for="finalidade">Telefone</label>
                                <input type="text" class="form-control telefone" id="telefone" name="telefone">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="mb-3">
                                <label class="form-label" for="finalidade">Celular</label>
                                <input type="text" class="form-control celular" id="celular" name="celular">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="mb-3">
                                <label class="form-label" for="finalidade">Primeiro E-mail</label>
                                <input type="mail" class="form-control" id="email1" name="email1">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="mb-3">
                                <label class="form-label" for="finalidade">Segundo E-mail</label>
                                <input type="mail" class="form-control" id="email2" name="email2">
                            </div>
                        </div>

                    </div>



            </div>

            <div class="modal-footer">
                <button type="button" class="bttn-material-flat bttn-sm bttn-danger"
                    data-bs-dismiss="modal">Fechar</button>
                <button type="button" class="bttn-material-flat bttn-sm bttn-success ml-2"
                    id="btn_inserir_cliente">Adicionar</button>
            </div>
            </form>




        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
