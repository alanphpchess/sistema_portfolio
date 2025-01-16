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
                        <h4 class="mb-0">Gerenciamento de Pastas </h4>
                        <a href="/admin/empreendimentos/pastas/{{$id_empreendimento}}"><button class="bttn-material-flat bttn-md bttn-danger"><i
                            class="ri-arrow-left-line"></i> </button></a>
                    </div>
                </div>
            </div>


            <div class="row box">
                <div class="form-container">
                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-md-2">
                                <button class="bttn-material-flat bttn-sm bttn-success btn-w-100 mb-2" data-bs-toggle="modal" data-bs-target="#ModalAddPasta">ADICIONAR</button>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12">


                        <input type="text" id="search-emp-ger-pasta" class="search" placeholder="Pesquisar">
                        <table id="tabelaGerPasta" class="display nowrap" style="width:100%">
                            <thead>
                                <tr>
                                    <th>Código</th>
                                    <th>Pasta</th>
                                    <th>Arquivos</th>
                                    <th>Nome</th>
                                    <th>Descrição</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- END PAGE --}}
    </div>
    </div>
    <!-- end main content-->
    </div>

    @include('empreendimentos.modals.modal-add-pasta')
    @include('empreendimentos.modals.modal-edit-pasta')


</x-app-layout>

@hasSection('page_emp_ger_pastas')
    @yield('page_emp_ger_pastas')
@endif
