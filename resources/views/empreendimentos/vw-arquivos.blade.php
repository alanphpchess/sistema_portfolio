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
                        <h4 class="mb-0">Pastas</h4>                        
                        <a href="{{ url()->previous() }}"><button class="bttn-material-flat bttn-md bttn-danger"><i
                            class="ri-arrow-left-line"></i> </button></a>
                    </div>
                </div>
            </div>


            <div class="row box">
                <div class="form-container">
                    <div class="btn-voltar">

                    </div>
                    <div class="col-md-12">

                        <div class="listas_pastas">
                            @foreach ($arquivos as $arquivo)
                                <div id="lista_pasta">
                                    <div class="pastas">
                                        <?php $extensao = pathinfo($arquivo->nome_original, PATHINFO_EXTENSION); ?>

                                        <?php $img_extensao = ['jpg', 'jpeg', 'png', 'gif', 'bmp']; ?>

                                        @if (in_array($extensao, $img_extensao))
                                            <a href="{{ asset($arquivo->url_img) }}" data-lightbox="img-arquivo-{{ $arquivo->id }}">
                                                <img alt="" src="{{ asset($arquivo->url_img) }}"
                                                    class="ext_img">
                                            </a>
                                        @else
                                            <img alt=""
                                                src="{{ asset('image/default/arquivos/' . $extensao . '.png') }}">
                                        @endif
                                    </div>
                                    <div class="pasta_descricao">
                                        <a href="/admin/empreendimentos/download/{{$arquivo->id}}" target="_blank">
                                            {{ $arquivo->nome }}
                                        </a>
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
