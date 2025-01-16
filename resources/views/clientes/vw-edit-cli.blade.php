<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="container-fluid container_ma">


        <div class="row box">
            <div class="col-md-12">
                <div class="row">
                    <div class="col-md-8 mb-2">
                        <div class="card bg-light mb-3 form_edit_cli">
                            <div class="card-header">CLIENTES <a href="javascript:void(0);" id="link_editar_cliente"
                                    class="icon_edit_cliente"><i class="fas fa-edit"></i></a></div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-3 form_edit_campos">
                                        <p><strong>Nome</strong>
                                        <p class="edit_id_cli" style="display:none">{{ $cliente->id_cliente }}</p>
                                        <p class="edit_nome_cli">{{ $cliente->nome_cliente }}</p>
                                    </div>
                                    <div class="col-md-3 form_edit_campos">
                                        <p><strong>Empreendimento</strong>

                                        <p class="edit_emp_cli">
                                            <?php
                                            if (!empty($cliente->empreendimentos)) {
                                                echo $cliente->empreendimentos->nome_empreendimento;
                                            }
                                            ?>
                                        </p>
                                    </div>
                                    <div class="col-md-3 form_edit_campos">
                                        <p><strong>Telefone</strong>

                                        <p class="edit_telefone_cli">{{ $cliente->telefone1_cliente }}</p>
                                    </div>
                                    <div class="col-md-3 form_edit_campos">
                                        <p><strong>Celular</strong>

                                        <p class="edit_celular_cli">{{ $cliente->celular }}</p>
                                    </div>


                                    <div class="col-md-3 form_edit_campos">
                                        <p><strong>1º E-mail</strong>

                                        <p class="edit_email1_cli">{{ $cliente->email1_cliente }}</p>
                                    </div>
                                    <div class="col-md-3 form_edit_campos">
                                        <p><strong>2º E-mail</strong>

                                        <p class="edit_email2_cli">{{ $cliente->email2_cliente }}</p>
                                    </div>

                                    <div class="col-md-3 form_edit_campos">
                                        <p><strong>Data Criação</strong>

                                        <p class="edit_data_criacao_cli">
                                            {{ date('d/m/Y H:i:s', strtotime($cliente->data_criacao)) }}</p>
                                    </div>
                                    <div class="col-md-3 form_edit_campos">
                                        <p><strong>Data Lead</strong>

                                        <p>{{ $cliente->data_lead != '0000-00-00 00:00:00' && !empty($cliente->data_lead) ? date('d/m/Y H:i:s', strtotime($cliente->data_lead)) : '' }}
                                        </p>
                                    </div>

                                </div>
                                <div class="row">
                                    <div class="col-md-3 form_edit_campos">
                                        <p><strong>CEP</strong>

                                        <p class="edit_cep_cli">{{ $cliente->cep_cliente }}</p>
                                        </p>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-3 form_edit_campos">
                                        <p><strong>Endereço</strong>

                                        <p class="edit_endereco_cli">{{ $cliente->endereco_cliente }}</p>
                                        </p>
                                    </div>
                                    <div class="col-md-3 form_edit_campos">
                                        <p><strong>Número</strong>

                                        <p class="edit_numero_cli">{{ $cliente->numero_end_cliente }}</p>
                                        </p>
                                    </div>
                                    <div class="col-md-3 form_edit_campos">
                                        <p><strong>Bairro</strong>

                                        <p class="edit_bairro_cli">{{ $cliente->bairro_cliente }}</p>
                                        </p>
                                    </div>
                                    <div class="col-md-3 form_edit_campos">
                                        <p><strong>Cidade</strong>

                                        <p class="edit_cidade_cli">{{ $cliente->cidade_cliente }}</p>
                                        </p>
                                    </div>
                                    <div class="col-md-3 form_edit_campos">
                                        <p><strong>Estado</strong>

                                        <p class="edit_estado_cli">{{ $cliente->estado_cliente }}</p>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card bg-light mb-3 form_edit_cli">
                            <div class="card-header">CONTATOS REALIZADOS <a href="javascript:void(0);"
                                    class="icon_edit_cliente" id="link_add_contato"><i class="fas fa-edit"></i></a>
                            </div>
                            <div class="card-body">
                                <div class="row">

                                    <?php foreach($contatos_realizados as $contato_realizado): ?>
                                    <div class="accordion accordion-flush"
                                        id="accordionFlushExample{{ $contato_realizado->id }}">

                                        <div class="accordion-item">
                                            <h2 class="accordion-header" id="flush-headingOne">
                                                <button class="accordion-button collapsed" type="button"
                                                    data-bs-toggle="collapse" data-bs-target="#flush-collapseOne"
                                                    aria-expanded="false" aria-controls="flush-collapseOne">

                                                    {{ $contato_realizado->data . ' - ' . $contato_realizado->comunicacao }}
                                                </button>
                                            </h2>
                                            <div id="flush-collapseOne" class="accordion-collapse collapse"
                                                aria-labelledby="flush-headingOne"
                                                data-bs-parent="#accordionFlushExample{{ $contato_realizado->id }}">
                                                <div class="accordion-body">
                                                    {{ $contato_realizado->obs_contato }}
                                                    <div class="btns_accordion_edit">
                                                        {{-- <a href="javascript:void(0);"
                                                                class="bttn-material-flat bttn-xs bttn-success link_edit_contato"><i
                                                                    class="fa fa-edit" data-id="{{$contato_realizado->id}}"></i> Editar</a> --}}
                                                        <a href="javascript:void(0);"
                                                            class="bttn-material-flat bttn-xs bttn-danger link_excluir_comentario"><i
                                                                class="fa fa-edit"
                                                                data-target="{{ $contato_realizado->id }}"></i>
                                                            Excluir</a>

                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                    <?php endforeach; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card bg-light mb-3">
                            <div class="card-header">STATUS <a href="javascript:void(0);" id="link_modal_evolucao"
                                    class="icon_edit_cliente"><i class="fas fa-plus"></i></i></a></div>
                        </div>

                        <div class="card bg-light mb-3">
                            <div class="card-header">EVOLUÇÃO </div>
                            <div class="card-body">
                                <ul class="timeline">
                                    <?php if(!empty($status_evolucao) != false) : ?>
                                    <?php
                                        $data_atual = date('Y-m-d');
                                        
                                  

                                        foreach ($status_evolucao as $index => $status_ev) :
    $diferenca = strtotime($data_atual) - strtotime($status_ev->data_status); 
                                         $dias = (int)round($diferenca / (60 * 60 * 24));
    $is_first_item = ($index === 0); // Verifica se é o primeiro item
                                        ?>
                                    <li>
                                        <p class="data_status_evolucao"
                                            style="color: <?= $is_first_item ? '#1c6f00;#1c6f00;font-weight:bold;' : 'black' ?>;">
                                            <?php if ($dias < 0) {
                                                echo '0';
                                            } else {
                                                echo $dias;
                                            } ?> Dias -
                                            <?= date('d/m/Y H:i', strtotime($status_ev->data_status)) ?>
                                        </p>
                                        <?php if(!empty($status_ev->status)) : ?>
                                        <p class="titulo_status_evolucao"
                                            style="color: <?= $is_first_item ? '#1c6f00;font-weight:bold;' : 'black' ?>;">

                                            <?php if($status_ev->status->titulo_status) : ?>
                                            <?= $status_ev->status->titulo_status ?>
                                            <?php endif; ?>

                                        </p>
                                        <?php endif; ?>
                                    </li>
                                    <?php endforeach; ?>
                                    <?php endif; ?>

                                </ul>
                            </div>
                        </div>

                        <div class="card bg-light mb-3">
                            <div class="card-header">FONTE <a href="javascript:void(0);" id="link_modal_add_fonte"
                                    class="icon_edit_cliente"><i class="fas fa-edit"></i></a></div>
                            <div class="card-body">

                                <?php if(!empty($cliente->fontes)) : ?>
                                <p>{{ $cliente->fontes->titulo_fonte }}</p>
                                <?php endif; ?>

                            </div>
                        </div>

                        <div class="card bg-light mb-3">
                            <div class="card-header">TAGS <a href="javascript:void(0);" id="link_modal_add_tag"
                                    class="icon_edit_cliente"><i class="fas fa-edit"></i></a></div>
                            <div class="card-body">

                                <?php if(!empty($tags_clientes)) : ?>
                                <?php foreach ($tags_clientes as $tag_cliente) : ?>

                                <button type="button" class="btn btn-primary badge_tag"
                                    style="background:{{ $tag_cliente->tags->cor }}">
                                    {{ $tag_cliente->tags->titulo }} <span class="badge bg-danger"><a
                                            href="javascript:void(0);" class="excluir_tag"
                                            data-target="{{ $tag_cliente->id }}">X</a></span>
                                </button>

                                <?php endforeach; ?>
                                <?php endif; ?>

                            </div>
                        </div>
                        <div class="card bg-light mb-3">
                            <div class="card-header">ALERTA <a href="javascript:void(0);" id="link_add_alerta"
                                    class="icon_edit_cliente"><i class="fas fa-edit"></i></a></div>
                            <div class="card-body">

                                <?php foreach($alertas as $alerta) : ?>
                                <div class="card-header card_edit_alerta" style="background: {{ $alerta->cor }}">
                                    ALERTA <a href="javascript:void(0);" id="link_excluir_alerta"
                                        class="icon_edit_cliente" data-target="{{ $alerta->id }}"><i
                                            class="fas fa-times"></i></a></div>
                                <div class="card-body">
                                    <p>
                                        {{ $alerta->data . ($alerta->horario !== null && $alerta->horario !== '00:00:00' ? ' ' . $alerta->horario : '') }}
                                    </p>
                                    <p class="card-text">{{ $alerta->mensagem }}</p>
                                </div>
                                <?php endforeach; ?>

                            </div>
                        </div>

                    </div>
                </div>

            </div>
        </div>
    </div>


    {{-- END PAGE --}}
    </div>

    <!-- end main content-->
    </div>

    @include('clientes.modals.modal-evolucao-geral');
    @include('clientes.modals.modal-add-tag');
    @include('clientes.modals.modal-add-fonte');
    @include('clientes.modals.modal-editar-cliente');
    @include('clientes.modals.modal-add-contato');
    @include('clientes.modals.modal-edit-contato');
    @include('clientes.modals.modal-add-alerta');

</x-app-layout>

@hasSection('page_cli_edit')
    @yield('page_cli_edit')
@endif
