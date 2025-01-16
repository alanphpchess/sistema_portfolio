<div class="modal fade" id="EditarPerfilModal" tabindex="-1" role="dialog" aria-labelledby="EditarPerfilModal"
    aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title mt-0" id="formTitleModal">Editar Perfil </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>


            <div class="modal-body">
                <form class="EditarPerfilForm" enctype="multipart/form-data">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="mb-3">
                                <label>Nome</label>
                                <input type="text" class="form-control" id="nome" name="nome"
                                    value="{{ $user['name'] }}" required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="mb-3">
                                <label>Telefone</label>
                                <input type="text" class="form-control" id="telefone" name="telefone"
                                    value="{{ $user['telefone'] }}" required>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="mb-3">
                                <label>Celular</label>
                                <input type="text" class="form-control" id="celular" name="celular"
                                    value="{{ $user['celular'] }}" required>
                            </div>
                        </div>
                        {{-- <div class="col-lg-6">
                            <div class="mb-3">
                                <label>Empresa</label>
                                <input type="text" class="form-control" id="empresa" name="empresa"
                                    value="{{ $user['empresa'] }}" disabled>
                            </div>
                        </div> --}}
                        <div class="col-lg-6">
                            <div class="mb-3">
                                <label>Permissão</label>
                                <input type="text" class="form-control" id="permissao" name="permissao"
                                    value="{{ $user['permissao'] }}" disabled>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="mb-3">
                                <label>CPF</label>
                                <input type="text" class="form-control" id="cpf" name="cpf"
                                    value="{{ $user['cpf'] }}" required>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="mb-3">
                                <label>CRECI</label>
                                <input type="text" class="form-control" id="creci" name="creci"
                                    value="{{ $user['creci'] }}" required>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-6">
                            <div class="mb-3">
                                <label>CEP</label>
                                <input type="text" class="form-control" id="cep" name="cep"
                                    value="{{ $user['cep'] }}" required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="mb-3">
                                <label>Endereço</label>
                                <input type="text" class="form-control" id="endereco" name="endereco"
                                    value="{{ $user['endereco'] }}" required>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="mb-3">
                                <label>Número</label>
                                <input type="text" class="form-control" id="numero" name="numero"
                                    value="{{ $user['numero'] }}" required>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="mb-3">
                                <label>Cidade</label>
                                <input type="text" class="form-control" id="cidade" name="cidade"
                                    value="{{ $user['cidade'] }}" required>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="mb-3">
                                <label>Estado</label>
                                <select name="estado" class="form-control">
                                    <option value="{{ $user['cidade'] }}">{{ $user['estado'] }}</option>
                                    <option value="Acre">Acre</option>
                                    <option value="Alagoas">Alagoas</option>
                                    <option value="Amapá">Amapá</option>
                                    <option value="Amazonas">Amazonas</option>
                                    <option value="Bahia">Bahia</option>
                                    <option value="Ceará">Ceará</option>
                                    <option value="Distrito Federal">Distrito Federal</option>
                                    <option value="Espírito Santo">Espírito Santo</option>
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

                    <div class="row">
                        <div class="col-lg-6">
                            <div class="mb-3">
                                <label>Banco</label>
                                <input type="text" class="form-control" id="banco" name="banco"
                                    value="{{ $user['banco'] }}" required>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="mb-3">
                                <label>Tipo de Conta</label>
                                <select class="form-select" name="tipo_conta" id="tipo_conta" >
                                    <option value="">Selecione</option>
                                    <option value="Corrente">Corrente</option>
                                    <option value="Poupança">Poupança</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="mb-3">
                                <label>Conta</label>
                                <input type="text" class="form-control" id="conta_banco" name="conta_banco"
                                    value="{{ $user['conta_banco'] }}" required> 
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="mb-3">
                                <label>Agência</label>
                                <input type="text" class="form-control" id="agencia" name="agencia"
                                    value="{{ $user['agencia'] }}" required>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="mb-3">
                            <label>Imagem de Perfil</label>
                            <input type="file" id="foto_perfil" class="form-control foto_perfil"
                                name="foto_perfil">
                        </div>

                    </div>



                    <div class="row">
                        <div class="mb-3">
                            <label>Imagem da Empresa</label>
                            <input type="file" id="logo_empresa" class="form-control logo_empresa"
                                name="logo_empresa">
                        </div>

                    </div>

                    <div class="modal-footer">
                        <button type="button" class="bttn-material-flat bttn-sm bttn-danger"
                            data-bs-dismiss="modal">Fechar</button>
                        <button type="button" class="bttn-material-flat bttn-sm bttn-success ml-2"
                            id="btn_atualizar_perfil">SALVAR</button>
                    </div>
                </form>
            </div>




        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
