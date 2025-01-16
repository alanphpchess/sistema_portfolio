<div class="modal fade" id="ModalEditPasta" tabindex="-1" role="dialog" aria-labelledby="ModalEditPastaTitle"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title mt-0" id="ModalEditPastaTitle">Editar Pasta</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form class="form_edit_pasta">

                <div class="modal-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="mb-3">
                                <label class="form-label" for="nome">Nome</label>
                                <input type="text" class="form-control" id="nome_edit" name="nome">
                                <input type="hidden" class="id_pasta" id="id_pasta_edit" value="">
                                <input type="hidden" class="id_cliente_edit" id="id_cliente_edit" value="">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="mb-3">
                                <label class="form-label" for="contrato">Pasta</label>
                                <select class="select_edit_pasta" name="opcao_pasta">
                                    @foreach ($opcoes_pastas as $opcao_pasta)
                                        <option value="{{ $opcao_pasta->id }}"
                                            data-src="{{ asset($opcao_pasta->url) }}">
                                            {{ $opcao_pasta->nome }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="mb-3">
                                <label for="descricao">Descrição</label>
                                <textarea class="form-control" id="descricao_edit" rows="4" name="descricao"></textarea>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger waves-effect" data-bs-dismiss="modal">Fechar</button>
                    <button type="button"
                        class="btn btn-success waves-effect waves-light btn_edit_pasta">Editar</button>
                </div>
            </form>



        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
