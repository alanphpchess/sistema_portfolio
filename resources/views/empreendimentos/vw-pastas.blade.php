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
                        <h4 class="mb-0">Pastas</h4> <a href="/admin/empreendimentos"><button
                                class="bttn-material-flat bttn-md bttn-danger"><i class="ri-arrow-left-line"></i>
                            </button></a>
                    </div>
                </div>
            </div>


            <div class="row box">
                <div class="form-container">

                    <div class="col-md-12">
                        <div class="row">
                            {{-- @if (isset($permissoes['funcao_gerenciar_arquivos_emp']) && $permissoes['funcao_gerenciar_arquivos_emp'] == 'true' && empty($user_admin) || !empty($user_admin)) --}}
                                <div class="col-md-2">
                                    <a href="/admin/empreendimentos/pastas/gerenciamento/{{ $id_empreendimento }}">
                                        <button class="bttn-material-flat bttn-sm bttn-success btn-w-100 mb-5 mt-2"
                                            data-bs-toggle="modal" data-bs-target="#ModalAddPasta">GERENCIAR</button>
                                    </a>
                                </div>
                            {{-- @endif --}}
                        </div>
                    </div>
                    <div class="col-md-12">

                        <div class="listas_pastas">
                            @foreach ($grupos_pastas as $grupo_pasta)
                                <div id="lista_pasta">
                                    <div class="pastas">
                                        <div>
                                            <img alt="" src="{{ asset($grupo_pasta->pasta->url) }}" />
                                        </div>
                                        <p>
                                            <a href="/admin/empreendimentos/pastas/arquivos/{{ $grupo_pasta->id }}">
                                                {{ $grupo_pasta->nome }}
                                            </a>
                                        </p>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        <div class="pagination custom-pagination">
                            {{ $paginacao->links() }}
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

</x-app-layout>

@hasSection('page_emp_galeria')
    @yield('page_emp_galeria')
@endif
