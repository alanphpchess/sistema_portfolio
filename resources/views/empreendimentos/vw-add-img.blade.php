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
                        <h4 class="mb-0">Adicionar Imagem </h4>
                        <a href="/admin/empreendimentos"><button class="bttn-material-flat bttn-md bttn-danger"><i
                            class="ri-arrow-left-line"></i> </button></a>
                    </div>
                </div>
            </div>


            <div class="row box">
                <div class="col-md-4">
                    <div class="form-container">
                        <h5 class="modal-title mt-0" id="AddImgEmpModalTitle">Imagem Principal</h5>
                        <hr />
                        <div id="id_empreendimento" data-target="{{ $id_empreendimento }}"></div>

                        <div >
                            <div id="upload_img">
                            </div>
                        </div>



                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-container">
                        <h5 class="modal-title mt-0" id="AddImgEmpModalTitle">Imagens do Empreendimento</h5>
                        <hr />
                        <div id="id_empreendimento" data-target="{{ $id_empreendimento }}"></div>



                        <div class="flex mt-2 justify-center h-screen">
                            <div id="upload_img_principal">
                            </div>
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

@hasSection('page_emp_add_img')
    @yield('page_emp_add_img')
@endif
