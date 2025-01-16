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
                    <button type="button" data-bs-toggle="modal" data-bs-target="#EditarPerfilModal"
                        class="bttn-material-flat bttn-xs bttn-success btn-grid-column">
                        Editar
                        <i class="fa-regular fa-pen-to-square"></i>
                    </button>
                </div>

            </div>

            <div class="row">
                <div class="col-md-12">
                    <section class="vh-100" style="background-color: #f4f5f7;">
                        <div class="container h-100">
                            <div class="row d-flex justify-content-center h-100">
                                <div class="col col-lg-12 mb-4 mb-lg-0">
                                    <div class="card mb-3" style="border-radius: .5rem;">
                                        <div class="row g-0">
                                            <div class="col-md-4 gradient-custom text-center text-white"
                                                style="border-top-left-radius: .5rem; border-bottom-left-radius: .5rem;">
                                                <img src="{{ asset('upload/img_perfil/'.$user['id'].'/' . $user['img_perfil'].'') }}"
                                                    alt="Avatar" class="img-fluid mt-5 mb-1" style="width: 80px;" />
                                                <h5 id="usuario">{{ $user['name'] }}</h5>
                                                <i class="far fa-edit mb-5"></i>
                                            </div>
                                            <div class="col-md-8">
                                                <div class="card-body p-4">
                                                    <h6>Informações</h6>
                                                    <hr class="mt-0 mb-4">
                                                    <div class="row pt-1">
                                                        <div class="col-6 mb-3">
                                                            <h6>Email</h6>
                                                            <p class="text-muted">{{ $user['email'] }}</p>
                                                        </div>
                                                        <div class="col-6 mb-3">
                                                            <h6>Telefone</h6>
                                                            <p class="text-muted">{{ $user['telefone'] }}</p>
                                                        </div>
                                                        <div class="col-12 mb-3">
                                                            <h6>Permissão</h6>
                                                            <p class="text-muted">
                                                                <?php if($user['permissao'] == 'Administrador'): ?>
                                                                <p class="text-muted">Administrador</p>
                                                                <?php else: ?>
                                                                <p class="text-muted">Padrão</p>
                                                                <?php endif;  ?>

                                                            </p>
                                                        </div>
                                                        <div class="col-6 mb-3">
                                                            <h6>CPF</h6>
                                                            <p class="text-muted">{{ $user['cpf'] }}</p>
                                                        </div>
                                                        <div class="col-6 mb-3">
                                                            <h6>CRECI</h6>
                                                            <p class="text-muted">{{ $user['creci'] }}</p>
                                                        </div>
                                                        <div class="col-6 mb-3">
                                                            <h6>Telefone</h6>
                                                            <p class="text-muted">{{ $user['telefone'] }}</p>
                                                        </div>
                                                        <div class="col-6 mb-3">
                                                            <h6>Celular</h6>
                                                            <p class="text-muted">{{ $user['celular'] }}</p>
                                                        </div>
                                                        <div class="col-12 mb-3">
                                                            <h6>CEP</h6>
                                                            <p class="text-muted">{{ $user['cep'] }}</p>
                                                        </div>
                                                        <div class="col-6 mb-3">
                                                            <h6>Logradouro</h6>
                                                            <p class="text-muted">{{ $user['logradouro'] }}</p>
                                                        </div>
                                                        <div class="col-6 mb-3">
                                                            <h6>Número</h6>
                                                            <p class="text-muted">{{ $user['numero'] }}</p>
                                                        </div>
                                                        <div class="col-6 mb-3">
                                                            <h6>Cidade</h6>
                                                            <p class="text-muted">{{ $user['cidade'] }}</p>
                                                        </div>
                                                        <div class="col-6 mb-3">
                                                            <h6>Estado</h6>
                                                            <p class="text-muted">{{ $user['estado'] }}</p>
                                                        </div>
                                                    </div>
                                                </div>
        
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


    @include('perfil.modals.modal-editar_perfil'); 
</x-app-layout>


@hasSection('perfil_usuario')
    @yield('perfil_usuario')
@endif
