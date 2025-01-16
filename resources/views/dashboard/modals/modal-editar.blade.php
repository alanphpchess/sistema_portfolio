<div class="modal fade" id="ModalEditarDashboard" tabindex="-1" role="dialog" aria-labelledby="ModalEditarDashboardTitle"
    aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title mt-0" id="ModalEditarDashboardTitle">Editar Dashboard</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">

                <div class="row">
                    <div class="col-6">
                        <ul class="list-group" id="LeftListComponent" style="height:100%">
                            @foreach ($dashboards as $dashboard)
                                @if (!in_array($dashboard->id, $ids_dashboard_list_modal))
                                    @if ($dashboard->permissao == 0 && $perfil_usuario != 1 || $perfil_usuario == 1)
                                        <li class="list-group-item" class="item_dashboard"
                                            data-target="{{ $dashboard->id }}"><img
                                                src=" {{ asset('' . $dashboard->url_img . '') }}" style="width:100%">
                                        </li>
                                    @endif
                                @endif
                            @endforeach

                        </ul>
                    </div>
                    <div class="col-6">
                        <ul class="list-group" id="RightListComponent" style="height:100%" data-perfil="{{$perfil_usuario}}">

                            @foreach ($dashboards as $dashboard)
                                @if (in_array($dashboard->id, $ids_dashboard_list_modal))
                                    @if ($dashboard->permissao == 0 && $perfil_usuario == 3 || $perfil_usuario == 1 && !empty($dashboard))
                                        <li class="list-group-item" class="item_dashboard"
                                            data-target="{{ $dashboard->id }}"><img
                                                src=" {{ asset('' . $dashboard->url_img . '') }}" style="width:100%">
                                        </li>
                                    @endif
                                @endif
                            @endforeach

                        </ul>
                    </div>
                </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="bttn-material-flat bttn-sm bttn-success "
                    data-bs-dismiss="modal">Fechar</button>
                <button type="button" class="bttn-material-flat bttn-sm bttn-danger "
                    id="salvar_dashboard">Salvar</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
