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
                        <h4 class="mb-0">Editar Empreendimentos </h4>
                        <a href="/admin/empreendimentos"><button class="bttn-material-flat bttn-md bttn-danger"><i
                            class="ri-arrow-left-line"></i> </button></a>
                    </div>
                </div>
            </div>


            <div class="row box">
                <div class="col-md-10">
                    <div class="form-container">


                        <form onsubmit="return false" autocomplete="off" class="form_edit_emp">
                            <div class="steps">
                                <p class="step"><i class="ri-community-line"></i></p>
                                <p class="step"><i class="ri-building-4-line"></i></p>
                                <p class="step"><i class="ri-ball-pen-fill"></i></p>
                                <p class="step"><i class="ri-money-dollar-circle-line"></i></p>
                            </div>

                            {{-- //? SEÇÃO 1 --}}
                            <div class="form-item">
                                <div class="row">
                                    <div class="col-lg-7">
                                        <div class="mb-3">
                                            <label class="form-label" for="nome_empreendimento">
                                                Nome
                                            </label>
                                            <input type="text" class="form-control" id="nome" name="nome"
                                                value="{{ $empreendimento->nome_empreendimento }}">
                                            <input type="hidden" class="form-control" id="id" name="id"
                                                value="{{ $empreendimento->id_empreendimento }}">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-2">
                                        <div class="mb-3">
                                            <label class="form-label" for="cep">CEP</label>
                                            <input type="text" class="form-control" id="cep" name="cep"
                                                value="{{ $empreendimento->cep }}">
                                        </div>
                                    </div>

                                </div>

                                <div class="row">
                                    <div class="col-lg-8">
                                        <div class="mb-3">
                                            <label class="form-label" for="endereco">Endereço</label>
                                            <input type="text" class="form-control" id="endereco" name="endereco"
                                                readonly value="{{ $empreendimento->endereco }}">
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="mb-3">
                                            <label class="form-label" for="numero">Número</label>
                                            <input type="text" class="form-control" id="numero" name="numero"
                                                value="{{ $empreendimento->numero }}">
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-4">
                                        <div class="mb-3">
                                            <label class="form-label" for="complemento">Complemento</label>
                                            <input type="text" class="form-control" id="complemento"
                                                name="complemento" value="{{ $empreendimento->complemento }}">
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="mb-3">
                                            <label class="form-label" for="referencia">Referência</label>
                                            <input type="text" class="form-control" id="referencia" name="referencia"
                                                value="{{ $empreendimento->referencia }}">
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="mb-3">
                                            <label class="form-label" for="bairro">Bairro</label>
                                            <input type="text" class="form-control" id="bairro" name="bairro"
                                                value="{{ $empreendimento->bairro_empreendimento }}" readonly>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-4">
                                        <div class="mb-3">
                                            <label class="form-label" for="cidade">Cidade</label>
                                            <input type="text" class="form-control" id="cidade" name="cidade"
                                                value="{{ $empreendimento->cidade_empreendimento }}" readonly>
                                        </div>
                                    </div>
                                    <div class="col-lg-2">
                                        <div class="mb-3">
                                            <label class="form-label" for="zona">Zona</label>
                                            <select class="form_select" name="zona">
                                                <option value="{{ $empreendimento->zona }}">{{ $empreendimento->zona }}</option>
                                                <option value="Leste">Leste</option>
                                                <option value="Sul">Sul</option>
                                                <option value="Oeste">Oeste</option>
                                                <option value="Norte">Norte</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-2">
                                        <div class="mb-3">
                                            <label class="form-label" for="estado">Estado</label>
                                            <select id="estado" class="form_select" name="estado">
                                                <option value="{{ $empreendimento->estado_empreendimento }}">{{ $empreendimento->estado_empreendimento }}</option>
                                                <option value="Acre">Acre</option>
                                                <option value="Alagoas">Alagoas</option>
                                                <option value="Amapá">Amapá</option>
                                                <option value="Amazonas">Amazonas</option>
                                                <option value="Bahia">Bahia</option>
                                                <option value="Ceará">Ceará</option>
                                                <option value="Distrito Federal">Distrito Federal</option>
                                                <option value="Espírito Sant">Espírito Santo</option>
                                                <option value="Goiás">Goiás</option>
                                                <option value="Maranhão">Maranhão</option>
                                                <option value="Mato Grosso">Mato Grosso</option>
                                                <option value="Mato Grosso do Sul">Mato Grosso do Sul</option>
                                                <option value="Minas Gerais">Minas Gerais</option>
                                                <option value="Pará">Pará</option>
                                                <option value="Paraíba">Paraíba</option>
                                                <option value="Paraná">Paraná</option>
                                                <option value="Pernambuco">Pernambuco</option>
                                                <option value="Piauí">Piauí</option>
                                                <option value="Rio de Janeiro">Rio de Janeiro</option>
                                                <option value="Rio Grande do Norte">Rio Grande do Norte</option>
                                                <option value="Rio Grande do Sul">Rio Grande do Sul</option>
                                                <option value="Rondônia">Rondônia</option>
                                                <option value="Roraima">Roraima</option>
                                                <option value="Santa Catarina">Santa Catarina</option>
                                                <option value="São Paulo">São Paulo</option>
                                                <option value="Sergipe">Sergipe</option>
                                                <option value="Tocantins">Tocantins</option>
                                              </select>
                                        </div>
                                    </div>
                                    <!-- <div class="col-lg-2">
                                        <div class="mb-3">
                                            <label class="form-label"
                                                for="pais">País</label>
                                            <select class="form_select" name="pais">
                                                <option value="Brasil">Brasil</option>

                                            </select>
                                        </div>
                                    </div> -->
                                </div>
                            </div>


                            {{-- //? SEÇÃO 2 --}}
                            <div class="form-item">
                                <div class="row">
                                    <div class="col-lg-3">
                                        <div class="mb-3">
                                            <label class="form-label" for="finalidade">Finalidade</label>
                                            <select class="form_select" name="finalidade">
                                                <option value="{{ $empreendimento->finalidade }}">{{ $empreendimento->finalidade }}</option>
                                                <option value="Residencial">Residencial</option>
                                                <option value="Comercial">Comercial</option>
                                                <option value="Rural">Rural</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-lg-3">
                                        <div class="mb-3">
                                            <label class="form-label" for="tipo_imovel">Tipo</label>
                                            <select class="form_select" name="tipo_imovel">
                                                <option value="{{ $empreendimento->tipo_imovel }}">{{ $empreendimento->tipo_imovel }}</option>
                                                <option value="Apartamento">Apartamento</option>
                                                <option value="Casa">Casa</option>
                                                <option value="Casa de Condomínio">Casa de Condomínio</option>
                                                <option value="Cobertura">Cobertura</option>
                                                <option value="Lote / Terreno">Lote / Terreno</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-lg-3">
                                        <div class="mb-3">
                                            <label class="form-label" for="etapa">Etapa

                                            </label>
                                            <select class="form_select" name="etapa">
                                                <option value="{{ $empreendimento->etapa }}">{{ $empreendimento->etapa }}</option>
                                                <option value="Lançamento">Lançamento</option>
                                                <option value="Em construção">Em construção</option>
                                                <option value="Pronto">Pronto</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-lg-3">
                                        <div class="mb-3">
                                            <label class="form-label" for="localizacao">Localização</label>
                                            <select class="form_select" name="localizacao">
                                                <option value="{{ $empreendimento->localizacao }}">{{ $empreendimento->localizacao }}</option>
                                                <option value="Priveligiada">Priveligiada</option>
                                                <option value="Ótima">Ótima</option>
                                                <option value="Bom">Bom</option>
                                            </select>
                                        </div>
                                    </div>


                                </div>
                                <div class="row">
                                    <div class="col-lg-2">
                                        <div class="mb-3">
                                            <label class="form-label" for="torres">Torres</label>
                                            <input type="number" class="form-control" id="torres" name="torres"
                                                value="{{ $empreendimento->torres }}">
                                        </div>
                                    </div>
                                    <div class="col-lg-2">
                                        <div class="mb-3">
                                            <label class="form-label" for="andares">Andares</label>
                                            <input type="number" class="form-control" id="andares" name="andares"
                                                value="{{ $empreendimento->andares }}">
                                        </div>
                                    </div>

                                    <div class="col-lg-2">
                                        <div class="mb-3">
                                            <label class="form-label" for="elevadores">Elevadores</label>
                                            <input type="number" class="form-control" id="elevadores"
                                                name="elevadores" value="{{ $empreendimento->elevadores }}">
                                        </div>
                                    </div>

                                    <div class="col-lg-2">
                                        <div class="mb-3">
                                            <label class="form-label" for="dormitorios">Dormitórios</label>
                                            <input type="number" class="form-control" id="dormitorios"
                                                name="dormitorios" value="{{ $empreendimento->dormitorios }}">
                                        </div>
                                    </div>

                                    <div class="col-lg-2">
                                        <div class="mb-3">
                                            <label class="form-label" for="suites">Suítes</label>
                                            <input type="number" class="form-control" id="suites" name="suites"
                                                value="{{ $empreendimento->suites }}">
                                        </div>
                                    </div>

                                    <div class="col-lg-2">
                                        <div class="mb-3">
                                            <label class="form-label" for="vagas">Vagas</label>
                                            <input type="number" class="form-control" id="vagas" name="vagas"
                                                value="{{ $empreendimento->vagas }}">
                                        </div>
                                    </div>


                                </div>

                                <div class="row">
                                    <div class="col-lg-2">
                                        <div class="mb-3">
                                            <label class="form-label" for="area_util">Área
                                                Útil</label>
                                            <input type="text" class="form-control" id="area_util"
                                                name="area_util" value="{{ $empreendimento->area_util }}">
                                        </div>
                                    </div>
                                    <div class="col-lg-2">
                                        <div class="mb-3">
                                            <label class="form-label" for="area_construida">Área
                                                Construída</label>
                                            <input type="text" class="form-control" id="area_construida"
                                                name="area_construida" value="{{ $empreendimento->area_construida }}">
                                        </div>
                                    </div>
                                    <div class="col-lg-2">
                                        <div class="mb-3">
                                            <label class="form-label" for="area_terreno">Área do
                                                Terreno</label>
                                            <input type="text" class="form-control" id="area_terreno"
                                                name="area_terreno" value="{{ $empreendimento->area_terreno }}">
                                        </div>
                                    </div>
                                    <div class="col-lg-2">
                                        <div class="mb-3">
                                            <label class="form-label" for="area_total">Área
                                                Total</label>
                                            <input type="text" class="form-control" id="area_total"
                                                name="area_total" value="{{ $empreendimento->area_total }}">
                                        </div>
                                    </div>
                                </div>

                            </div>


                            {{-- //? SEÇÃO 3 --}}
                            <div class="form-item">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="mb-3">
                                            <label for="descricao">Descrição</label>
                                            <textarea class="form-control" id="descricao" rows="4" name="descricao" >{{ $empreendimento->descricao }}</textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="mb-3">
                                            <label for="anotacao">Anotações</label>
                                            <textarea class="form-control" id="anotacao" rows="4" name="anotacao" >{{ $empreendimento->anotacao }}</textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            {{-- //? SEÇÃO 4 --}}
                            <div class="form-item">
                                <div class="row">
                                    <div class="col-lg-3">
                                        <div class="mb-3">
                                            <label class="form-label" for="contrato">Contrato</label>
                                            <select class="form_select " name="tipo_contrato">
                                                <option value="{{ $empreendimento->tipo_contrato }}">{{ $empreendimento->tipo_contrato }}</option>
                                                <option value="Venda">Venda</option>
                                                <option value="Locação">Locação</option>
                                                <option value="Venda / Locação">Venda / Locação</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-2">
                                        <div class="mb-3">
                                            <div class="mb-3">
                                                <label class="form-label" for="valor_locacao">Valor da Locação</label>
                                                <input type="text" class="form-control" id="valor_locacao"
                                                    name="valor_locacao" value="{{ $empreendimento->valor_locacao }}">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-2">
                                        <div class="mb-3">
                                            <div class="mb-3">
                                                <label class="form-label" for="valor_venda">Valor de Venda</label>
                                                <input type="text" class="form-control" id="valor_venda"
                                                    name="valor_venda" value="{{ $empreendimento->valor_empreendimento }}">
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-4">
                                        <div class="mb-3">
                                            <div class="mb-5">
                                                <label class="form-label" for="email">E-mail</label>
                                                <input type="mail" class="form-control" id="email"
                                                    name="email" value="{{ $empreendimento->email }}">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-2">
                                        <div class="mb-3">
                                            <div class="mb-3">
                                                <label class="form-label" for="telefone">Telefone</label>
                                                <input type="text" class="form-control" id="telefone"
                                                    name="telefone" value="{{ $empreendimento->telefone }}">
                                            </div>
                                        </div>
                                    </div>
                                </div>


                            </div>

                            <button class="btn-step bttn-material-flat bttn-sm bttn-danger">Voltar</button>

                            <button
                                class="btn-step bttn-material-flat bttn-sm bttn-primary btn-edit-emp">Avançar</button>
                        </form>
                    </div>
                </div>
            </div>





            {{-- END PAGE --}}
        </div>
    </div>
    <!-- end main content-->
    </div>

</x-app-layout>

@hasSection('page_emp_add')
    @yield('page_emp_add')
@endif
