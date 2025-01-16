<div class="modal fade" id="ModalEditSede" tabindex="-1" role="dialog" aria-labelledby="ModalEditSedeTitle"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title mt-0" id="ModalEditSedeTitle">Editar Sede</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form class="form_edit_sede">

                <div class="modal-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="mb-3">
                                <label class="form-label" for="nome">Nome</label>
                                <input type="text" class="form-control" id="nome_edit" name="nome">
                                <input type="hidden" class="id_sede" id="id_sede_edit" value="">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-6 col-6">
                            <div class="mb-3">
                                <label for="cnpj">CNPJ</label>
                                <input class="form-control" id="cnpj" rows="4" name="cnpj">
                            </div>
                        </div>
                        <div class="col-lg-6 col-6">
                            <div class="mb-3">
                                <label for="telefone">Telefone</label>
                                <input class="form-control" id="telefone" rows="4" name="telefone">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-6 col-6">
                            <div class="mb-3">
                                <label for="celular">Celular</label>
                                <input class="form-control" id="celular" rows="4" name="celular">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6 col-6">
                            <div class="mb-3">
                                <label for="CEP">CEP</label>
                                <input class="form-control" id="cep" rows="4" name="cep">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-8 col-8">
                            <div class="mb-3">
                                <label for="Endereco">Endereço
                                </label>
                                <input class="form-control" id="endereco" rows="4" name="endereco">
                            </div>
                        </div>
                        <div class="col-lg-4 col-4">
                            <div class="mb-3">
                                <label for="numero">Número
                                </label>
                                <input class="form-control" id="numero" rows="4" name="numero">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-8 col-8">
                            <div class="mb-3">
                                <label for="cidade">Cidade
                                </label>
                                <input class="form-control" id="cidade" rows="4" name="cidade">
                            </div>
                        </div>
                        <div class="col-lg-4 col-4">
                            <div class="mb-3">
                                <label class="form-label" for="estado">Estado</label>
                                <select id="estado" class="form-control estado" name="estado" required>
                                    <option  value="">Selecione</option>
                                    <option value="Acre">Acre</option>
                                    <option value="Alagoas">Alagoas</option>
                                    <option value="Amapá">Amapá</option>
                                    <option value="Amazonas">Amazonas</option>
                                    <option value="Bahia">Bahia</option>
                                    <option value="Ceará">Ceará</option>
                                    <option value="Distrito Federal">Distrito Federal</option>
                                    <option value="Espírito Sant">Espírito Santo</option>
                                    <option value="Goiás">Goiás</option>
                                    <option value="Maranhão">Maranhão</option>
                                    <option value="Mato Grosso">Mato Grosso</option>
                                    <option value="Mato Grosso do Sul">Mato Grosso do Sul</option>
                                    <option value="Minas Gerais">Minas Gerais</option>
                                    <option value="Pará">Pará</option>
                                    <option value="Paraíba">Paraíba</option>
                                    <option value="Paraná">Paraná</option>
                                    <option value="Pernambuco">Pernambuco</option>
                                    <option value="Piauí">Piauí</option>
                                    <option value="Rio de Janeiro">Rio de Janeiro</option>
                                    <option value="Rio Grande do Norte">Rio Grande do Norte</option>
                                    <option value="Rio Grande do Sul">Rio Grande do Sul</option>
                                    <option value="Rondônia">Rondônia</option>
                                    <option value="Roraima">Roraima</option>
                                    <option value="Santa Catarina">Santa Catarina</option>
                                    <option value="São Paulo">São Paulo</option>
                                    <option value="Sergipe">Sergipe</option>
                                    <option value="Tocantins">Tocantins</option>
                                  </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger waves-effect" data-bs-dismiss="modal">Fechar</button>
                    <button type="button"
                        class="btn btn-success waves-effect waves-light btn_edit_sede">Salvar</button>
                </div>
            </form>



        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
