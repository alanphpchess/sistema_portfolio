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
                <div class="col-8">
                    <div class="page-title-box d-flex align-items-center justify-content-between">
                        <h4 class="mb-0">Clientes</h4>
                    </div>
                </div>
                <div class="col-4">
                    <button type="button" data-bs-toggle="modal" data-bs-target="#ClientescustomGridModal"
                        class="bttn-material-flat bttn-xs bttn-success btn-grid-column">
                        Visualização
                        <i class="fas fa-th"></i>
                    </button>
                </div>
            </div>

            <div class="row">
                <div class="card">
                    <div class="card-body">
                        <div class="col-md-12">
                            <div class="row">
                                <div class="col-md-2">
                                    <a href="/admin/clientes/adicionar">
                                        <button
                                            class="bttn-material-flat bttn-sm bttn-success btn-w-100 mb-5 mt-2">ADICIONAR</button>
                                    </a>
                                </div>
                                <div class="col-md-2">
                           
                                        <button
                                            class="bttn-material-flat bttn-sm bttn-success btn-w-100 mb-5 mt-2" data-bs-toggle="modal" data-bs-target="#ModalFiltroCliente">FILTRO</button>
                                
                                </div>
                            </div>
                        </div>
                        <div class="col-12">



                            
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
                                        <th>Empreendimento</th>
                                        <th>Telefone</th>
                                        <th>Fonte</th>
                                        <th>TAG</th>
                                        <th>Documentos</th>
                                        <th>Email</th>
                                        <th></th>
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



            {{-- @include('clientes.modals.modal-add-img') --}}



            {{-- END PAGE --}}
        </div>
    </div>
    <!-- end main content-->
    </div>


    @include('clientes.modals.modal-clientes');
    @include('clientes.modals.modal-dt-colunas');
    @include('clientes.modals.modal-filtro-cliente')

</x-app-layout>


@hasSection('page_clientes_busca')
    @yield('page_clientes_busca')
@endif
