<body data-sidebar="dark">

    <!-- Begin page -->
    <div id="layout-wrapper">

        <header id="page-topbar">
            <div class="navbar-header">
                <div class="d-flex">
                    <!-- LOGO -->
                    <div class="navbar-brand-box">
                        <a href="index.html" class="logo logo-dark">
                            <span class="logo-sm">
                                <img src="{{ asset('theme/images/logo-sm-dark.png') }}" alt="logo-sm-dark"
                                    height="22">
                            </span>
                            <span class="logo-lg">
                                <img src="{{ asset('theme/images/logo-dark.png') }}" alt="logo-dark" height="20">
                            </span>
                        </a>

                        <a href="index.html" class="logo logo-light"
                            style="
                        display: flex;
                        justify-content: center;">
                            <span class="logo-sm">

                                <img src="{{ asset($user->logo_empresa_url) }}" alt="logo-sm-light" height="50">

                            </span>
                            <span class="logo-lg">
                                <?php if(!empty($user->logo_empresa_url)) : ?>
                                <img src="{{ asset($user->logo_empresa_url) }}" alt="logo-light" height="50">
                                <?php endif ?>
                            </span>
                        </a>
                    </div>

                    <button type="button" class="btn btn-sm px-3 font-size-24 header-item waves-effect"
                        id="vertical-menu-btn">
                        <i class="ri-menu-2-line align-middle"></i>
                    </button>

                </div>

                <div class="d-flex">
                    <div class="dropdown d-inline-block">
                        <button type="button" class="btn header-item noti-icon waves-effect"
                            id="page-header-notifications-dropdown" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="ri-notification-3-line"></i>
                            @if (!empty($qnt_alertas_dia_de_hoje))
                                <span class="noti-number">{{ $qnt_alertas_dia_de_hoje }}</span>
                            @endif
                        </button>

                        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-end p-0"
                            aria-labelledby="page-header-notifications-dropdown">
                            <div class="p-3">
                                <div class="row align-items-center">
                                    <div class="col">
                                        <h6 class="m-0"> Alertas </h6>
                                    </div>
                                    <div class="col-auto">
                                        {{-- <a href="#!" class="small"> View All</a> --}}
                                    </div>
                                </div>
                            </div>
                            <div data-simplebar style="max-height: 230px;">

                                @php
                                    use Carbon\Carbon;

                                    $hoje = Carbon::today()->format('d/m/Y');
                                @endphp

                                @foreach ($notifications as $notificacao)
                                    <a href="/admin/clientes/editar/{{ $notificacao['id_cliente'] }}"
                                        class="text-reset notification-item">
                                        <div class="d-flex align-items-center">
                                            <div class="avatar-xs me-3">
                                                <span
                                                    class="fas fa-user-clock {{ $notificacao['data'] === $hoje ? 'color_red' : '' }}"
                                                    style="font-size: 26px;">
                                                </span>
                                            </div>
                                            <div class="flex-1">
                                                <h6
                                                    class="mb-1 font-size-12 text-muted {{ $notificacao['data'] === $hoje ? 'color_red' : '' }}">
                                                    Nome:
                                                    {{ $notificacao['nome_cliente'] }}</h6>
                                                <h6
                                                    class="mb-1 font-size-12 text-muted {{ $notificacao['data'] === $hoje ? 'color_red' : '' }}">
                                                    Telefone:
                                                    {{ $notificacao['telefone_cliente'] }}</h6>
                                                <h6 class="mb-1 mb-1 font-size-12 text-muted {{ $notificacao['data'] === $hoje ? 'color_red' : '' }}"
                                                    style="color: blue">
                                                    {{ $notificacao['mensagem'] }}</h6>
                                                <div
                                                    class="font-size-12 text-muted {{ $notificacao['data'] === $hoje ? 'color_red' : '' }}">
                                                    <p class="mb-1">
                                                        {{ 'Agendado para ' . $notificacao['data'] . ($notificacao['horario'] && $notificacao['horario'] !== '00:00:00' ? ' ' . $notificacao['horario'] : '') }}
                                                    </p>

                                                    {{-- <p class="mb-0"><i class="mdi mdi-clock-outline"></i> 3 min ago</p> --}}
                                                </div>
                                            </div>
                                        </div>

                                        <div class="container_notificacao">
                                        </div>

                                    </a>
                                @endforeach

                            </div>
                            {{-- <div class="p-2 border-top">
                                <div class="d-grid">
                                    <a class="btn btn-sm btn-link font-size-14 text-center" href="javascript:void(0)">
                                        <i class="mdi mdi-arrow-right-circle me-1"></i> View More..
                                    </a>
                                </div>
                            </div> --}}
                        </div>
                    </div>
                    <div class="dropdown d-inline-block user-dropdown">
                        <button type="button" class="btn header-item waves-effect" id="page-header-user-dropdown"
                            data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <img class="rounded-circle header-profile-user"
                                src="{{ asset('upload/img_perfil/' . $user['id'] . '/' . $user['img_perfil'] . '') }}"
                                alt="Header Avatar">
                            <span class="d-none d-xl-inline-block ms-1">{{ $user->name }}</span>
                            <i class="mdi mdi-chevron-down d-none d-xl-inline-block"></i>
                        </button>
                        <div class="dropdown-menu dropdown-menu-end">
                            <!-- item-->
                            <a class="dropdown-item" href="/admin/perfil"><i class="ri-user-line align-middle me-1"></i>
                                Perfil</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item text-danger" href="{{ route('logout') }}"><i
                                    class="ri-shut-down-line align-middle me-1 text-danger"></i> Logout</a>
                        </div>
                    </div>



                </div>
            </div>
        </header>

        <!-- ========== Left Sidebar Start ========== -->
        <div class="vertical-menu">

            <div data-simplebar class="h-100">

                <!--- Sidemenu -->
                <div id="sidebar-menu">
                    <!-- Left Menu Start -->
                    <ul class="metismenu list-unstyled" id="side-menu">
                        <li class="menu-title">Menu</li>

                        <li>
                            <a href="/admin/" class="waves-effect">
                                <i class="ri-dashboard-line"></i>
                                <span>Dashboard</span>
                            </a>
                        </li>


                        <li>
                            <a href="javascript: void(0);" class="has-arrow waves-effect">
                                <i class="ri-store-2-line"></i>
                                <span>Empreendimento</span>
                            </a>
                            <ul class="sub-menu" aria-expanded="false">

                                <li><a href="/admin/empreendimentos">Gerenciar</a></li>

                                {{-- @if ((isset($permissoes['funcao_add_emp']) && $permissoes['funcao_add_emp'] == 'true' && empty($user_admin)) || !empty($user_admin) || !empty($user_admin)) --}}
                                <li><a href="/admin/empreendimentos/adicionar">Adicionar</a></li>
                                {{-- @endif --}}


                            </ul>
                        </li>

                        <li>
                            <a href="javascript: void(0);" class="has-arrow waves-effect">
                                <i class="fas fa-users"></i>
                                <span>Clientes</span>
                            </a>
                            <ul class="sub-menu" aria-expanded="false">
                                <li><a href="/admin/clientes">Gerenciar</a></li>
                                <li><a href="/admin/clientes/adicionar">Adicionar</a></li>
                            </ul>
                        </li>
                        @if ($user->perfil_usuario == 1)
                            <li>
                                <a href="javascript: void(0);" class="has-arrow waves-effect">
                                    <i class="fas fa-hotel"></i>
                                    <span>Empresa</span>
                                </a>
                                <ul class="sub-menu" aria-expanded="false">
                                    <li><a href="/admin/empresa">Gerenciar Empresa</a></li>
                                    <li><a href="/admin/convite">Enviar Convite</a></li>
                                    <li><a href="/admin/equipe">Equipe</a></li>
                                </ul>
                            </li>
                        @endif
                        @if ($user->perfil_usuario == 1)
                        <li>
                            <a href="javascript: void(0);" class="has-arrow waves-effect">
                                <i class="far fa-building"></i>
                                <span>Sede</span>
                            </a>
                            <ul class="sub-menu" aria-expanded="false">
                                <li><a href="/admin/sede">Gerenciar Sede</a></li>
                            </ul>
                        </li>
                        @endif
                        <li>
                            <a href="javascript: void(0);" class="has-arrow waves-effect">
                                <i class="fas fa-user-circle"></i>
                                <span>Perfil</span>
                            </a>
                            <ul class="sub-menu" aria-expanded="false">
                                <li><a href="/admin/perfil">Gerenciar Perfil</a></li>
                            </ul>
                        </li>
                        <li>
                            <a href="javascript: void(0);" class="has-arrow waves-effect">
                                <i class="far fa-square"></i>
                                <span>Site</span>
                            </a>
                            <ul class="sub-menu" aria-expanded="false">
                                <li><a href="/admin/email">Gerenciar Lead</a></li>
                            </ul>
                        </li>
                        <li>
                            <a href="javascript: void(0);" class="has-arrow waves-effect">
                                <i class="fas fa-project-diagram"></i>
                                <span>Redes Sociais</span>
                            </a>
                            <ul class="sub-menu" aria-expanded="false">
                                <li><a href="/admin/redes_sociais">Gerenciar Redes Sociais</a></li>
                            </ul>
                        </li>
                        <li>
                            <a href="javascript: void(0);" class="has-arrow waves-effect">
                                <i class="fas fa-th"></i>
                                <span>Portais</span>
                            </a>
                            <ul class="sub-menu" aria-expanded="false">
                                <li><a href="/admin/portais">Gerenciar Portais</a></li>
                            </ul>
                        </li>
                        <li>
                            <a href="javascript: void(0);" class="has-arrow waves-effect">
                                <i class="far fa-circle"></i>
                                <span>Roleta</span>
                            </a>
                            <ul class="sub-menu" aria-expanded="false">
                                <li><a href="/admin/roleta">Gerenciar Roleta</a></li>
                            </ul>
                        </li>
                        @if ($user->perfil_usuario == 1)
                            <li>
                                <a href="javascript: void(0);" class="has-arrow waves-effect">
                                    <i class="fas fa-stream"></i>
                                    <span>Status</span>
                                </a>
                                <ul class="sub-menu" aria-expanded="false">
                                    <li><a href="/admin/status">Gerenciar Status</a></li>
                                </ul>
                            </li>
                        @endif
                        @if ($user->perfil_usuario == 1)
                            <li>
                                <a href="javascript: void(0);" class="has-arrow waves-effect">
                                    <i class="fas fa-tag"></i>
                                    <span>Tags</span>
                                </a>
                                <ul class="sub-menu" aria-expanded="false">
                                    <li><a href="/admin/tags">Gerenciar Tags</a></li>
                                </ul>
                            </li>
                        @endif
                        @if ($user->perfil_usuario == 1)
                            <li>
                                <a href="javascript: void(0);" class="has-arrow waves-effect">
                                    <i class="fas fa-file-signature"></i>
                                    <span>Fontes</span>
                                </a>
                                <ul class="sub-menu" aria-expanded="false">
                                    <li><a href="/admin/fontes">Gerenciar Fontes</a></li>
                                </ul>
                            </li>
                        @endif
                        <li>
                            <a href="javascript: void(0);" class="has-arrow waves-effect">
                                <i class="far fa-circle"></i>
                                <span>Contratos</span>
                            </a>
                            <ul class="sub-menu" aria-expanded="false">
                                <li><a href="/admin/contratos/cadastro_compras">Cadastro de Compras</a></li>
                            </ul>
                        </li>
                    </ul>
                </div>
                <!-- Sidebar -->
            </div>
        </div>
        <!-- Left Sidebar End -->


        <!-- ============================================================== -->
        <!-- Start right Content here -->
        <!-- ============================================================== -->
        <div class="main-content" id="result">


