<div class="modal fade" id="ModalADDEmpresa" tabindex="-1" role="dialog" aria-labelledby="ModalADDEmpresaTitle"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title mt-0" id="ModalADDEmpresaTitle">Adicionar Empresa</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>


            <div class="modal-body">
                <form class="form_add_empresa">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="mb-3">
                                <label class="form-label" for="nome">Nome</label>
                                <input type="text" class="form-control" id="nome_edit"
                                    name="nome" required>
                                <input type="hidden" class="id_empresa" id="id_cliente_primario" value="">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-6 col-6">
                                <div class="mb-3">
                                    <label for="cnpj">CNPJ</label>
                                    <input class="form-control cnpj" id="cnpj" rows="4" name="cnpj" required>
                                </div>
                            </div>
                            <div class="col-lg-6 col-6">
                                <div class="mb-3">
                                    <label for="email_cliente_primario_edit">Email</label>
                                    <input type="mail" class="form-control" id="email_cliente_primario" rows="4"
                                        name="email_cliente_primario" required>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-6 col-6">
                                <div class="mb-3">
                                    <label for="telefone">Telefone</label>
                                    <input class="form-control telefone" id="telefone" rows="4" name="telefone">
                                </div>
                            </div>
                            <div class="col-lg-6 col-6">
                                <div class="mb-3">
                                    <label for="celular">Celular</label>
                                    <input class="form-control telefone" id="celular" rows="4" name="celular" required>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-6 col-6">
                                <div class="mb-3">
                                    <label for="CEP">CEP</label>
                                    <input class="form-control cep" id="cep" rows="4" name="cep" required>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-8 col-8">
                                <div class="mb-3">
                                    <label for="Endereco">Endereço
                                    </label>
                                    <input class="form-control endereco" id="endereco" rows="4" name="endereco">
                                </div>
                            </div>
                            <div class="col-lg-4 col-4">
                                <div class="mb-3">
                                    <label for="numero">Número
                                    </label>
                                    <input class="form-control numero" id="numero" rows="4" name="numero">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-8 col-8">
                                <div class="mb-3">
                                    <label for="cidade">Cidade
                                    </label>
                                    <input class="form-control cidade" id="cidade" rows="4" name="cidade">
                                </div>
                            </div>
                            <div class="col-lg-4 col-4">
                                <div class="mb-3">
                                    <label class="form-label" for="estado">Estado</label>
                                    <input class="form-control estado" id="estado" rows="4" name="estado">
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- <div class="row">
                        <div class="col-lg-12">
                            <div class="mb-3">
                                <label for="descricao">Descrição</label>
                                <textarea class="form-control" id="descricao_edit" rows="4" name="descricao"></textarea>
                            </div>
                        </div>
                    </div> --}}
            </div>
            <div class="modal-footer">
                <button type="button" class="bttn-material-flat bttn-sm bttn-danger" data-bs-dismiss="modal">Fechar</button>
                <button type="button"
                    class="bttn-material-flat bttn-sm bttn-success btn_add_empresa">Salvar</button>
            </div>
            </form>

        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
