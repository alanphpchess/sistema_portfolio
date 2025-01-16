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
                        <h4 class="mb-0">Dashboard
                            @if (!empty($dashboard_filtro))
                                <a href="#" data-bs-toggle="modal" data-bs-target="#ModalInformacaoDashboard">
                                    <i class="ri-information-line" style="font-size: 1rem;fill:red !important"></i>
                                </a>
                            @endif
                        </h4>

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
                            <i class="ri-settings-2-fill"></i> FILTRO
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
                                            <div class="card-body" style="height: 400px">


                                                <h4 class="card-title mb-4">EMPREENDIMENTOS: <span id="val_total_empreendimento"
                                                        style="font-size: 1rem">{{ $total_empreendimentos }}</span></h4>



                                                <div class="container_list_paginate">
                                                    {{-- <canvas id="ChartTotalEmpreendimentos" style="height: 250px; width: 100%;"></canvas> --}}


                                                    <div id="list_paginate_emp" class="list_paginate">

                                                        @foreach ($empreendimentos as $empreendimento)
                                                            <p>{{ $empreendimento->nome_empreendimento }}</p>
                                                        @endforeach

                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                    </div>


                                @break;
                                @case('total_cliente')

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
                                                <canvas id="ChartTotalClientes" style="height: 250px; width: 100%;"></canvas>
                                            </div>

                                        </div>
                                    </div>
                                </div>


                                @break;
                                @case('total_equipe')
                                    {{-- / CARD TOTAL EQUIPE --}}

                                    <div class="col-lg-4">
                                        <div class="card" data-dashboard_id="{{ $dashboard_item->dashboard->id }}">
                                            <div class="card-body" style="height: 400px">


                                                <h4 class="card-title mb-4">EQUIPE: {{ $total_equipe }}</span></h4>



                                                <div class="container_list_paginate">
                                                    {{-- <canvas id="ChartTotalEmpreendimentos" style="height: 250px; width: 100%;"></canvas> --}}


                                                    <div id="list_paginate_equipe" class="list_paginate">

                                                        @foreach ($equipe as $equipe)
                                                        <p>{{ $equipe->name }}</p>
                                                    @endforeach

                                                    </div>
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
                                                <h4 class="card-title mb-4">STATUS</h4>

                                                @foreach ($status as $status)
                                                    <div class="d-none status_titulo">{{ $status->titulo_status }}</div>
                                                    <div class="d-none status_quantidade">{{ $status->quantidade }}</div>
                                                @endforeach

                                                <div id="status_titulo">



                                                    <?php $titulos; ?>

                                                    <div>
                                                        <canvas id="ChartTipoImoveis"
                                                            style="height: 320px; width: 100%;"></canvas>
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
                                                <h4 class="card-title mb-4">ATENDIMENTO POR USUÁRIO</h4>

                                                @foreach ($atendimentos_usuarios as $usuario)
                                                    <div class="d-none usuario_nome">{{ $usuario->name }}</div>
                                                    <div class="d-none usuario_quantidade">{{ $usuario->quantidade }}</div>
                                                @endforeach

                                                <div id="usuario_titulo">

                                                    <div>
                                                        <canvas id="ChartAtendimentoUsuario"
                                                            style="height: 320px; width: 100%;"></canvas>
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
                                                        <canvas id="ChartTags" style="height: 320px; width: 100%;"></canvas>
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
                                                <h4 class="card-title mb-4">LEADS ANUAL</h4>
                                                @foreach ($leads as $led)
                                                    <div class="d-none leads_mes">{{ $led['mes'] }}</div>
                                                    <div class="d-none leads_total">{{ $led['total'] }}</div>
                                                @endforeach
                                                <canvas id="myChart" class="apex-charts" dir="ltr"
                                                    style="height: 320px; width: 100%;"></canvas>
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
