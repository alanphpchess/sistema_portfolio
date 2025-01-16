

<div class="modal" id="ModalEditarRoleta">
    <div class="modal-dialog modal-lg modal-dialog-scrollable">
      <div class="modal-content">
      
        <!-- Modal Header -->
        <div class="modal-header">
          <h5 class="modal-title mt-0" id="ModalEditarRoletaTitle">Editar Roleta</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        
        <!-- Modal body -->
        
        <div class="modal-body">
            <form class="form_editar_roleta">
            <div class="row">
               
                <input type="hidden" class="form-control" id="id_roleta" name="id_roleta" >
      
            <div class="col-lg-6">
                <label class="form-label" for="nome_roleta">Nome Roleta</label>
                <input type="text" class="form-control nome_roleta" id="nome_roleta" name="nome_roleta">
            </div>
            <div class="col-lg-6">
                <label class="form-label" for="empreendimento">Empreendimento</label>
                <select class="form-select" name="empreendimento" id="empreendimento">
                    <option id="select_empreendimento_titulo"></option>
                    <?php  foreach ($bd_empreendimento as $empreendimento)  :?>
                    <option value="{{ $empreendimento->id_empreendimento }}">{{ $empreendimento->nome_empreendimento }}</option>
                    <?php  endforeach;  ?>
                </select>
            </div>
            <div class="col-lg-6">
                <label class="form-label" for="sede">Sede</label>
                <select class="form-select" name="sede" id="sede">
                    <option id="select_sede_titulo"></option>
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
                    <option value="segunda">Segunda</option>
                    <option value="terca">Terça</option>
                    <option value="quarta">Quarta</option>
                    <option value="quinta">Quinta</option>
                    <option value="sexta">Sexta</option>
                    <option value="sabado">Sábado</option>
                    <option value="domingo">Domingo</option>
                    <option value="segunda_sexta">Segunda a Sexta</option>
                    <option value="finais_semana">Finais de Semana</option>
                </select>
            </div>
            <div class="col-lg-6">
                <div class="mb-3">
                    <label class="form-label" for="data_roleta">Data *</label>
                    <input type="datetime-local" class="form-control" id="data_roleta" name="data_roleta">
                </div>
            </div>
        </div>

            <table id="tabelaRoletaUsuarios" class="display nowrap" style="width:100%">
                <thead>
                    <tr>
                        <th>Nome</th>
                        <th>E-mail</th>
                        <th>Faz Parte da Roleta?</th>
                        <th>Tempo</th>
                        <th>Sequência Atendimento</th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
        </div>
        
        <!-- Modal footer -->
        <div class="modal-footer">
            <button type="button" class="bttn-material-flat bttn-sm bttn-danger"
                data-bs-dismiss="modal">Fechar</button>
            <button type="button" class="bttn-material-flat bttn-sm bttn-success ml-2"
                id="atualizar_roleta">SALVAR</button>
        </div>
    </form>
        
      </div>
    </div>
  </div>
</div>
