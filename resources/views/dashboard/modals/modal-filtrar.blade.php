<div class="modal fade" id="ModalFiltrarDashboard" tabindex="-1" role="dialog" aria-labelledby="ModalFiltrarDashboardTitle"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title mt-0" id="ModalFiltrarDashboardTitle">Filtrar Dashboard</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form class="form_filtrar_dashboard">
                <div class="modal-body">

                    <div class="row">

                        <div class="row mb-5">
                            <div class="col-md-6 mt-1">
                                <div class="form-group">
                                    <label for="dataInicio">Data de Início</label>
                                    <input type="date" class="form-control" id="dataInicio" name="data_inicio" required>
                                </div>
                            </div>
                            <div class="col-md-6 mt-1">
                                <div class="form-group">
                                    <label for="dataFim">Data de Fim</label>
                                    <input type="date" class="form-control" id="dataFim" name="data_fim" required>
                                </div>
                            </div>
                            @if($perfil_usuario == 1)
                            <div class="col-md-6 mt-1">
                                <div class="form-group">
                                    <label for="corretor">Corretor</label>
                                    <select class="form-control" id="corretor" name="corretor_id" required>
                                        <option value="">Selecione...</option>
                                        @foreach ($corretores as $corretor)
                                            <option value="{{ $corretor->id }}">{{ $corretor->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            @endif
                            <div class="col-md-6 mt-1">
                                <div class="form-group">
                                    <label for="fonte">Fonte</label>
                                    <select class="form-control" id="fonte" name="fonte_id" required>
                                        <option value="">Selecione...</option>
                                        @foreach ($fontes as $fonte)
                                            <option value="{{ $fonte->id_fonte }}">{{ $fonte->titulo_fonte }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6 mt-1">
                                <div class="form-group">
                                    <label for="empreendimento">Empreendimento</label>
                                    <select class="form-control" id="empreendimento" name="empreendimento_id" required>
                                        <option value="">Selecione...</option>
                                        @foreach ($empreendimentos as $empreendimento)
                                            <option value="{{ $empreendimento->id_empreendimento }}">
                                                {{ $empreendimento->nome_empreendimento }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6 mt-1">
                                <div class="form-group">
                                    <label for="status">Status</label>
                                    <select class="form-control" id="status_id" name="status_id" required>
                                        <option value="">Selecione...</option>
                                        @foreach ($bd_status as $status)
                                            <option value="{{ $status->id_status }}">
                                                {{ $status->titulo_status }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                        </div>


                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="bttn-material-flat bttn-sm bttn-success "
                        data-bs-dismiss="modal">Fechar</button>
                    <button type="button" class="bttn-material-flat bttn-sm bttn-danger "
                        id="filtrar_dashboard">FILTRAR</button>
                </div>
            </form>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
