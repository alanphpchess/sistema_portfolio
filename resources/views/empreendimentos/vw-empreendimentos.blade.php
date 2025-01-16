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
                        <h4 class="mb-0">Empreendimentos</h4>


                    </div>
                </div>
            </div>

            <div class="row">
                <div class="card">
                    <div class="card-body">
                        <div class="col-md-12">
                            <div class="row">
                                {{-- @if (isset($permissoes['funcao_add_emp']) && $permissoes['funcao_add_emp'] == 'true' && empty($user_admin) || !empty($user_admin)) --}}
                                    <div class="col-md-2">
                                        <a href="/admin/empreendimentos/adicionar">
                                            <button
                                                class="bttn-material-flat bttn-sm bttn-success btn-w-100 mb-5 mt-2">ADICIONAR</button>
                                        </a>
                                    </div>
                                {{-- @endif --}}
                            </div>
                        </div>
                        <div class="col-12">

                            <input type="text" id="search-input" class="search" placeholder="Pesquisar">
                            <table id="tabelaEmpreendimento" class="display nowrap" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>Código</th>
                                        <th>Empreendimento</th>
                                        <th>Sede</th>
                                        <th>Nome</th>
                                        <th>Imagens</th>
                                        <th>Arquivos</th>
                                        <th>Endereço</th>
                                        <th>Cidade</th>
                                        <th>Estado</th>
                                        <th>CEP</th>
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



            @include('empreendimentos.modals.modal-add-img')



            {{-- END PAGE --}}
        </div>
    </div>
    <!-- end main content-->
    </div>



</x-app-layout>


@hasSection('page_emp')
    @yield('page_emp')
@endif
