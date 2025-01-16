<div class="modal fade" id="ModalInformacaoDashboard" tabindex="-1" role="dialog"
    aria-labelledby="ModalInformacaoDashboardTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title mt-0" id="ModalInformacaoDashboardTitle">Informação do filtro</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form class="form_filtrar_dashboard">
                <div class="modal-body">

                    <div class="row">

                        <div class="row mb-5">
                            <div class="col-md-6 mt-1">
                                <div class="form-group">
                                    <label for="dataInicio">Data de Início</label>

                                    @if (!empty($dashboard_filtro->filtro_data_inicio))
                                        <p>{{ date('d/m/Y', strtotime($dashboard_filtro->filtro_data_inicio)) }}</p>
                                    @else
                                        <p>Não definido</p>
                                    @endif

                                </div>

                            </div>
                            <div class="col-md-6 mt-1">
                                <div class="form-group">
                                    <label for="dataFim">Data de Fim</label>
                                    @if (!empty($dashboard_filtro->filtro_data_fim))
                                        <p>{{ date('d/m/Y', strtotime($dashboard_filtro->filtro_data_fim)) }}</p>
                                    @else
                                        <p>Não definido</p>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-6 mt-1">
                                <div class="form-group">
                                    <label for="corretor">Corretor</label>

                                    @if (!empty($dashboard_filtro->filtro_corretor))
                                        <p>{{ $dashboard_filtro->Users->name }}</p>
                                    @else
                                        <p>Não definido</p>
                                    @endif

                                </div>
                            </div>
                            <div class="col-md-6 mt-1">
                                <div class="form-group">
                                    <label for="fonte">Fonte</label>

                                    @if (!empty($dashboard_filtro->filtro_fonte))
                                        <p>{{ $dashboard_filtro->Fonte->titulo_fonte }}</p>
                                    @else
                                        <p>Não definido</p>
                                    @endif

                                </div>
                            </div>
                            <div class="col-md-6 mt-1">
                                <div class="form-group">
                                    <label for="empreendimento">Empreendimento</label>

                                    @if (!empty($dashboard_filtro->filtro_empreendimento))
                                        <p>{{ $dashboard_filtro->Empreendimentos->nome_empreendimento }}</p>
                                    @else
                                        <p>Não definido</p>
                                    @endif

                                </div>
                            </div>
                            <div class="col-md-6 mt-1">
                                <div class="form-group">
                                    <label for="empreendimento">Status</label>

                                    @if (!empty($dashboard_filtro->filtro_status))
                                        <p>{{ $dashboard_filtro->Status->titulo_status }}</p>
                                    @else
                                        <p>Não definido</p>
                                    @endif

                                </div>
                            </div>
                        </div>


                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="bttn-material-flat bttn-sm bttn-danger "
                        data-bs-dismiss="modal">Fechar</button>
                </div>
            </form>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
