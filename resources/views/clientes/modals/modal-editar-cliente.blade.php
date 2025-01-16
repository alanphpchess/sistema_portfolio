<div class="modal fade" id="ModalEditarCliente" tabindex="-1" role="dialog" aria-labelledby="ModalEditarClienteTitle"
    aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title mt-0" id="ModalEditarClienteTitle">Editar Cliente </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

           
            <div class="modal-body">
                <form class="form_edit_cli">
                <div class="row">
                    <div class="col-lg-6">
                        <div class="mb-3">
                            <label class="form-label" for="nome_cliente">
                                Nome
                            </label>
                            <input type="text" class="form-control" id="edit_nome" name="nome" value="">
                            <input type="hidden" class="form-control" id="edit_id" name="id" value="">
                        </div>
                    </div>
                    {{-- <div class="col-lg-6">
                        <div class="mb-3">
                            <label class="form-label" for="emp_cliente">
                                Empreendimento
                            </label>
                            <input type="text" class="form-control" id="edit_emp" name="emp" value="" disabled>
                        </div>
                    </div> --}}
                </div>
                <div class="row">
                    <div class="col-lg-3">
                        <div class="mb-3">
                            <label class="form-label" for="telefone_cliente">
                                Telefone
                            </label>
                            <input type="text" class="form-control telefone" id="edit_telefone" name="telefone"
                                value="">
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="mb-3">
                            <label class="form-label" for="celular_cliente">
                                Celular
                            </label>
                            <input type="text" class="form-control telefone" id="edit_celular" name="celular"
                                value="">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-4">
                        <div class="mb-3">
                            <label class="form-label" for="email_1_cliente">
                                E-mail 1
                            </label>
                            <input type="mail" class="form-control" id="edit_email_1" name="email_1"
                                value="">
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="mb-3">
                            <label class="form-label" for="email_2_cliente">
                                E-mail 2
                            </label>
                            <input type="mail" class="form-control" id="edit_email_2" name="email_2"
                                value="">
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="mb-3">
                            <label class="form-label" for="fgts_cliente">
                                FGTS
                            </label>
                            <select class="form-select" name="fgts" id="edit_fgts">
                                <option value="Não">Não</option>
                                <option value="Sim">Sim</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-3">
                        <div class="mb-3">
                            <label class="form-label" for="data_cep">
                                CEP
                            </label>
                            <input type="mail" class="form-control cep" id="edit_cep" name="cep" value="">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-4">
                        <div class="mb-4">
                            <label class="form-label" for="data_endereco">
                                Endereço
                            </label>
                            <input type="mail" class="form-control" id="edit_endereco" name="endereco"
                                value="">
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="mb-4">
                            <label class="form-label" for="data_numero">
                                Número
                            </label>
                            <input type="mail" class="form-control" id="edit_numero" name="numero"
                                value="">
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="mb-4">
                            <label class="form-label" for="data_bairro">
                                Bairro
                            </label>
                            <input type="mail" class="form-control" id="edit_bairro" name="bairro"
                                value="">
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="mb-4">
                            <label class="form-label" for="data_cidade">
                                Cidade
                            </label>
                            <input type="mail" class="form-control" id="edit_cidade" name="cidade"
                                value="">
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="mb-4">
                            <label class="form-label" for="estado">
                                Estado
                            </label>
                            <input type="text" class="form-control" id="edit_estado" name="estado"
                            value="" >
                        </div>
                    </div>
                </div>

            </div>
            <div class="modal-footer">
                <button type="button" id="salvar_editar_cliente"
                    class="bttn-material-flat bttn-sm bttn-success ml-2" data-bs-dismiss="modal">Salvar</button>
                <button type="button" class="bttn-material-flat bttn-sm bttn-danger"
                    data-bs-dismiss="modal">Fechar</button>
            </div>
        </form>




        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->



