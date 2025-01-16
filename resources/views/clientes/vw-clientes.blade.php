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



                <div class="col-md-2 ">
                    <div class="card-body">
                        <h5 class="card-title"
                            style="width: 100%; background: white;border: 1px solid rgb(209 201 201);text-align:center;padding:8px 0px;color:rgb(87 87 87)">
                            <i class="fas fa-user-friends" style="font-size: 21px;"></i> <span class="fw-bold"
                                style="font-size:17px;">{{ $clientes_total }}</span>
                        </h5>

                    </div>
                </div>


                @if (in_array('funcao_add_cliente', $permissoes))
                    <div class="col-md-2">

                        <button class="bttn-material-flat bttn-sm bttn-success w-100" data-bs-toggle="modal"
                            data-bs-target="#ModalAddCliente"><i class="fas fa-user-plus"></i>
                            Adicionar</button>

                    </div>
                @endif
                @if (in_array('funcao_filtro_cliente', $permissoes))
                    <div class="col-md-2">
                        <button class="bttn-material-flat bttn-sm bttn-primary btn-w-100" data-bs-toggle="modal"
                            data-bs-target="#ModalFiltroCliente"><i class="fas fa-filter"></i> FILTRO</button>
                    </div>
                @endif
            </div>
            <div class="row" style="">
                {{-- <div class="">
                    <div class="card mb-3" style="max-width: 240px;">
                        <div class="row g-0">
                            <div class="col-md-4 card_icon"><i class="fas fa-exclamation-circle"
                                    style="font-size: 2.5rem"></i>
                            </div>
                            <div class="col-md-8">
                                <div class="card-body">
                                    <h5 class="card-title fw-bold" >SEM STATUS</h5>
                                    <p class="card-text fs-3" style="text-align: center" id="qnt_sem_status">{{ $clientesSemStatus }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div> --}}
                @if (in_array('funcao_total_cliente', $permissoes))
                @endif

            </div>



            <div class="kanban-container">
                <div class="kanban">
                    @foreach ($todos_status as $st)
                        <div class="column" id="column-{{ $st->id_status }}">
                            <div class="column-title"
                                style="color: white; background: {{ $st->cor }};font-weight:bold">
                                {{ $st->titulo_status }}</div>
                            <div class="tasks" id="tasks-todo" data-id_task="{{ $st->id_status }}">
                                @foreach ($clientes as $cliente)
                                    @if ($st->id_status == $cliente->status_id_status)
                                        @php

                                            // Remove +55 ou 55 do início
                                            $phone = preg_replace('/^\+55|^55/', '', $cliente->telefone1_cliente);
                                            // Remove caracteres não numéricos
                                            $phone = preg_replace('/\D/', '', $phone);
                                        @endphp
                                        <div class="task" draggable="true"
                                            data-ordem_kanban="{{ $cliente->id_cliente }}">

                                            <p>{!! !empty($cliente->empreendimentos)
                                                ? '<b>Empreendimento:</b> ' . $cliente->empreendimentos->nome_empreendimento
                                                : '' !!}</p>
                                            <p><b>Nome:</b> {{ mb_strimwidth($cliente->nome_cliente, 0, 30, '...') }}
                                            </p>
                                            <p><b>E-mail:</b> <a
                                                    href="mailto:{{ $cliente->email1_cliente }}">{{ substr($cliente->email1_cliente, 0, 30) }}</a>
                                            </p>
                                            <p><b>Telefone:</b> <a href="https://wa.me/55{{ $phone }}"
                                                    target="_blank">{{ $cliente->telefone1_cliente }}</a></p>
                                            <p>{!! !empty($cliente->fontes) ? '<b>Fontes:</b> ' . $cliente->fontes->titulo_fonte : '' !!}</p>

                                            <div
                                                style="display: flex; gap-column:10px;justify-content: center;column-gap: 10px;">
                                                <a href="/admin/clientes/editar/{{ $cliente->id_cliente }}"
                                                    target="_blank" class="bttn-material-flat bttn-xs bttn-primary">
                                                    VISUALIZAR</a>
                                                <a href="javascript:void(0);"
                                                    class="link_alt_status bttn-material-flat bttn-xs bttn-success "
                                                    data-cliente="{{ $cliente->id_cliente }}">Alterar Status</a>
                                            </div>
                                        </div>
                                    @endif
                                @endforeach

                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

            {{-- <div>
                <input type="text" id="taskInputTodo" placeholder="Nova tarefa">
                <button onclick="addTask('todo')">Adicionar</button>
                <input type="text" id="newColumnInput" placeholder="Nome da nova coluna">
                <button onclick="addColumn()">Adicionar Coluna</button>
            </div> --}}


            <div class="card_cliente mt-4" style="">
                {{-- <div class="">
                    <div class="card mb-3" style="max-width: 240px;">
                        <div class="row g-0">
                            <div class="col-md-4 card_icon"><i class="fas fa-exclamation-circle"
                                    style="font-size: 2.5rem"></i>
                            </div>
                            <div class="col-md-8">
                                <div class="card-body">
                                    <h5 class="card-title fw-bold" >SEM STATUS</h5>
                                    <p class="card-text fs-3" style="text-align: center" id="qnt_sem_status">{{ $clientesSemStatus }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div> --}}

            </div>

            @if (in_array('tabela_cliente', $permissoes))
                <div class="row">
                    <div class="card">
                        <div class="card-body">
                            <div class="col-md-12">
                                <div class="row">
                                    <div class="col-4">
                                        {{-- @if (in_array('funcao_coluna_tabela', $permissoes)) --}}

                                        <button type="button" data-bs-toggle="modal"
                                            data-bs-target="#ClientescustomGridModal"
                                            class="bttn-material-flat bttn-xs bttn-success">
                                            <i class="fas fa-th"></i> Visualização

                                        </button>
                                        {{-- @endif --}}
                                    </div>
                                    <div class="col-4">
                                    </div>
                                    <div class="col-4 mb-4">

                                    </div>
                                </div>

                            </div>
                            <div class="col-12">

                                <input type="text" id="search-input_clientes" class="search" placeholder="Pesquisar">


                                <table id="tabelaClientes" class="display nowrap" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th>
                                                <input type="checkbox" class="check-all_database" value="1">
                                            </th>
                                            <th>Data do Registro</th>
                                            <th>Data de Atualização</th>
                                            <th>Status</th>
                                            <th>Cliente</th>
                                            <th>Corretor</th>
                                            <th>Sede</th>
                                            <th>Empreendimento</th>
                                            <th>Fonte</th>
                                            <th>Telefone</th>
                                            <th>TAG</th>
                                            {{-- <th>Documentos</th> --}}
                                            <th>Email</th>
                                            <th>Ação</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th></th>
                                            <th></th>
                                            <th></th>
                                            <th></th>
                                            <th> </th>
                                            <th></th>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                    </div> <!-- end col -->
                </div> <!-- end row -->
            @endif



            <!--animate_modal_cliente-->
            <a id="animate_modal_cliente" href="#animatedModal" class="link_teste"></a>
        </div>


        {{-- END PAGE --}}
    </div>
    </div>
    <!-- end main content-->
    </div>




    @include('clientes.modals.modal-clientes');
    @include('clientes.modals.modal-dt-colunas');
    @include('clientes.modals.modal-filtro-cliente');
    @include('clientes.modals.modal-alt-status');
    @include('clientes.modals.modal-add-cliente');
    @include('clientes.modal_animated.ma_clientes');

</x-app-layout>

@hasSection('page_clientes')
    @yield('page_clientes')
@endif
