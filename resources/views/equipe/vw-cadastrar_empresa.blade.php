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
                        <h4 class="mb-0">Cadastrar Empresa</h4>
                    </div>
                </div>

            </div>

            <div class="row box">
                <div class="col-md-8">
                    <div class="form-container">

                        <form id="form_add_empresa">

                            <div class="row">

                                <div class="col-lg-6">
                                    <div class="mb-3">
                                        <label class="form-label" for="nome">Nome</label>
                                        <input type="text" class="form-control" id="nome" name="nome">
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="mb-3">
                                        <label class="form-label" for="razao">E-mail</label>
                                        <input type="mail" class="form-control" id="email" name="email">
                                    </div>
                                </div>
                           

                            </div>

                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="mb-3">
                                        <label class="form-label" for="cnpj">CNPJ</label>
                                        <input type="text" class="form-control" id="cnpj" name="cnpj">
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="mb-3">
                                        <label class="form-label" for="razao">Razão</label>
                                        <input type="text" class="form-control" id="razao" name="razao">
                                    </div>
                                </div>
                           

                            </div>

                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="mb-3">
                                        <label class="form-label" for="telefone">Telefone</label>
                                        <input type="text" class="form-control" id="telefone" name="telefone">
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="mb-3">
                                        <label class="form-label" for="celular">Celular</label>
                                        <input type="text" class="form-control" id="celular" name="celular">
                                    </div>
                                </div>
                           

                            </div>



                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="mb-3">
                                        <label class="form-label" for="cep">CEP</label>
                                        <input type="text" class="form-control" id="cep" name="cep">
                                    </div>
                                </div>

                            </div>

                            <div class="row">
                                <div class="col-lg-8">
                                    <div class="mb-3">
                                        <label class="form-label" for="endereco">Endereço</label>
                                        <input type="text" class="form-control" id="endereco" name="endereco">
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="mb-3">
                                        <label class="form-label" for="numero">Número</label>
                                        <input type="text" class="form-control" id="numero" name="numero">
                                    </div>
                                </div>
      
                        
                            </div>
                            
                            <div class="row">
                                <div class="col-lg-4">
                                    <div class="mb-3">
                                        <label class="form-label" for="endereco">Bairro</label>
                                        <input type="text" class="form-control" id="bairro" name="bairro">
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="mb-3">
                                        <label class="form-label" for="cidade">Cidade</label>
                                        <input type="text" class="form-control" id="cidade" name="cidade">
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="mb-3">
                                        <label class="form-label" for="estado">Estado</label>
                                        <input type="text" class="form-control" id="estado" name="estado">
                                    </div>
                                </div>
      
                        
                            </div>


                           

                            <button type="button" id="btn_inserir_empresa" class="bttn-material-flat bttn-sm bttn-success ml-2">Salvar</button>


                        </form>
                    </div>
                </div>
            </div>




            {{-- @include('clientes.modals.modal-add-img') --}}



            {{-- END PAGE --}}
        </div>
    </div>
    <!-- end main content-->
    </div>

{{-- 
    @include('convite.modals.modal-convite'); --}}
</x-app-layout>


@hasSection('cadastrar_empresa')
    @yield('cadastrar_empresa')
@endif
