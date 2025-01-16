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
                        <h4 class="mb-0">Galeria</h4>
                        <a href="/admin/clientes"><button class="bttn-material-flat bttn-md bttn-danger"><i
                                    class="ri-arrow-left-line"></i> </button></a>
                    </div>
                </div>
            </div>


            <div class="row box">
                <div class="form-container">
                    <div class="col-md-12">
                        <div id="galeria">
                            @foreach ($imagens as $imagem)
                                <a href="{{ asset($imagem->url_img) }}">
                                    <img alt="" src="{{ asset($imagem->url_img) }}"
                                        data-image="{{ asset($imagem->url_img) }}" data-description=""
                                        style="display:none">
                                </a>
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

@hasSection('page_cli_galeria')
    @yield('page_cli_galeria')
@endif
