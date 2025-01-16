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
                        <h4 class="mb-0">Leads</h4>


                    </div>
                </div>
            </div>

            <div class="row">
                <div class="card">
                    <div class="card-body">
                        <div class="col-md-12">
                            <div class="row">

                            </div>
                        </div>
                        <div class="col-12">

                            <input type="text" id="search-input" class="search" placeholder="Pesquisar">
                            <table id="tabelaEmails" class="display nowrap" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>Data</th>
                                        <th>Código</th>
                                        <th>E-mail</th>
                                        <th>Usuário</th>
                                        <th>Telefone</th>
                                        <th>Mensagem</th>
                                        <th>Empreendimento</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div> <!-- end col -->
            </div> <!-- end row -->

            {{-- END PAGE --}}
        </div>
    </div>
    <!-- end main content-->
    </div>



</x-app-layout>

@include('lead_emails.modals.modal-encaminhar-usuario');

@hasSection('page_emails')
    @yield('page_emails')
@endif
