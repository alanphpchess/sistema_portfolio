<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>
    <div class="page-content">
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-flex align-items-center justify-content-between">
                        <h4 class="mb-0">Dashboard</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Sistema</a></li>
                                <li class="breadcrumb-item active">Dashboard</li>
                            </ol>
                        </div>

                    </div>
                </div>
            </div>


            <div class="row">
                <div class="col-2">
                    <div class="page-title-box d-flex align-items-center justify-content-between">
                        {{-- / BOTÃO EDITAR --}}
                        <button type="button" class="bttn-material-flat bttn-sm bttn-success btn-w-100 mb-5 mt-2"
                            data-bs-toggle="modal" data-bs-target="#ModalEditarDashboard">
                            <i class="ri-edit-2-fill"></i> Editar
                        </button>
                    </div>



                </div>
                <div class="col-2">
                    <div class="page-title-box d-flex align-items-center justify-content-between">
                        {{-- / BOTÃO FILTRAR --}}
                        <button type="button" class="bttn-material-flat bttn-sm bttn-primary btn-w-100 mb-5 mt-2"
                            data-bs-toggle="modal" data-bs-target="#ModalFiltrarDashboard">
                            <i class="ri-settings-2-fill"></i> FILTRAR
                        </button>
                    </div>



                </div>
            </div>

            <!-- end page title -->
            <div class="row">
                <div class="col-xl-12">
                    <div class="row" id="sortable-grid">


                        @foreach ($dashboard_itens as $dashboard_item)
                            @switch($dashboard_item->dashboard->nome)
                                @case('total_empreendimento')
                                    {{-- / CARD TOTAL EMPREENDIMENTOS --}}
                                    <div class="col-lg-4">
                                        <div class="card" data-dashboard_id="{{ $dashboard_item->dashboard->id }}">
                                            <div class="card-body">


                                                <h4 class="card-title mb-4">EMPREENDIMENTOS</h4>

                                                <div class="row text-center">
                                                    <div class="col-6">
                                                        <h3 class="mb-0" id="val_total_empreendimento">
                                                            {{ $total_empreendimentos }}</h3>
                                                        <p class="text-muted text-truncate">EMPREENDIMENTOS</p>
                                                    </div>
                                                </div>

                                                <div>
                                                    <canvas id="ChartTotalEmpreendimentos" height="260"></canvas>
                                                </div>

                                            </div>
                                        </div>
                                    </div>


                                @break;
                                @case('total_cliente')
                                    {{-- / CARD TOTAL CLIENTES --}}

                                    <div class="col-lg-4">
                                        <div class="card" data-dashboard_id="{{ $dashboard_item->dashboard->id }}">
                                            <div class="card-body">
                                                <h4 class="card-title mb-4">CLIENTES</h4>

                                                <div class="row text-center">
                                                    <div class="col-6">
                                                        <h3 class="mb-0" id="val_total_clientes">
                                                            {{ $total_clientes }}</h3>
                                                        <p class="text-muted text-truncate">CLIENTES</p>
                                                    </div>
                                                </div>

                                                <div>
                                                    <canvas id="ChartTotalClientes" height="260"></canvas>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                @break;
                                @case('total_equipe')
                                    {{-- / CARD TOTAL EQUIPE --}}

                                    <div class="col-lg-4">
                                        <div class="card" data-dashboard_id="{{ $dashboard_item->dashboard->id }}">
                                            <div class="card-body">
                                                <h4 class="card-title mb-4">EQUIPE</h4>

                                                <div class="row text-center">
                                                    <div class="col-6">
                                                        <h3 class="mb-0" id="val_total_equipe">
                                                            {{ $total_equipe }}</h3>
                                                        <p class="text-muted text-truncate">EQUIPE</p>
                                                    </div>
                                                </div>

                                                <div>
                                                    <canvas id="ChartTotalEquipe" height="260"></canvas>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                @break;
                                @case('status')
                                    {{-- / CARD STATUS --}}

                                    <div class="col-lg-4">
                                        <div class="card" data-dashboard_id="{{ $dashboard_item->dashboard->id }}">
                                            <div class="card-body">
                                                <h4 class="card-title mb-4">Status</h4>

                                                @foreach ($status as $status)
                                                    <div class="d-none status_titulo">{{ $status->titulo_status }}</div>
                                                    <div class="d-none status_quantidade">{{ $status->quantidade }}</div>
                                                @endforeach

                                                <div id="status_titulo">



                                                    <?php $titulos; ?>

                                                    <div>
                                                        <canvas id="ChartTipoImoveis" height="260"></canvas>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @break;
                                @case('atendimento_usuario')
                                    <div class="col-lg-4">
                                        <div class="card" data-dashboard_id="{{ $dashboard_item->dashboard->id }}">
                                            <div class="card-body">
                                                <h4 class="card-title mb-4">Atendimento por Usuário</h4>

                                                @foreach ($atendimentos_usuarios as $usuario)
                                                    <div class="d-none usuario_nome">{{ $usuario->name }}</div>
                                                    <div class="d-none usuario_quantidade">{{ $usuario->quantidade }}</div>
                                                @endforeach

                                                <div id="usuario_titulo">

                                                    <div>
                                                        <canvas id="ChartAtendimentoUsuario" height="260"></canvas>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @break;
                                @case('tags')
                                    {{-- / CARD TAGS --}}
                                    <div class="col-lg-4">
                                        <div class="card" data-dashboard_id="{{ $dashboard_item->dashboard->id }}">
                                            <div class="card-body">
                                                <h4 class="card-title mb-4">TAGS</h4>

                                                @foreach ($tags as $tags)
                                                    <div class="d-none tags_titulo">{{ $tags->titulo }}</div>
                                                    <div class="d-none tags_quantidade">{{ $tags->quantidade }}</div>
                                                @endforeach

                                                <div id="tags_titulo">



                                                    <?php $titulos; ?>

                                                    <div>
                                                        <canvas id="ChartTags" height="260"></canvas>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @break;
                                @case('leads_anual')
                                    <div class="col-lg-4">
                                        <div class="card" data-dashboard_id="{{ $dashboard_item->dashboard->id }}">
                                            <div class="card-body">
                                                <h4 class="card-title mb-4">Leads Anual</h4>
                                                @foreach ($leads as $led)
                                                    <div class="d-none leads_mes">{{ $led['mes'] }}</div>
                                                    <div class="d-none leads_total">{{ $led['total'] }}</div>
                                                @endforeach
                                                <canvas id="myChart" class="apex-charts" dir="ltr"></canvas>
                                            </div>
                                        </div>
                                    </div>
                                @break;
                            @endswitch
                        @endforeach


                    </div>


                </div>



            </div>


        </div>
    </div>
    <!-- end main content-->
    </div>

</x-app-layout>

@include('dashboard.modals.modal-editar');
@include('dashboard.modals.modal-filtrar');
@include('dashboard.modals.modal-informacao');

@hasSection('page_dashboard')
    @yield('page_dashboard')
@endif
