<div class="modal fade" id="ModalFiltroCliente" tabindex="-1" role="dialog" aria-labelledby="ModalFiltroCliente"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title mt-0" id="ModalFiltroClienteTitle">FILTRAR </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>


                <div class="modal-body">
                    <form class="form_filtrar_cliente">
                    <div class="row">
                        <div class="col-lg-4">
                            <div class="mb-3">
                                <label class="form-label" for="data_inicio">Data Início</label>
                                <input type="date" name="data_inicio" id="data_inicio" class="form-control search"
                                    placeholder="Data Início" value="{{ !empty($filtro_clientes[0]->data_criacao) ? $filtro_clientes[0]->data_criacao : '' }}">
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="mb-3">
                                <label class="form-label" for="data_fim">Data Fim</label>
                                <input type="date" name="data_fim" id="data_fim" class="form-control search"
                                    placeholder="Data Fim" value="{{ !empty($filtro_clientes[0]->data_fim) ? $filtro_clientes[0]->data_fim : '' }}">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="mb-3">
                                <label class="form-label" for="fonte_renda">Sede</label>
                                <select class="select_sedes ids_sedes" name="id_sedes[]" id="ids_sedes" multiple >
        
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="mb-3">
                                <label class="form-label" for="finalidade">Empreendimentos</label>
                                <select class="select_empreendimentos ids_empreendimentos" name="id_empreendimentos[]" id="ids_empreendimentos">

                                </select>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="mb-3">
                                <label class="form-label" for="fonte">Fonte</label>
                                <select class="form-select select_image" name="fonte" id="fonte">
                                    @if(!empty($filtro_clientes[0]->id_fonte))
                                      <option value="{{$filtro_clientes[0]->id_fonte}}">{{$filtro_clientes[0]->fontes->titulo_fonte}}</option>
                                    @endif
                                    <option value=""></option>
                                    <?php foreach($lista_fontes as $fonte) :?>
                                    <option value="{{ $fonte->id_fonte }}">{{ $fonte->titulo_fonte }}</option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="mb-3">
                                <label class="form-label" for="corretor">Corretor</label>
                                <select class="form-select select_image" name="corretor" id="corretor">
                                    @if(!empty($filtro_clientes[0]->id_corretor))
                                    <option value="{{$filtro_clientes[0]->id_corretor}}">{{$filtro_clientes[0]->usuarios->name}}</option>
                                   @endif
                                    <option value=""></option>
                                    <?php foreach($lista_corretores as $corretor) :?>

                                    <?php if(!empty($corretor->Usuarios->name)) :?>
                                    <option value="{{ $corretor->Usuarios->id }}">{{ $corretor->Usuarios->name }}
                                    </option>
                                    <?php endif; ?>


                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <div class="mb-3">
                                <label class="form-label" for="Cliente">Cliente</label>
                                <input type="text" name="cliente" id="cliente" class="form-control search"
                                    placeholder="Cliente" value="{{ !empty($filtro_clientes[0]->nome_cliente) ? $filtro_clientes[0]->nome_cliente : '' }}">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="mb-3">
                                <label class="form-label" for="telefone">Telefone</label>
                                <input type="text" name="telefone" id="telefone" class="form-control search"
                                    placeholder="Telefone" value="{{ !empty($filtro_clientes[0]->telefone) ? $filtro_clientes[0]->telefone : '' }}">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="mb-3">
                                <label class="form-label" for="email">E-mail</label>
                                <input type="text" name="email" id="email" class="form-control search"
                                    placeholder="E-mail" value="{{ !empty($filtro_clientes[0]->email) ? $filtro_clientes[0]->email : '' }}">
                            </div>
                        </div>
                    </div>


                    {{-- <div class="row">
                        <div class="col-lg-6">
                            <div class="mb-3">
                                <label class="form-label" for="contrato">Valor Inicial</label>
                                <input type="text" class="form-control" id="valor_inicial">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="mb-3">
                                <label class="form-label" for="contrato">Valor Final</label>
                                <input type="text" class="form-control" id="valor_final">
                            </div>
                        </div>
                    </div> --}}


                </div>
                <div class="modal-footer">
                    <button type="button" class="bttn-material-flat bttn-sm bttn-danger" data-bs-dismiss="modal">Fechar</button>
                </div>
            </form>



        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
