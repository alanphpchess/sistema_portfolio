<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Sistema</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- App favicon -->
    {{-- <link rel="shortcut icon" href="{{ asset('theme/images/favicon.ico') }}"> --}}

    <!-- Bootstrap Css -->
    <link href="{{ asset('theme/css/bootstrap.min.css') }}" id="bootstrap-style" rel="stylesheet" type="text/css" />
    <!-- Icons Css -->
    <link href=" {{ asset('theme/css/icons.min.css') }}" rel="stylesheet" type="text/css" />
    <!-- App Css-->
    <link href="{{ asset('theme/css/app.min.css') }}" id="app-style" rel="stylesheet" type="text/css" />
    <!-- Custom Css -->
    <link href="{{ asset('theme/css/custom.css') }}" rel="stylesheet" type="text/css" />

    <!-- animatedModal -->
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/animate.css/3.2.0/animate.min.css">

    {{-- DATATABLE --}}
    <link rel="stylesheet" href="https://cdn.datatables.net/2.0.1/css/dataTables.dataTables.css" />
    <link rel="stylesheet" href="https://cdn.datatables.net/rowreorder/1.5.0/css/rowReorder.dataTables.css" />

    <!-- Select2 -->
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

    <!-- GRID DATATABLE -->
    <link href="{{ asset('css/default/column-grid.css') }}" rel="stylesheet" />

    <!-- /// FORM STEP -->
    <link href="{{ asset('css/default/form-step.css') }}" rel="stylesheet" type="text/css" />
    <!-- /// FORM STEP -->
    {{-- <link href="{{ asset('css/default/boostrap.css') }}" rel="stylesheet" type="text/css" /> --}}

    <!-- Custom Uppy -->
    <link href="{{ asset('css/default/datatable.css') }}" rel="stylesheet" type="text/css" />

    <!-- Custom Uppy -->
    <link href="{{ asset('css/default/uppy.css') }}" rel="stylesheet" type="text/css" />

    <!-- Paginação -->
    <link href="{{ asset('css/default/paginacao.css') }}" rel="stylesheet" type="text/css" />

    <!-- Empreendimentos -->
    <link href="{{ asset('css/empreendimentos/pastas.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('css/notificacoes/notificacoes.css') }}" rel="stylesheet" type="text/css" />

    <!-- Clientes -->
    <link href="{{ asset('css/clientes/editar.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('css/clientes/card.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('css/dasboard/list.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('css/clientes/kanban/style.css') }}" rel="stylesheet" type="text/css" />
    <!-- Profile -->
    <link href="{{ asset('css/profile/profile.css') }}" rel="stylesheet" type="text/css" />
    <!-- Buttons -->
    <link href="{{ asset('css/default/buttons.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('css/default/search.css') }}" rel="stylesheet" type="text/css" />

    <!-- Grupo de Lista -->
    <link href="{{ asset('css/default/list-group.css') }}" rel="stylesheet" type="text/css" />

    <!-- Custom Badge -->
    <link href="{{ asset('css/default/badge.css') }}" rel="stylesheet" type="text/css" />

    <!-- Modal CSS -->
    <link href="{{ asset('css/default/modal_animated.css') }}" rel="stylesheet" type="text/css" />

    <!-- Tom Select -->
    <link href="{{ asset('css/default/tom-select.css') }}" rel="stylesheet" type="text/css" />

    <link href="{{ asset('library/easyPaginate/easypaginate.css') }}" rel="stylesheet" type="text/css" />

    <link href="https://transloadit.edgly.net/releases/uppy/v0.29.1/dist/uppy.min.css" rel="stylesheet">
    <!-- Scripts -->

    <!-- LIGHTBOX -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.4/css/lightbox.css"
        integrity="sha512-Woz+DqWYJ51bpVk5Fv0yES/edIMXjj3Ynda+KWTIkGoynAMHrqTcDUQltbipuiaD5ymEo9520lyoVOo9jCQOCA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    <link href="https://cdn.jsdelivr.net/gh/StephanWagner/jBox@v1.3.3/dist/jBox.all.min.css" rel="stylesheet">

    <!-- UNITEGALLERY -->
    <link rel="stylesheet" href="{{ asset('library/unitegallery/dist/css/unite-gallery.css') }}" rel="stylesheet"
        type="text/css" />

    {{-- BTTN --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bttn.css/0.2.4/bttn.min.css"
        integrity="sha512-/2285SnGiTHjSKBkJzedsJ8wwSP0j74ZQyusMQ9j5Z1RtyKqZ3XtfS8hVp8OadLs2uq+8V6/n+CyqUNTO/UpYg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    {{-- TOM SELECT --}}
    <link href="https://cdn.jsdelivr.net/npm/tom-select/dist/css/tom-select.css" rel="stylesheet">

    {{-- TABULADOR --}}
    <link href="https://unpkg.com/tabulator-tables@6.2.1/dist/css/tabulator.min.css" rel="stylesheet">

</head>

<body class="font-sans antialiased">
    <div class="min-h-screen bg-gray-100">
        @if (Route::currentRouteName() !== 'admin.clientes.editar')
            @include('layouts.navigation')
        @endif
        <main>
            {{ $slot }}
        </main>
    </div>

    {{-- / JS DO THEME --}}
    <script src="{{ asset('theme/libs/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('theme/libs/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('theme/libs/metismenu/metisMenu.min.js') }}"></script>
    <script src="{{ asset('theme/libs/simplebar/simplebar.min.js') }}"></script>
    <script src="{{ asset('theme/libs/node-waves/waves.min.js') }}"></script>
    <script src="{{ asset('theme/libs/jquery-sparkline/jquery.sparkline.min.js') }}"></script>
    <script src="https://maps.google.com/maps/api/js?key=AIzaSyCtSAR45TFgZjOs4nBFFZnII-6mMHLfSYI"></script>


    <!-- App js -->
    <script src="{{ asset('theme/js/app.js') }}"></script>
    <script src="{{ asset('theme/js/ajax.js') }}"></script>


    {{-- / JS DEFAULT --}}
    {{-- <script src="{{ asset('js/default/textarea.js?v=3') }}"></script> --}}

    {{-- xx SWEETALERT --}}
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    {{-- xx DATATABLE --}}
    <script src="https://cdn.datatables.net/2.0.5/js/dataTables.js"></script>
    <script src="https://cdn.datatables.net/select/2.0.1/js/dataTables.select.js"></script>
    <script src="https://cdn.datatables.net/select/2.0.1/js/select.dataTables.js"></script>
    <script src="https://cdn.datatables.net/fixedcolumns/5.0.0/js/dataTables.fixedColumns.js"></script>
    <script src="https://cdn.datatables.net/fixedcolumns/5.0.0/js/fixedColumns.dataTables.js"></script>
    <script src="https://cdn.datatables.net/rowreorder/1.5.0/js/rowReorder.dataTables.js"></script>

    {{-- xx ANIMATED MODAL --}}
    <script src="https://cdn.jsdelivr.net/npm/animatedmodal@1.0.0/animatedModal.min.js"></script>

    {{-- xx SORTABLE --}}
    <script src="https://cdn.jsdelivr.net/npm/sortablejs@1.15.2/Sortable.min.js"></script>

    {{-- xx LIGHTBOX --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.4/js/lightbox.min.js"
        integrity="sha512-Ixzuzfxv1EqafeQlTCufWfaC6ful6WFqIz4G+dWvK0beHw0NVJwvCKSgafpy5gwNqKmgUfIBraVwkKI+Cz0SEQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    {{-- xx LIGHTBOX --}}
    <script src="https://cdn.jsdelivr.net/gh/StephanWagner/jBox@v1.3.3/dist/jBox.all.min.js"></script>

    {{-- xx TABULATOR --}}
    <script type="text/javascript" src="https://unpkg.com/tabulator-tables@6.2.1/dist/js/tabulator.min.js"></script>


    {{-- xx PAGE DASHBOARD --}}

    @section('page_dashboard')
        {{-- xx CHART.JS --}}
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

        {{-- /   EXIBIÇÃO GRÁFICO --}}
        <script src="{{ asset('js/dashboard/graficos.js') }}"></script>
        <script src="{{ asset('js/dashboard/dashboard.js') }}"></script>

        {{-- / JS LIST COMPONENT DASHBOARD --}}
        <script src="{{ asset('js/dashboard/list-component.js') }}"></script>

        {{-- / SALVAR ITEM DASHBOARD --}}
        <script src="{{ asset('js/dashboard/salvar_item.js') }}"></script>

        {{-- / FILTRAR DASHBOARD --}}
        <script src="{{ asset('js/dashboard/filtrar_dashboard.js') }}"></script>

        {{-- / LIST PAGINAÇÃO --}}
        <script src="{{ asset('library/easyPaginate/jquery.easyPaginate.js') }}"></script>

        <script src="{{ asset('js/dashboard/list_paginate.js') }}"></script>
    @endsection


    {{-- xx PAGE EMPREENDIMENTOS --}}

    {{-- / EMPREENDIMENTO --}}
    @section('page_emp')
        {{-- / DATATABLE EMPREENDIMENTOS --}}
        <script src="{{ asset('js/empreendimentos/tabela_empreendimento.js') }}"></script>
        {{-- / EXCLUIR --}}
        <script src="{{ asset('js/empreendimentos/excluir.js') }}"></script>
    @endsection

    {{-- / EMAILS --}}
    @section('page_emails')
        {{-- / DATATABLE EMAILS --}}
        <script src="{{ asset('js/emails/tabela_emails.js') }}"></script>
        {{-- / EXCLUIR --}}
        <script src="{{ asset('js/emails/excluir.js') }}"></script>
        {{-- / ENCAMINHAR CLIENTE --}}
        <script src="{{ asset('js/emails/encaminhar_cliente.js') }}"></script>
        {{-- / DIRECIONAR CLIENTE --}}
        <script src="{{ asset('js/emails/btn-direcionar-cliente.js') }}"></script>
    @endsection

    {{-- / REDES SOCIAIS --}}
    @section('page_redes_sociais')
        {{-- / DATATABLE REDES SOCIAIS --}}
        <script src="{{ asset('js/redes_sociais/tabela_redes_sociais.js?v=3') }}"></script>
        {{-- / EXCLUIR --}}
        <script src="{{ asset('js/redes_sociais/excluir.js') }}"></script>
        {{-- / CLIENTES --}}
        <script src="{{ asset('js/redes_sociais/encaminhar_cliente.js') }}"></script>
        {{-- / EXCLUIR --}}
        <script src="{{ asset('js/redes_sociais/btn-direcionar-cliente.js') }}"></script>
    @endsection

    {{-- / PORTAIS --}}
    @section('page_portais')
        {{-- / DATATABLE PORTAIS --}}
        <script src="{{ asset('js/portais/tabela_portais.js') }}"></script>
        {{-- / EXCLUIR --}}
        <script src="{{ asset('js/portais/excluir.js') }}"></script>
        {{-- / ENCAMINHAR CLIENTE --}}
        <script src="{{ asset('js/portais/encaminhar_cliente.js') }}"></script>
        {{-- / ENCAMINHAR CLIENTE --}}
        <script src="{{ asset('js/portais/btn-direcionar-cliente.js') }}"></script>
        {{-- / ROLETA --}}
        <script src="{{ asset('js/portais/roleta.js') }}"></script>
    @endsection

    {{-- / ADICIONAR --}}
    @section('page_emp_editar')
        {{-- xx SELECT 2 --}}
        <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

        {{-- xx JQUERY MASK --}}
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js"
            integrity="sha512-pHVGpX7F/27yZ0ISY+VVjyULApbDlD0/X0rgGbTqCE7WFW5MezNTWG/dnhtbBuICzsd0WQPgpE4REBLv+UqChw=="
            crossorigin="anonymous" referrerpolicy="no-referrer"></script>
        {{-- xx TOM SELECT --}}
        <script src="https://cdn.jsdelivr.net/npm/tom-select/dist/js/tom-select.complete.min.js"></script>
        {{-- / CUSTOMIZAÇÃO DE TODOS SELECT --}}
        <script src="{{ asset('js/default/tom-select.js') }}"></script>

        {{-- / ADICIONAR --}}
        <script src="{{ asset('js/empreendimentos/adicionar.js') }}"></script>
        {{-- / BUSCA DE CEP --}}
        <script src="{{ asset('js/default/cep.js') }}"></script>
        {{-- / CUSTOMIZAÇÃO DE TODOS SELECT --}}
        <script src="{{ asset('js/default/select2.js') }}"></script>
        {{-- / MASK --}}
        <script src="{{ asset('js/default/jquery-mask.js') }}"></script>
    @endsection

    {{-- / EDITAR --}}
    @section('page_emp_add')
        {{-- xx SORTABLE --}}
        <script src="https://cdn.jsdelivr.net/npm/sortablejs@1.15.2/Sortable.min.js"></script>

        {{-- xx SELECT 2 --}}
        <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

        {{-- xx JQUERY MASK --}}
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js"
            integrity="sha512-pHVGpX7F/27yZ0ISY+VVjyULApbDlD0/X0rgGbTqCE7WFW5MezNTWG/dnhtbBuICzsd0WQPgpE4REBLv+UqChw=="
            crossorigin="anonymous" referrerpolicy="no-referrer"></script>

        {{-- / EDITAR --}}
        <script src="{{ asset('js/empreendimentos/editar.js') }}"></script>
        {{-- / BUSCA DE CEP --}}
        <script src="{{ asset('js/default/cep.js') }}"></script>
        {{-- / CUSTOMIZAÇÃO DE TODOS SELECT --}}
        <script src="{{ asset('js/default/select2.js') }}"></script>

        {{-- / MASK --}}
        <script src="{{ asset('js/default/jquery-mask.js') }}"></script>
    @endsection

    {{-- / ADD IMAGEM --}}
    @section('page_emp_add_img')
        {{-- xx UPPY --}}
        <script src="https://transloadit.edgly.net/releases/uppy/v0.29.1/dist/uppy.min.js"></script>
        <script src="{{ asset('js/empreendimentos/add_img.js') }}"></script>
    @endsection

    {{-- / GALERIA --}}
    @section('page_emp_galeria')
        <script src='{{ asset('library/unitegallery/dist/js/unitegallery.min.js') }}' type='text/javascript'></script>
        <script src='{{ asset('library/unitegallery/dist/themes/tiles/ug-theme-tiles.js') }}' type='text/javascript'></script>
        <script src="{{ asset('js/empreendimentos/galeria.js') }}"></script>
    @endsection

    {{-- / ARQUIVOS --}}
    @section('page_emp_arquivos')
        {{-- / DATATABLE EMPREENDIMENTOS --}}
        <script src="{{ asset('js/empreendimentos/tabela_emp_arquivo.js') }}"></script>
        {{-- xx UPPY --}}
        <script src="https://transloadit.edgly.net/releases/uppy/v0.29.1/dist/uppy.min.js"></script>
        <script src="{{ asset('js/empreendimentos/add_arquivos.js') }}"></script>
        <script src="{{ asset('js/empreendimentos/excluir_arquivos.js') }}"></script>
    @endsection

    {{-- / GERENCIAR PASTA --}}
    @section('page_emp_ger_pastas')
        {{-- / DATATABLE GERENCIAMENTO DE PASTAS --}}
        <script src="{{ asset('js/empreendimentos/tabela_cat_pastas.js') }}"></script>
        {{-- xx TOM SELECT --}}
        <script src="https://cdn.jsdelivr.net/npm/tom-select/dist/js/tom-select.complete.min.js"></script>
        {{-- / CUSTOMIZAÇÃO DE TODOS SELECT --}}
        <script src="{{ asset('js/default/tom-select.js') }}"></script>
        <script src="{{ asset('js/empreendimentos/adicionar_pasta.js') }}"></script>
        <script src="{{ asset('js/empreendimentos/editar_pasta.js') }}"></script>
        <script src="{{ asset('js/empreendimentos/excluir_pasta.js') }}"></script>
    @endsection

    @section('page_emp_ger_arquivos')
        {{-- xx UPPY --}}
        <script src="https://transloadit.edgly.net/releases/uppy/v0.29.1/dist/uppy.min.js"></script>
        <script src="{{ asset('js/empreendimentos/add_arquivos.js') }}"></script>
        <script src="{{ asset('js/empreendimentos/tabela_arquivos.js') }}"></script>
    @endsection


    {{-- xx PAGE CLIENTES --}}

    @section('page_clientes')
        {{-- xx SELECT 2 --}}
        <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
        {{-- xx TOM SELECT --}}
        <script src="https://cdn.jsdelivr.net/npm/tom-select/dist/js/tom-select.complete.min.js"></script>
        {{-- / DATATABLE CLIENTES --}}
        <script src="{{ asset('js/clientes/tabela_clientes.js') }}"></script>
        {{-- / DATATABLE CLIENTES STATUS --}}
        <script src="{{ asset('js/clientes/tabela_clientes_status.js') }}"></script>
        {{-- / MODAL CLIENTES --}}
        <script src="{{ asset('js/clientes/modal_clientes.js') }}"></script>
        {{-- / GERAR PDF --}}
        <script src="{{ asset('js/clientes/gerar_pdf.js') }}"></script>
        {{-- / EXCLUIR --}}
        <script src="{{ asset('js/clientes/excluir.js') }}"></script>
        {{-- / ESCOLHER QUAIS COLUNAS SERÃO VISIVEIS E OCULTADA --}}
        <script src="{{ asset('js/clientes/datatable_colunas.js') }}"></script>
        {{-- / FILTRO CLIENTES --}}
        <script src="{{ asset('js/clientes/filtrar_clientes.js') }}"></script>
        <script src="{{ asset('js/clientes/kanban/moment.min.js') }}"></script>
        {{-- / MODAL EVOLUÇÃO --}}
        <script src="{{ asset('js/clientes/modal_evolucao_geral.js') }}"></script>
        {{-- / Alt Status --}}
        <script src="{{ asset('js/clientes/alt_status.js') }}"></script>
        {{-- / CUSTOMIZAÇÃO DE TODOS SELECT --}}
        <script src="{{ asset('js/default/select2.js') }}"></script>
        <script src="{{ asset('js/clientes/inserir_cliente.js') }}"></script>

        {{-- / MODAL ANIMATED --}}
        <script src="{{ asset('js/clientes/modal_animated_cliente.js') }}"></script>


        <script src="https://cdnjs.cloudflare.com/ajax/libs/hammer.js/2.0.8/hammer.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/velocity/1.5.0/velocity.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/muuri/0.4.0/muuri.min.js"></script>


        <script src="{{ asset('js/clientes/kanban/scripts.js') }}"></script>
    @endsection

    @section('page_clientes_busca')
        {{-- / DATATABLE CLIENTES --}}
        <script src="{{ asset('js/clientes/tabela_clientes_busca.js') }}"></script>
        {{-- / MODAL CLIENTES --}}
        <script src="{{ asset('js/clientes/modal_clientes.js') }}"></script>
        {{-- / GERAR PDF --}}
        <script src="{{ asset('js/clientes/gerar_pdf.js') }}"></script>
        {{-- / EXCLUIR --}}
        <script src="{{ asset('js/clientes/excluir.js') }}"></script>
        {{-- / ESCOLHER QUAIS COLUNAS SERÃO VISIVEIS E OCULTADA --}}
        <script src="{{ asset('js/clientes/datatable_colunas.js') }}"></script>
        {{-- / FILTRO CLIENTES --}}
        <script src="{{ asset('js/clientes/filtrar_clientes.js') }}"></script>
    @endsection



    {{-- / ADD CLIENTE --}}
    @section('page_add_cliente')
        {{-- xx TOM SELECT --}}
        <script src="https://cdn.jsdelivr.net/npm/tom-select@2.4.1/dist/js/tom-select.complete.min.js"></script>
        {{-- / CUSTOMIZAÇÃO DE TODOS SELECT --}}
        <script src="{{ asset('js/default/select2.js') }}"></script>
        <script src="{{ asset('js/clientes/inserir_cliente.js') }}"></script>
        {{-- xx JQUERY MASK --}}
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js"
            integrity="sha512-pHVGpX7F/27yZ0ISY+VVjyULApbDlD0/X0rgGbTqCE7WFW5MezNTWG/dnhtbBuICzsd0WQPgpE4REBLv+UqChw=="
            crossorigin="anonymous" referrerpolicy="no-referrer"></script>
        <script src="{{ asset('js/default/jquery-mask.js') }}"></script>
    @endsection

    {{-- / ADD IMAGEM --}}
    @section('page_cli_add_img')
        {{-- xx UPPY --}}
        <script src="https://transloadit.edgly.net/releases/uppy/v0.29.1/dist/uppy.min.js"></script>
        <script src="{{ asset('js/clientes/add_img.js') }}"></script>
    @endsection

    {{-- / GALERIA --}}
    @section('page_cli_galeria')
        <script src='{{ asset('library/unitegallery/dist/js/unitegallery.min.js') }}' type='text/javascript'></script>
        <script src='{{ asset('library/unitegallery/dist/themes/tiles/ug-theme-tiles.js') }}' type='text/javascript'></script>
        <script src="{{ asset('js/clientes/galeria.js') }}"></script>
    @endsection

    {{-- / EDITAR --}}
    @section('page_cli_edit')
        {{-- xx SELECT 2 --}}
        <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
        {{-- / CUSTOMIZAÇÃO DE TODOS SELECT --}}
        <script src="{{ asset('js/default/select2.js') }}"></script>
        {{-- / MODAL EVOLUÇÃO --}}
        <script src="{{ asset('js/clientes/modal_evolucao_geral.js') }}"></script>
        {{-- / MODAL ADD TAG --}}
        <script src="{{ asset('js/clientes/modal_add_tag.js') }}"></script>
        {{-- / MODAL ADD FONTE --}}
        <script src="{{ asset('js/clientes/modal_add_fonte.js') }}"></script>
        {{-- / MODAL ADD ALERTA --}}
        <script src="{{ asset('js/clientes/modal_add_alerta.js') }}"></script>
        {{-- / MODAL EDITAR CLIENTE --}}
        <script src="{{ asset('js/clientes/modal_editar_cliente.js') }}"></script>
        {{-- / ADICIONAR STATUS EVOLUÇÃO --}}
        <script src="{{ asset('js/clientes/add_status.js') }}"></script>
        {{-- / ADICIONAR ADD TAG --}}
        <script src="{{ asset('js/clientes/add_tag.js') }}"></script>
        {{-- / ADICIONAR EXCLUIR TAG --}}
        <script src="{{ asset('js/clientes/excluir_tag.js') }}"></script>
        {{-- / ADICIONAR EXCLUIR ALERTA --}}
        <script src="{{ asset('js/clientes/excluir_alerta.js') }}"></script>
        {{-- / ADICIONAR MODAL CONTATO --}}
        <script src="{{ asset('js/clientes/modal_contatos.js') }}"></script>
        {{-- / EXCLUIR MODAL CONTATO --}}
        <script src="{{ asset('js/clientes/excluir_contato.js') }}"></script>
        {{-- / EDITAR MODAL CONTATO --}}
        <script src="{{ asset('js/clientes/modal_editar_contato.js') }}"></script>

        {{-- xx JQUERY MASK --}}
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js"
            integrity="sha512-pHVGpX7F/27yZ0ISY+VVjyULApbDlD0/X0rgGbTqCE7WFW5MezNTWG/dnhtbBuICzsd0WQPgpE4REBLv+UqChw=="
            crossorigin="anonymous" referrerpolicy="no-referrer"></script>
        <script src="{{ asset('js/default/cep_edit_cliente.js') }}"></script>
        {{-- / MASK --}}
        <script src="{{ asset('js/default/jquery-mask.js') }}"></script>
    @endsection

    {{-- / GERENCIAR PASTA --}}
    @section('page_cli_ger_pastas')
        {{-- / DATATABLE GERENCIAMENTO DE PASTAS --}}
        <script src="{{ asset('js/clientes/tabela_cat_pastas.js') }}"></script>
        {{-- xx SELECT 2 --}}
        <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
        {{-- / CUSTOMIZAÇÃO DE TODOS SELECT --}}
        <script src="{{ asset('js/default/tom-select.js') }}"></script>
        <script src="{{ asset('js/clientes/adicionar_pasta.js') }}"></script>
        <script src="{{ asset('js/clientes/editar_pasta.js') }}"></script>
        <script src="{{ asset('js/clientes/excluir_pasta.js') }}"></script>
    @endsection


    {{-- xx PAGE CONVITE --}}
    @section('page_convite')
        {{-- / DATATABLE CLIENTES --}}
        <script src="{{ asset('js/convite/tabela_convite.js') }}"></script>
        {{-- / Enviar convite --}}
        <script src="{{ asset('js/convite/enviar_convite.js') }}"></script>

        {{-- xx TOM SELECT --}}
        <script src="https://cdn.jsdelivr.net/npm/tom-select/dist/js/tom-select.complete.min.js"></script>
        {{-- / CUSTOMIZAÇÃO DE TODOS SELECT --}}
        <script src="{{ asset('js/default/tom-select.js') }}"></script>
    @endsection

    @section('page_equipe')
        {{-- / DATATABLE EQUIPE --}}
        <script src="{{ asset('js/equipe/tabela_equipe.js') }}"></script>
        {{-- / Enviar convite --}}
        <script src="{{ asset('js/equipe/enviar_equipe.js') }}"></script>
        <script src="{{ asset('js/equipe/tornar_adm.js') }}"></script>
        <script src="{{ asset('js/equipe/remover_adm.js') }}"></script>
    @endsection

    @section('page_sede')
        {{-- / DATATABLE SEDE --}}
        <script src="{{ asset('js/sede/tabela_sede.js') }}"></script>
        <script src="{{ asset('js/sede/add_sede.js') }}"></script>
        <script src="{{ asset('js/sede/editar_sede.js') }}"></script>
        <script src="{{ asset('js/sede/excluir_sede.js') }}"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js"
            integrity="sha512-pHVGpX7F/27yZ0ISY+VVjyULApbDlD0/X0rgGbTqCE7WFW5MezNTWG/dnhtbBuICzsd0WQPgpE4REBLv+UqChw=="
            crossorigin="anonymous" referrerpolicy="no-referrer"></script>
        <script src="{{ asset('js/default/jquery-mask.js') }}"></script>
        <script src="{{ asset('js/default/cep.js') }}"></script>
    @endsection

    @section('page_empresa')
        {{-- / DATATABLE SEDE --}}
        <script src="{{ asset('js/empresa/tabela_empresa.js') }}"></script>
        <script src="{{ asset('js/empresa/add_empresa.js') }}"></script>
        <script src="{{ asset('js/empresa/editar_empresa.js') }}"></script>
        <script src="{{ asset('js/empresa/excluir_empresa.js') }}"></script>
        <script src="{{ asset('js/empresa/ativar_empresa.js') }}"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js"
            integrity="sha512-pHVGpX7F/27yZ0ISY+VVjyULApbDlD0/X0rgGbTqCE7WFW5MezNTWG/dnhtbBuICzsd0WQPgpE4REBLv+UqChw=="
            crossorigin="anonymous" referrerpolicy="no-referrer"></script>
        <script src="{{ asset('js/default/jquery-mask.js') }}"></script>
        <script src="{{ asset('js/default/cep.js') }}"></script>
    @endsection

    @section('page_fontes')
        {{-- / DATATABLE SEDE --}}
        <script src="{{ asset('js/fontes/tabela_fontes.js') }}"></script>
        <script src="{{ asset('js/fontes/add_fontes.js') }}"></script>
        <script src="{{ asset('js/fontes/editar_fontes.js') }}"></script>
        <script src="{{ asset('js/fontes/excluir_fontes.js') }}"></script>
    @endsection

    @section('page_status')
        {{-- / DATATABLE STATUS --}}
        <script src="{{ asset('js/status/tabela_status.js') }}"></script>
        <script src="{{ asset('js/status/add_status.js') }}"></script>
        <script src="{{ asset('js/status/editar_status.js') }}"></script>
        <script src="{{ asset('js/status/excluir_status.js') }}"></script>
    @endsection

    @section('page_tags')
        {{-- / DATATABLE STATUS --}}
        <script src="{{ asset('js/tags/tabela_tags.js') }}"></script>
        <script src="{{ asset('js/tags/add_tags.js') }}"></script>
        <script src="{{ asset('js/tags/editar_tags.js') }}"></script>
        <script src="{{ asset('js/tags/excluir_tags.js') }}"></script>
    @endsection

    @section('cadastrar_empresa')
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js"
            integrity="sha512-pHVGpX7F/27yZ0ISY+VVjyULApbDlD0/X0rgGbTqCE7WFW5MezNTWG/dnhtbBuICzsd0WQPgpE4REBLv+UqChw=="
            crossorigin="anonymous" referrerpolicy="no-referrer"></script>
        {{-- / CEP --}}
        <script src="{{ asset('js/default/cep.js') }}"></script>
        {{-- / MASK --}}
        <script src="{{ asset('js/default/jquery-mask.js') }}"></script>
        <script src="{{ asset('js/equipe/inserir_empresa.js') }}"></script>
    @endsection

    {{-- xx PAGE CONTRATOS --}}
    @section('page_cadastro_compras')
        <script src="{{ asset('js/contratos/cadastro_compras/datatable.js') }}"></script>
        {{-- / CEP --}}
        <script src="{{ asset('js/default/cep.js') }}"></script>
        {{-- / MASK --}}
        <script src="{{ asset('js/default/jquery-mask.js') }}"></script>
    @endsection
    @section('page_add_cadastro_compras')
        {{-- xx SELECT 2 --}}
        <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
        {{-- / CUSTOMIZAÇÃO DE TODOS SELECT --}}
        <script src="{{ asset('js/default/select2.js') }}"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js"
            integrity="sha512-pHVGpX7F/27yZ0ISY+VVjyULApbDlD0/X0rgGbTqCE7WFW5MezNTWG/dnhtbBuICzsd0WQPgpE4REBLv+UqChw=="
            crossorigin="anonymous" referrerpolicy="no-referrer"></script>
        <script src="{{ asset('js/default/jquery-mask.js') }}"></script>
        <script src="{{ asset('js/contratos/cadastro_compras/adicionar.js') }}"></script>
        {{-- / CEP --}}
        <script src="{{ asset('js/default/cep.js') }}"></script>
    @endsection

    @section('perfil_usuario')
        {{-- / CEP --}}
        <script src="{{ asset('js/perfil/atualizar_perfil.js') }}"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js"
            integrity="sha512-pHVGpX7F/27yZ0ISY+VVjyULApbDlD0/X0rgGbTqCE7WFW5MezNTWG/dnhtbBuICzsd0WQPgpE4REBLv+UqChw=="
            crossorigin="anonymous" referrerpolicy="no-referrer"></script>
        {{-- / MASK --}}
        <script src="{{ asset('js/default/jquery-mask.js') }}"></script>
    @endsection

    @section('page_roleta')
        <script src="{{ asset('js/roleta/datatable_roleta.js') }}"></script>
        <script src="{{ asset('js/roleta/editar_roleta.js') }}"></script>
        <script src="{{ asset('js/roleta/atualizar_roleta.js') }}"></script>
        <script src="{{ asset('js/roleta/adicionar_roleta.js') }}"></script>
        <script src="{{ asset('js/roleta/excluir_roleta.js') }}"></script>
    @endsection
    @section('permissao_usuario')
        {{-- / CEP --}}
        <script src="{{ asset('js/perfil/permissao.js') }}"></script>
    @endsection

</body>

</html>
