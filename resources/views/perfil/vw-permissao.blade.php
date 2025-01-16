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
                        <h4 class="mb-0">Perfil de Usuário</h4>
                    </div>
                </div>
                <div class="col-4">

                </div>

            </div>
            <div id="id_usuario" data-target="{{ $id_usuario }}"></div>

            <div class="row">
                <div class="col-md-12">
                    <section class="vh-100" style="background-color: #f4f5f7;">
                        <div class="container h-100">
                            <div class="row d-flex justify-content-center h-100">
                                <div class="col col-lg-12 mb-4 mb-lg-0">
                                    <div class="card mb-3" style="border-radius: .5rem;">
                                        <div class="row g-0">
                                            <div class="col-md-8 gradient-custom text-center text-white"
                                                style="border-top-left-radius: .5rem; border-bottom-left-radius: .5rem;">

                                                <ul class="nav nav-tabs" id="myTab" role="tablist">
                                                    <li class="nav-item" role="presentation">
                                                        <button class="nav-link active" id="clientes-tab"
                                                            data-bs-toggle="tab" data-bs-target="#clientes" type="button"
                                                            role="tab" aria-controls="clientes"
                                                            aria-selected="true">Clientes</button>
                                                    </li>
                                                    <li class="nav-item" role="presentation">
                                                        <button class="nav-link" id="empreendimento-tab" data-bs-toggle="tab"
                                                            data-bs-target="#empreendimento" type="button" role="tab"
                                                            aria-controls="empreendimento"
                                                            aria-selected="false">Empreendimento</button>
                                                    </li>
                                                    {{-- <li class="nav-item" role="presentation">
                                                        <button class="nav-link" id="contact-tab" data-bs-toggle="tab"
                                                            data-bs-target="#contact" type="button" role="tab"
                                                            aria-controls="contact"
                                                            aria-selected="false">Empresas</button>
                                                    </li> --}}
                                                </ul>
                                                <div class="tab-content" id="myTabContent" style="padding:20px">
                                                    <div class="tab-pane fade show active" id="clientes"
                                                        role="tabpanel" aria-labelledby="clientes-tab">
                                                        <div class="form-check form-switch" style="color: black">
                                                            <input class="form-check-input" type="checkbox"
                                                                id="pagina_cliente" {{ isset($permissao['pagina_cliente']) && $permissao['pagina_cliente'] == 'true' ? 'checked' : '' }}>
                                                            <label class="form-check-label"
                                                                for="flexSwitchCheckDefault">Página Cliente</label>
                                                        </div>
                                                        <div class="form-check form-switch" style="color: black">
                                                            <input class="form-check-input" type="checkbox"
                                                                id="funcao_add_cliente" {{ isset($permissao['funcao_add_cliente']) && $permissao['funcao_add_cliente'] == 'true' ? 'checked' : '' }}>
                                                            <label class="form-check-label"
                                                                for="flexSwitchCheckDefault">Função Adicionar</label>
                                                        </div>
                                                        <div class="form-check form-switch" style="color: black">
                                                            <input class="form-check-input" type="checkbox"
                                                                id="funcao_filtro_cliente" {{ isset($permissao['funcao_filtro_cliente']) && $permissao['funcao_filtro_cliente'] == 'true' ? 'checked' : '' }}>
                                                            <label class="form-check-label"
                                                                for="flexSwitchCheckChecked" >Função Filtro</label>
                                                        </div>
                                                        <div class="form-check form-switch" style="color: black">
                                                            <input class="form-check-input" type="checkbox"
                                                                id="funcao_total_cliente" {{ isset($permissao['funcao_total_cliente']) && $permissao['funcao_total_cliente'] == 'true' ? 'checked' : '' }}>
                                                            <label class="form-check-label"
                                                                for="flexSwitchCheckChecked" >Função Total Cliente</label>
                                                        </div>
                                                        <div class="form-check form-switch" style="color: black">
                                                            <input class="form-check-input" type="checkbox"
                                                                id="funcao_coluna_tabela_cliente" {{ isset($permissao['funcao_coluna_tabela']) && $permissao['funcao_coluna_tabela'] == 'true' ? 'checked' : '' }}>
                                                            <label class="form-check-label"
                                                                for="flexSwitchCheckChecked" >Visualização de Tabela</label>
                                                        </div>
                                                        <div class="form-check form-switch" style="color: black">
                                                            <input class="form-check-input" type="checkbox"
                                                                id="funcao_edit_cliente" {{ isset($permissao['funcao_edit_cliente']) && $permissao['funcao_edit_cliente'] == 'true' ? 'checked' : '' }}>
                                                            <label class="form-check-label"
                                                                for="flexSwitchCheckChecked" >Função Editar Cliente</label>
                                                        </div>
                                                        <div class="form-check form-switch" style="color: black">
                                                            <input class="form-check-input" type="checkbox"
                                                                id="funcao_excluir_cliente" {{ isset($permissao['funcao_excluir_cliente']) && $permissao['funcao_excluir_cliente'] == 'true' ? 'checked' : '' }}>
                                                            <label class="form-check-label"
                                                                for="flexSwitchCheckChecked" >Função Excluir Cliente</label>
                                                        </div>
                                                        <div class="form-check form-switch" style="color: black">
                                                            <input class="form-check-input" type="checkbox"
                                                                id="tabela_cliente" {{ isset($permissao['tabela_cliente']) && $permissao['tabela_cliente'] == 'true' ? 'checked' : '' }}>
                                                            <label class="form-check-label"
                                                                for="flexSwitchCheckChecked" >Tabela Cliente</label>
                                                        </div>


                                                    </div>
                                                    <div class="tab-pane fade" id="empreendimento" role="tabpanel"
                                                        aria-labelledby="empreendimento-tab">
                                                        <div class="form-check form-switch" style="color: black">
                                                            <input class="form-check-input" type="checkbox"
                                                                id="funcao_add_emp" {{ isset($permissao['funcao_add_emp']) && $permissao['funcao_add_emp'] == 'true' ? 'checked' : '' }}>
                                                            <label class="form-check-label"
                                                                for="flexSwitchCheckDefault">Função Adicionar Empreendimento</label>
                                                        </div>
                                                        <div class="form-check form-switch" style="color: black">
                                                            <input class="form-check-input" type="checkbox"
                                                                id="funcao_gerenciar_arquivos_emp" {{ isset($permissao['funcao_gerenciar_arquivos_emp']) && $permissao['funcao_gerenciar_arquivos_emp'] == 'true' ? 'checked' : '' }}>
                                                            <label class="form-check-label"
                                                                for="flexSwitchCheckDefault">Função Gerenciar Arquivos</label>
                                                        </div>
                                                        <div class="form-check form-switch" style="color: black">
                                                            <input class="form-check-input" type="checkbox"
                                                                id="funcao_adicionar_imagens_emp" {{ isset($permissao['funcao_adicionar_imagens_emp']) && $permissao['funcao_adicionar_imagens_emp'] == 'true' ? 'checked' : '' }}>
                                                            <label class="form-check-label"
                                                                for="flexSwitchCheckDefault">Função Adicionar Imagens</label>
                                                        </div>
                                                        <div class="form-check form-switch" style="color: black">
                                                            <input class="form-check-input" type="checkbox"
                                                                id="funcao_edit_emp" {{ isset($permissao['funcao_edit_emp']) && $permissao['funcao_edit_emp'] == 'true' ? 'checked' : '' }}>
                                                            <label class="form-check-label"
                                                                for="flexSwitchCheckDefault">Função Editar Empreendimento</label>
                                                        </div>
                                                        <div class="form-check form-switch" style="color: black">
                                                            <input class="form-check-input" type="checkbox"
                                                                id="funcao_excluir_emp" {{ isset($permissao['funcao_excluir_emp']) && $permissao['funcao_excluir_emp'] == 'true' ? 'checked' : '' }}>
                                                            <label class="form-check-label"
                                                                for="flexSwitchCheckDefault">Função Excluir Empreendimento</label>
                                                        </div>
                                                    </div>
                                                    <div class="tab-pane fade" id="contact" role="tabpanel"
                                                        aria-labelledby="contact-tab">

                                                    </div>
                                                </div>




                                            </div>
                                            <div class="col-md-4">

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                </div>
            </div>

            {{-- END PAGE --}}
        </div>
    </div>
    <!-- end main content-->
    </div>


</x-app-layout>


@hasSection('permissao_usuario')
    @yield('permissao_usuario')
@endif
