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
                        <h4 class="mb-0">Adicionar Cliente</h4>
                        <a href="/admin/clientes"><button class="bttn-material-flat bttn-md bttn-danger"><i
                                    class="ri-arrow-left-line"></i> </button></a>
                    </div>
                </div>
            </div>

            <div class="row box">
                <div class="col-md-8">
                    <div class="form-container">

                        <form id="form_add_cli">

                            <div class="row">

                                <div class="col-lg-6">
                                    <div class="mb-3">
                                        <label class="form-label" for="finalidade">Nome</label>
                                        <input type="text" class="form-control" id="nome" name="nome">
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="mb-3">
                                        <label class="form-label" for="fonte_renda">Sede</label>
                                        <select class="select_sedes" name="id_sedes[]" multiple>
                                            <?php foreach($sedes as $sede) : ?>
                                            <option value="{{ $sede->id_sede }}">{{ $sede->nome_sede }}</option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="mb-3">
                                        <label class="form-label" for="finalidade">Empreendimentos</label>
                                        <select class="select_empreendimentos" name="id_empreendimentos[]">

                                        </select>
                                    </div>
                                </div>
                           

                            </div>

                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="mb-3">
                                        <label class="form-label" for="finalidade">Telefone</label>
                                        <input type="text" class="form-control telefone" id="telefone" name="telefone">
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="mb-3">
                                        <label class="form-label" for="finalidade">Celular</label>
                                        <input type="text" class="form-control celular" id="celular" name="celular">
                                    </div>
                                </div>
                           

                            </div>

                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="mb-3">
                                        <label class="form-label" for="finalidade">Primeiro E-mail</label>
                                        <input type="mail" class="form-control" id="email1" name="email1">
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="mb-3">
                                        <label class="form-label" for="finalidade">Segundo E-mail</label>
                                        <input type="mail" class="form-control" id="email2" name="email2">
                                    </div>
                                </div>
                           

                            </div>


                           

                            <button type="button" id="btn_inserir_cliente" class="bttn-material-flat bttn-sm bttn-success ml-2">Salvar</button>


                        </form>
                    </div>
                </div>
            </div>





            {{-- END PAGE --}}
        </div>
    </div>
    <!-- end main content-->
    </div>

</x-app-layout>

@hasSection('page_add_cliente')
    @yield('page_add_cliente')
@endif
