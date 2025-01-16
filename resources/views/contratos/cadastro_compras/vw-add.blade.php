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
                        <h4 class="mb-0">ADICIONAR PROPOSTA DE COMPRA</h4>
                        <a href="/admin/clientes"><button class="bttn-material-flat bttn-md bttn-danger"><i
                                    class="ri-arrow-left-line"></i> </button></a>
                    </div>
                </div>
            </div>


            <form class="form_add">
                <div class="row box">
                    <div class="col-md-12">
                        <div class="row">

                            <div class="accordion" id="accordionExample">
                                <div class="accordion-item">
                                    <div id="informacoes" class="" aria-labelledby="headingOne"
                                        data-bs-parent="#accordionExample">
                                        <div class="accordion-body">
                                            <div class="row align-items-center">
                                                <div class="col-lg-4 mb-3">
                                                    <label class="form-label" for="codigo_proposta">Código
                                                        Proposta</label>
                                                    <div class="input-group">
                                                        <input type="text" class="form-control" id="codigo_proposta"
                                                            name="codigo_proposta">
                                                        <button class="btn btn-primary" type="button">Buscar</button>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-lg-4">
                                                    <div class="mb-3">
                                                        <label class="form-label" for="corretor">Corretor
                                                            Responsável</label>
                                                        <select class="form_select" name="corretor">
                                                            <option value="">Selecione</option>
                                                            @foreach ($corretores as $corretor)
                                                                <option
                                                                    value="{{ $corretor->id }}">
                                                                    {{ $corretor->name }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-lg-4">
                                                    <div class="mb-3">
                                                        <label class="form-label"
                                                            for="id_empreendimento">Empreendimentos</label>
                                                        <select class="form_select" name="empreendimento">
                                                            <option value="">Selecione</option>
                                                            @foreach ($empreendimentos as $empreendimento)
                                                                <option
                                                                    value="{{ $empreendimento->id_empreendimento }}">
                                                                    {{ $empreendimento->nome_empreendimento }}</option>
                                                            @endforeach

                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-lg-4">
                                                    <div class="mb-3">
                                                        <label class="form-label" for="unidade">Unidade</label>
                                                        <input type="text" class="form-control" id="unidade"
                                                            name="unidade">
                                                    </div>
                                                </div>

                                            </div>

                                        </div>
                                    </div>
                                </div>
                                @for ($i = 1; $i <= 2; $i++)
                                    <div class="accordion-item">
                                        <h2 class="accordion-header" id="heading<?php echo $i == 1 ? 'One' : 'Two'; ?>">
                                            <button class="accordion-button collapsed" type="button"
                                                data-bs-toggle="collapse" data-bs-target="#collapse<?php echo $i == 1 ? 'One' : 'Two'; ?>"
                                                aria-expanded="false" aria-controls="collapse<?php echo $i == 1 ? 'One' : 'Two'; ?>">
                                                {{ $i }}º COMPRADOR
                                            </button>
                                        </h2>
                                        <div id="collapse<?php echo $i == 1 ? 'One' : 'Two'; ?>" class="accordion-collapse collapse"
                                            aria-labelledby="heading<?php echo $i == 1 ? 'One' : 'Two'; ?>"
                                            data-bs-parent="#accordionExample">
                                            <div class="accordion-body">
                                                <div class="row">
                                                    <div class="col-lg-4">
                                                        <div class="mb-3">
                                                            <label class="form-label" for="nome{{ $i }}">
                                                                Nome <span class="text-danger">*</span></label>
                                                            <input type="text" class="form-control"
                                                                id="nome{{ $i }}"
                                                                name="nome{{ $i }}">
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-4">
                                                        <div class="mb-3">
                                                            <label class="form-label" for="sexo{{ $i }}">Sexo
                                                                <span class="text-danger">*</span></label>
                                                            <select class="form_select" name="sexo{{ $i }}">
                                                                <option value="">Selecione</option>
                                                                <option value="Masculino">Masculino</option>
                                                                <option value="Feminino">Feminino</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-4">

                                                        <div class="mb-3">
                                                            <label class="form-label" for="filiacao">
                                                                Filiação (Nome da Mãe) <span
                                                                    class="text-danger">*</span></label>
                                                            <input type="text" class="form-control"
                                                                id="filiacao{{ $i }}"
                                                                name="filiacao{{ $i }}">
                                                        </div>

                                                    </div>
                                                    <div class="col-lg-4">

                                                        <div class="mb-3">
                                                            <label class="form-label" for="data_nascimento">
                                                                Data de Nascimento <span
                                                                    class="text-danger">*</span></label>
                                                            <input type="date" class="form-control"
                                                                id="data_nascimento{{ $i }}"
                                                                name="data_nascimento{{ $i }}">
                                                        </div>

                                                    </div>
                                                    <div class="col-lg-4">

                                                        <div class="mb-3">
                                                            <label class="form-label" for="cpf">
                                                                CPF <span class="text-danger">*</span></label>
                                                            <input type="text" class="form-control cpf"
                                                                id="cpf{{ $i }}"
                                                                name="cpf{{ $i }}">
                                                        </div>

                                                    </div>
                                                    <div class="col-lg-4">

                                                        <div class="mb-3">
                                                            <label class="form-label" for="rg">
                                                                RG <span class="text-danger">*</span></label>
                                                            <input type="text" class="form-control rg"
                                                                id="rg{{ $i }}"
                                                                name="rg{{ $i }}">
                                                        </div>

                                                    </div>
                                                    <div class="col-lg-4">

                                                        <div class="mb-3">
                                                            <label class="form-label" for="orgao_expeditor">
                                                                Orgão Expeditor <span
                                                                    class="text-danger">*</span></label>
                                                            <input type="date" class="form-control"
                                                                id="orgao_expeditor{{ $i }}"
                                                                name="orgao_expeditor{{ $i }}">
                                                        </div>

                                                    </div>
                                                    <div class="col-lg-4">

                                                        <div class="mb-3">
                                                            <label class="form-label" for="emissao">
                                                                Data de Emissão <span
                                                                    class="text-danger">*</span></label>
                                                            <input type="date" class="form-control"
                                                                id="emissao{{ $i }}"
                                                                name="emissao{{ $i }}">
                                                        </div>

                                                    </div>
                                                    <div class="col-lg-4">
                                                        <div class="mb-3">
                                                            <label class="form-label" for="estado_civil">Estado
                                                                Civil <span class="text-danger">*</span></label>
                                                            <select class="form_select"
                                                                name="estado_civil{{ $i }}">
                                                                <option value="">Selecione</option>
                                                                <option value="Solteiro">Masculino</option>
                                                                <option value="Casado">Feminino</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-4">
                                                        <div class="mb-3">
                                                            <label class="form-label"
                                                                for="nacionalidade">Nacionalidade <span
                                                                    class="text-danger">*</span></label>
                                                            <input type="text" class="form-control"
                                                                id="nacionalidade{{ $i }}"
                                                                name="nacionalidade{{ $i }}">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-lg-4">
                                                        <div class="mb-3">
                                                            <label class="form-label" for="cep">
                                                                CEP <span class="text-danger">*</span></label>
                                                            <input type="text" class="form-control cep"
                                                                id="cep_endereco{{ $i }}"
                                                                name="cep{{ $i }}">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-lg-4">
                                                        <div class="mb-3">
                                                            <label class="form-label" for="endereco">Endereço</label>
                                                            <input type="text" class="form-control"
                                                                id="endereco{{ $i }}"
                                                                name="endereco{{ $i }}">
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-4">
                                                        <div class="mb-3">
                                                            <label class="form-label" for="Numero">Número</label>
                                                            <input type="text" class="form-control"
                                                                id="numero{{ $i }}"
                                                                name="numero{{ $i }}">
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-4">
                                                        <div class="mb-3">
                                                            <label class="form-label"
                                                                for="Complemento">Complemento</label>
                                                            <input type="text" class="form-control"
                                                                id="complemento{{ $i }}"
                                                                name="complemento{{ $i }}">
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-4">
                                                        <div class="mb-3">
                                                            <label class="form-label" for="Bairro">Bairro</label>
                                                            <input type="text" class="form-control"
                                                                id="bairro{{ $i }}"
                                                                name="bairro{{ $i }}">
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-4">
                                                        <div class="mb-3">
                                                            <label class="form-label" for="Cidade">Cidade</label>
                                                            <input type="text" class="form-control"
                                                                id="cidade{{ $i }}"
                                                                name="cidade{{ $i }}">
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-4">
                                                        <div class="mb-3">
                                                            <label class="form-label" for="uf">UF</label>
                                                            <input type="text" class="form-control"
                                                                id="uf{{ $i }}"
                                                                name="uf{{ $i }}">
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-4">
                                                        <div class="mb-3">
                                                            <label class="form-label"
                                                                for="telefone_residencial">Telefone
                                                                Residencial</label>
                                                            <input type="text" class="form-control telefone"
                                                                id="telefone_residencial{{ $i }}"
                                                                name="telefone_residencial{{ $i }}">
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-4">
                                                        <div class="mb-3">
                                                            <label class="form-label"
                                                                for="telefone_comercial">Telefone
                                                                Comercial</label>
                                                            <input type="text" class="form-control celular"
                                                                id="telefone_comercial{{ $i }}"
                                                                name="telefone_comercial{{ $i }}">
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-4">
                                                        <div class="mb-3">
                                                            <label class="form-label" for="celular">Celular</label>
                                                            <input type="text" class="form-control celular"
                                                                id="celular{{ $i }}"
                                                                name="celular{{ $i }}">
                                                        </div>
                                                    </div>


                                                </div>
                                                <div class="row">
                                                    <div class="col-lg-4">
                                                        <div class="mb-3">
                                                            <label class="form-label" for="email">Email</label>
                                                            <input type="text" class="form-control"
                                                                id="email{{ $i }}"
                                                                name="email{{ $i }}">
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="row">

                                                    <div class="col-lg-4">
                                                        <div class="mb-3">
                                                            <label class="form-label"
                                                                for="profissao">Profissão</label>
                                                            <input type="text" class="form-control"
                                                                id="profissao{{ $i }}"
                                                                name="profissao{{ $i }}">
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-4">
                                                        <div class="mb-3">
                                                            <label class="form-label" for="cargo">Cargo</label>
                                                            <input type="text" class="form-control"
                                                                id="cargo{{ $i }}"
                                                                name="cargo{{ $i }}">
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-4">
                                                        <div class="mb-3">
                                                            <label class="form-label" for="data_admissao">Data de
                                                                Admissão</label>
                                                            <input type="date" class="form-control"
                                                                id="data_admissao{{ $i }}"
                                                                name="data_admissao{{ $i }}">
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-4">
                                                        <div class="mb-3">
                                                            <label class="form-label" for="fonte_renda">Fonte
                                                                principal de
                                                                Renda</label>
                                                            <select class="form_select"
                                                                name="fonte_renda{{ $i }}">
                                                                <option value="Funcionário Público Empresa Privada">
                                                                    Funcionário
                                                                    Público Empresa Privada</option>
                                                                <option value="Funcionário Público">Funcionário Público
                                                                </option>
                                                                <option value="Autônomo">Autônomo</option>
                                                                <option value="Profissional Liberal">Profissional
                                                                    Liberal
                                                                </option>
                                                                <option value="Empresário">Empresário</option>
                                                                <option value="Proprietário Rural">Proprietário Rural
                                                                </option>
                                                                <option value="Aposentado">Aposentado</option>

                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-4">
                                                        <div class="mb-3">
                                                            <label class="form-label" for="nome_empresa">Nome da
                                                                Empresa</label>
                                                            <input type="text" class="form-control"
                                                                id="nome_empresa{{ $i }}"
                                                                name="nome_empresa{{ $i }}">
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-4">
                                                        <div class="mb-3">
                                                            <label class="form-label" for="cnpj">CNPJ</label>
                                                            <input type="text" class="form-control cnpj"
                                                                id="cnpj{{ $i }}"
                                                                name="cnpj{{ $i }}">
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-4">
                                                        <div class="mb-3">
                                                            <label class="form-label me-2" for="profissao">Renda
                                                                liquida
                                                                (Bruta - INSS e IR)</label>
                                                            <input type="text" class="form-control reais"
                                                                id="profissao{{ $i }}"
                                                                name="profissao{{ $i }}">
                                                        </div>
                                                    </div>

                                                </div>
                                                <div class="row g-0">
                                                    <div class="col-lg-12">
                                                        <p style="text-align: center">Outras rendas (caso não
                                                            comprovada no
                                                            IR
                                                            ou holerite, enviar extratos bancários dos últimos 3 meses).
                                                        </p>
                                                    </div>

                                                </div>
                                                <div class="row">

                                                    <div class="col-lg-4">
                                                        <div class="mb-3">
                                                            <label class="form-label invisible"
                                                                for="renda_liquida">R$</label>
                                                            <input type="text" class="form-control reais"
                                                                id="renda_liquida{{ $i }}"
                                                                name="renda_liquida{{ $i }}"
                                                                placeholder="R$">
                                                        </div>
                                                    </div>

                                                    <div class="col-lg-4 ml-2">
                                                        <div class="mb-3">
                                                            <label class="form-label" for="outra_fonte_renda">Outra
                                                                Fonte
                                                                de
                                                                Renda (Aluguéis, Pensão, etc)</label>
                                                            <input type="text" class="form-control"
                                                                id="outra_fonte_renda{{ $i }}"
                                                                name="outra_fonte_renda{{ $i }}">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                @endfor
                                <div class="accordion-item">
                                    <div id="informacoes" class="" aria-labelledby="headingOne"
                                        data-bs-parent="#accordionExample">
                                        <div class="accordion-body">
                                            <div class="row justify-content-end">
                                                <div class="col-lg-4 mb-3 d-flex justify-content-end">
                                                    <button type="button"
                                                        class="bttn-material-flat bttn-sm bttn-success btn_add_cadastro_compra"
                                                        data-bs-dismiss="modal">INSERIR</button>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </form>
        </div>


        {{-- END PAGE --}}
    </div>
    </div>
    <!-- end main content-->
    </div>


</x-app-layout>

@hasSection('page_add_cadastro_compras')
    @yield('page_add_cadastro_compras')
@endif
