<div class="modal fade" id="ModalAddRoleta" tabindex="-1" role="dialog" aria-labelledby="ModalAddRoletaTitle" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title mt-0" id="ModalAddRoletaTitle">Criar Roleta</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form class="form_criar_roleta">
                <div class="modal-body">
                    <div class="row">
               
                            <input type="hidden" class="form-control" id="id_roleta" name="id_roleta" >
                  
                        <div class="col-lg-6">
                            <label class="form-label" for="nome_roleta">Nome Roleta</label>
                            <input type="text" class="form-control nome_roleta" id="nome_roleta" name="nome_roleta">
                        </div>
                        <div class="col-lg-6">
                            <label class="form-label" for="empreendimento">Empreendimento</label>
                            <select class="form-select" name="empreendimento" id="empreendimento">

                                <?php  foreach ($bd_empreendimento as $empreendimento)  :?>
                                <option value="{{ $empreendimento->id_empreendimento }}">{{ $empreendimento->nome_empreendimento }}</option>
                                <?php  endforeach;  ?>
                            </select>
                        </div>
                        <div class="col-lg-6">
                            <label class="form-label" for="sede">Sede</label>
                            <select class="form-select" name="sede" id="sede">
                                <?php  foreach ($bd_sedes as $sedes)  :?>
                                <option value="{{$sedes->id_sede}}">{{ $sedes->nome_sede }}</option>
                                <?php  endforeach;  ?>
                            </select>
                        </div>
                        <div class="col-lg-6">
                            <label class="form-label" for="origem">Origem</label>
                            <select class="form-select" name="origem" id="origem">
                                <option value="Todos">Todos</option>
                                <option value="Portal">Portal</option>
                                <option value="Redes">Redes Sociais</option>
                                <option value="Whatsapp">Whatsapp Site</option>
                                <option value="Simulacao">Simulação</option>
                                <option value="Contato">Contato Site</option>
                                <option value="Chat">Chat Site</option>

                            </select>
                        </div>
                        <div class="col-lg-6">
                            <label class="form-label" for="fonte">Dia da Semana</label>
                            <select class="form-select" name="dia_semana" id="dia_semana">
                                <option value="-1">Todos os Dias</option>
                                <option value="3">Segunda</option>
                                <option value="4">Terça</option>
                                <option value="5">Quarta</option>
                                <option value="6">Quinta</option>
                                <option value="7">Sexta</option>
                                <option value="8">Sábado</option>
                                <option value="9">Domingo</option>
                                <option value="10">Segunda a Sexta</option>
                                <option value="11">Finais de Semana</option>
                            </select>
                        </div>
                        <div class="col-lg-6">
                            <div class="mb-3">
                                <label class="form-label" for="data_roleta">Data *</label>
                                <input type="datetime-local" class="form-control" id="data_roleta" name="data_roleta">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">

                            {{-- <table id="tabelaRoletaUsuariosAdd" class="display nowrap" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>Nome</th>
                                        <th>Sequência de Atendimento</th>
                                        <th>Faz Parte da Roleta?</th>
                                        <th>Tempo</th>

                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table> --}}
                        </div>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="bttn-material-flat bttn-sm bttn-danger"
                        data-bs-dismiss="modal">Fechar</button>
                    <button type="button" class="bttn-material-flat bttn-sm bttn-success ml-2"
                        id="btn_criar_roleta">CRIAR</button>
                </div>
            </form>



        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
