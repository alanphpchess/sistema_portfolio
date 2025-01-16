<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Dashboard\DashboardController;
use App\Http\Controllers\Empreendimentos\EmpreendimentosController;
use App\Http\Controllers\Clientes\ClientesController;
use App\Http\Controllers\Convite\ConviteController;
use App\Http\Controllers\Equipe\EquipeController;
use App\Http\Controllers\Empresa\EmpresaController;
use App\Http\Controllers\Perfil\PerfilController;
use App\Http\Controllers\Emails\EmailsController;
use App\Http\Controllers\RedesSociais\RedesSociaisController;
use App\Http\Controllers\Portais\PortaisController;
use App\Http\Controllers\Roleta\RoletaController;
use App\Http\Controllers\Logout\LogoutController;
use App\Http\Controllers\Sede\SedeController;
use App\Http\Controllers\Fontes\FontesController;
use App\Http\Controllers\Status\StatusController;
use App\Http\Controllers\TAGS\TAGSController;
use App\Http\Controllers\Contratos\CadastroCompra\CadastroCompraController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return redirect('/login');
});


/// ROTAS DASHBOARD
//? VIEW DASHBOARD
Route::get('/admin', [DashboardController::class, 'index'])->middleware(['auth', 'verified'])->name('admin');
//? OBTÉM OS DADOS DO DASHBOARD
Route::post('/admin/get_list_component', [DashboardController::class, 'get_list_component'])->middleware(['auth', 'verified']);
// Obtém os itens do dashboard
Route::post('/admin/get_list_item', [DashboardController::class, 'get_list_item'])->middleware(['auth', 'verified']);
// Salva o itens do Dashboard
Route::post('/admin/dashboard/salvar_itens', [DashboardController::class, 'salvar_item'])->middleware(['auth', 'verified']);
//? OBTÉM OS DADOS DO DASHBOARD
Route::post('/admin/dashboard/salvar_ordem_dash', [DashboardController::class, 'salvar_ordem_dash'])->middleware(['auth', 'verified']);
//? FILTRAR
Route::post('/admin/dashboard/filtro', [DashboardController::class, 'dashboard_filtro'])->middleware(['auth', 'verified']);

/// ROTAS EMPREENDIMENTO
//? VIEW EMPREENDIMENTO
Route::get('/admin/empreendimentos', [EmpreendimentosController::class, 'index'])->middleware(['auth', 'verified']);
//? VIEW ADICIONAR EMPREENDIMENTO
Route::get('/admin/empreendimentos/adicionar', [EmpreendimentosController::class, 'adicionar'])->middleware(['auth', 'verified']);
//? SALVAR EMPREENDIMENTO
Route::get('/admin/empreendimentos/salvar', [EmpreendimentosController::class, 'salvar'])->middleware(['auth', 'verified']);
//? DADOS TABELA EMPREENDIMENTO
Route::get('/admin/empreendimentos/datatable_empreendimentos', [EmpreendimentosController::class, 'datatable_empreendimentos'])->middleware(['auth', 'verified']);
//? VIEW EDITAR EMPREENDIMENTO
Route::get('/admin/empreendimentos/editar/{id}', [EmpreendimentosController::class, 'editar'])->middleware(['auth', 'verified']);
//? ATUALIZAR EMPREENDIMENTO
Route::get('/admin/empreendimentos/atualizar', [EmpreendimentosController::class, 'atualizar'])->middleware(['auth', 'verified']);
//? EXCLUIR EMPREENDIMENTO
Route::delete('/admin/empreendimentos/excluir', [EmpreendimentosController::class, 'excluir'])->middleware(['auth', 'verified']);
//? VIEW ADD IMG EMPREENDIMENTO
Route::get('/admin/empreendimentos/adicionar_imagem/{id}', [EmpreendimentosController::class, 'add_img'])->middleware(['auth', 'verified']);
//? UPLOAD DE IMAGEM
Route::post('/admin/empreendimentos/upload_img/{id}', [EmpreendimentosController::class, 'upload_img'])->middleware(['auth', 'verified']);
//? UPLOAD DE IMAGEM PRINCIPAL
Route::post('/admin/empreendimentos/upload_img_principal/{id}', [EmpreendimentosController::class, 'upload_img_principal'])->middleware(['auth', 'verified']);
//? VIEW GALERIA
Route::get('/admin/empreendimentos/galeria/{id}', [EmpreendimentosController::class, 'galeria'])->middleware(['auth', 'verified']);

//? VIEW CATEGORIA ARQUIVOS
Route::get('/admin/empreendimentos/pastas/gerenciamento/{id}', [EmpreendimentosController::class, 'gerenciar_pasta'])->middleware(['auth', 'verified']);
//? DADOS CATEGORIA PASTAS
Route::get('/admin/empreendimentos/datatable_emp_ger_pastas', [EmpreendimentosController::class, 'datatable_emp_ger_pastas'])->middleware(['auth', 'verified']);

//? VIEW ARQUIVOS
Route::get('/admin/empreendimentos/arquivos/{id}', [EmpreendimentosController::class, 'arquivos'])->middleware(['auth', 'verified']);
// //? DADOS TABELA EMPREENDIMENTO
Route::get('/admin/empreendimentos/datatable_emp_arquivos', [EmpreendimentosController::class, 'datatable_emp_arquivos'])->middleware(['auth', 'verified']);
//? DOWNLOAD
Route::get('/admin/empreendimentos/download/{id}', [EmpreendimentosController::class, 'download'])->middleware(['auth', 'verified']);
//? EXCLUIR ARQUIVO
Route::get('/admin/empreendimentos/excluir_arquivo/{id}', [EmpreendimentosController::class, 'excluir_arquivo'])->middleware(['auth', 'verified']);
//? PASTAS
// Route::get('/admin/empreendimentos/pastas', [EmpreendimentosController::class, 'excluir_arquivo'])->middleware(['auth', 'verified']);
//? ADICIONAR PASTAS
Route::post('/admin/empreendimentos/pastas/gerenciamento/add_pasta', [EmpreendimentosController::class, 'add_pasta'])->middleware(['auth', 'verified']);
//? EDITAR PASTAS
Route::post('/admin/empreendimentos/pastas/gerenciamento/edit_pasta', [EmpreendimentosController::class, 'edit_pasta'])->middleware(['auth', 'verified']);
//? EXCLUIR PASTAS
Route::delete('/admin/empreendimentos/pastas/gerenciamento/excluir_pasta', [EmpreendimentosController::class, 'excluir_pasta'])->middleware(['auth', 'verified']);

//? VIEW GERENCIAR ARQUIVOS
Route::post('/admin/empreendimentos/pastas/arquivos/{id}', [EmpreendimentosController::class, 'gerenciar_arquivos'])->middleware(['auth', 'verified']);
//? VIEW DATATABLE ARQUIVOS
Route::get('/admin/empreendimentos/pastas/arquivos/datatable_emp_arquivos', [EmpreendimentosController::class, 'datatable_emp_arq_2'])->middleware(['auth', 'verified']);
//? UPLOAD DE ARQUIVOS
Route::post('/admin/empreendimentos/upload_arquivos/{id}/{id_empreendimento}', [EmpreendimentosController::class, 'upload_arquivos'])->middleware(['auth', 'verified']);
//? EXCLUIR PASTAS
Route::delete('/admin/empreendimentos/pastas/excluir_arquivo', [EmpreendimentosController::class, 'excluir_arquivo'])->middleware(['auth', 'verified']);

//? VIEW PASTAS
Route::get('/admin/empreendimentos/pastas/{id}', [EmpreendimentosController::class, 'pastas'])->middleware(['auth', 'verified']);
//? VIEW ARQUIVOS
Route::get('/admin/empreendimentos/pastas/arquivos/{id}', [EmpreendimentosController::class, 'pastas_arquivos'])->middleware(['auth', 'verified']);


/// ROTAS CLIENTES
//? VIEW CLIENTES
Route::get('/admin/clientes', [ClientesController::class, 'index'])->middleware(['auth', 'verified']);
//? VIEW EDITAR EMPREENDIMENTO
Route::get('/admin/clientes/editar/{id}', [ClientesController::class, 'editar'])->middleware(['auth', 'verified'])->name('admin.clientes.editar');
//? DADOS TABELA CLIENTES
Route::get('/admin/clientes/datatable_clientes', [ClientesController::class, 'datatable_clientes'])->middleware(['auth', 'verified']);
//? DADOS TABELA CLIENTES STATUS
Route::get('/admin/clientes/datatable_clientes_status', [ClientesController::class, 'datatable_clientes_status'])->middleware(['auth', 'verified']);
//? VIEW ADD IMG CLIENTE
Route::get('/admin/clientes/adicionar_imagem/{id}', [ClientesController::class, 'add_img'])->middleware(['auth', 'verified']);
//? UPLOAD DE IMAGEM
Route::post('/admin/clientes/upload_img/{id}', [ClientesController::class, 'upload_img'])->middleware(['auth', 'verified']);
//? UPLOAD DE IMAGEM PRINCIPAL
Route::post('/admin/clientes/upload_img_principal/{id}', [ClientesController::class, 'upload_img_principal'])->middleware(['auth', 'verified']);
//? EXCLUIR CLIENTE
Route::delete('/admin/clientes/excluir', [ClientesController::class, 'excluir'])->middleware(['auth', 'verified']);
//? VIEW GALERIA
Route::get('/admin/clientes/galeria/{id}', [ClientesController::class, 'galeria'])->middleware(['auth', 'verified']);
//? VIEW CATEGORIA ARQUIVOS
Route::get('/admin/clientes/pastas/gerenciamento/{id}', [ClientesController::class, 'gerenciar_pasta'])->middleware(['auth', 'verified']);
//? VIEW PASTAS
Route::get('/admin/clientes/pastas/{id}', [ClientesController::class, 'pastas'])->middleware(['auth', 'verified']);
//? ADICIONAR PASTAS
Route::post('/admin/clientes/pastas/gerenciamento/add_pasta', [ClientesController::class, 'add_pasta'])->middleware(['auth', 'verified']);
//? DADOS CATEGORIA PASTAS
Route::get('/admin/clientes/datatable_cli_ger_pastas', [ClientesController::class, 'datatable_cli_ger_pastas'])->middleware(['auth', 'verified']);
//? EDITAR PASTAS
Route::post('/admin/clientes/pastas/gerenciamento/edit_pasta', [ClientesController::class, 'edit_pasta'])->middleware(['auth', 'verified']);
//? EXCLUIR PASTAS
Route::delete('/admin/clientes/pastas/gerenciamento/excluir_pasta', [ClientesController::class, 'excluir_pasta'])->middleware(['auth', 'verified']);
//? VIEW ARQUIVOS
Route::get('/admin/clientes/arquivos/{id}', [ClientesController::class, 'arquivos'])->middleware(['auth', 'verified']);
//? GERAR PDF CLIENTE
Route::get('/admin/clientes/pdf/{id_cliente}', [ClientesController::class, 'pdf_cliente'])->middleware(['auth', 'verified']);
//? EDITAR CLIENTES
Route::post('/admin/clientes/atualizar', [ClientesController::class, 'atualizar'])->middleware(['auth', 'verified']);
//? ADD STATUS
Route::get('/admin/clientes/add_status', [ClientesController::class, 'add_status'])->middleware(['auth', 'verified']);
//? ALT STATUS
Route::get('/admin/clientes/alt_status', [ClientesController::class, 'alt_status'])->middleware(['auth', 'verified']);
//? ADD TAG
Route::get('/admin/clientes/add_tag', [ClientesController::class, 'add_tag'])->middleware(['auth', 'verified']);
//? ADD FONTE
Route::get('/admin/clientes/add_fonte', [ClientesController::class, 'add_fonte'])->middleware(['auth', 'verified']);
//? EXCLUIR TAG
Route::delete('/admin/clientes/excluir_tag', [ClientesController::class, 'excluir_tag'])->middleware(['auth', 'verified']);
//? ADD CONTATO
Route::get('/admin/clientes/add_contato', [ClientesController::class, 'add_contato'])->middleware(['auth', 'verified']);
//? EXCLUIR CONTATO
Route::delete('/admin/clientes/excluir_contato', [ClientesController::class, 'excluir_contato'])->middleware(['auth', 'verified']);
//? OBTER INFORMAÇÕES DE CONTATO
Route::get('/admin/clientes/get_contato', [ClientesController::class, 'get_contato'])->middleware(['auth', 'verified']);

//? ADD ALERTA
Route::get('/admin/clientes/add_alerta', [ClientesController::class, 'add_alerta'])->middleware(['auth', 'verified']);
//? EXCLUIR ALERTA
Route::delete('/admin/clientes/excluir_alerta', [ClientesController::class, 'excluir_alerta'])->middleware(['auth', 'verified']);

//? VIEW ADICIONAR CLIENTE
Route::get('/admin/clientes/adicionar', [ClientesController::class, 'adicionar_cliente'])->middleware(['auth', 'verified']);
//? VIEW INSERIR CLIENTE
Route::get('/admin/clientes/inserir_cliente', [ClientesController::class, 'inserir_cliente'])->middleware(['auth', 'verified']);

//? VIEW CLIENTES
Route::get('/admin/clientes/busca', [ClientesController::class, 'busca_clientes'])->middleware(['auth', 'verified']);
//? DADOS TABELA CLIENTES BUSCA
Route::get('/admin/clientes/datatable_clientes_busca', [ClientesController::class, 'datatable_clientes_busca'])->middleware(['auth', 'verified']);
//? KANBAN ATUALIZAR STATUS
Route::post('/admin/clientes/kanban/atualizar', [ClientesController::class, 'atualizar_status_kanban'])->middleware(['auth', 'verified']);

//? OBTER DADOS PARA MOSTRAR OS SELECT DO EMPREEDIMENTO
Route::get('/admin/clientes/option_select_empreendimento', [ClientesController::class, 'option_select_empreendimento'])->middleware(['auth', 'verified']);
Route::get('/admin/clientes/option_select_sedes', [ClientesController::class, 'option_select_sedes'])->middleware(['auth', 'verified']);
Route::post('/admin/clientes/salvar_filtro', [ClientesController::class, 'salvar_filtro'])->middleware(['auth', 'verified']);



Route::post('/admin/clientes/search_datatable_realtime', [ClientesController::class, 'search_datatable_realtime'])->middleware(['auth', 'verified']);


/// ROTAS CONVITE
Route::get('/admin/convite', [ConviteController::class, 'index'])->middleware(['auth', 'verified']);
Route::post('/admin/convite/enviar_convite', [ConviteController::class, 'enviar_convite'])->middleware(['auth', 'verified']);
Route::get('/email/convite/validacao/{codigo_ativacao}', [ConviteController::class, 'validacao_convite']);
Route::get('/admin/convite/datatable_convite', [ConviteController::class, 'datatable_convite'])->middleware(['auth', 'verified']);

/// ROTAS EQUIPE
Route::get('/admin/equipe', [EquipeController::class, 'index'])->middleware(['auth', 'verified']);
Route::get('/admin/equipe/datatable_equipe', [EquipeController::class, 'datatable_equipe'])->middleware(['auth', 'verified']);
Route::post('/admin/equipe/adm', [EquipeController::class, 'tornar_adm'])->middleware(['auth', 'verified']);
Route::post('/admin/equipe/adm/remover', [EquipeController::class, 'remover_adm'])->middleware(['auth', 'verified']);

/// ROTA EMPRESA
Route::get('/admin/empresa', [EmpresaController::class, 'index'])->middleware(['auth', 'verified']);
Route::get('/admin/empresa/datatable_empresa', [EmpresaController::class, 'datatable_empresa'])->middleware(['auth', 'verified']);
Route::delete('/admin/empresa/excluir', [EmpresaController::class, 'excluir'])->middleware(['auth', 'verified']);
Route::post('/admin/empresa/edit_empresa', [EmpresaController::class, 'editar'])->middleware(['auth', 'verified']);
Route::post('/admin/empresa/add_empresa', [EmpresaController::class, 'adicionar'])->middleware(['auth', 'verified']);
Route::post('/admin/empresa/ativar', [EmpresaController::class, 'ativar_empresa'])->middleware(['auth', 'verified']);

///ROTAS E-MAILS
//? VIEW E-mail
Route::get('/admin/email', [EmailsController::class, 'index'])->middleware(['auth', 'verified']);
Route::get('/admin/emails/datatable_emails', [EmailsController::class, 'datatable_emails'])->middleware(['auth', 'verified']);
//? EXCLUIR EMAILS
Route::delete('/admin/emails/excluir', [EmailsController::class, 'excluir'])->middleware(['auth', 'verified']);
Route::get('/admin/emails/encaminhar_cliente', [EmailsController::class, 'encaminhar_cliente'])->middleware(['auth', 'verified']);
Route::get('/admin/emails/encaminhar_usuario_cliente', [EmailsController::class, 'encaminhar_usuario_cliente'])->middleware(['auth', 'verified']);


///ROTAS REDES SOCIAIS
//? VIEW Redes Sociais
Route::get('/admin/redes_sociais', [RedesSociaisController::class, 'index'])->middleware(['auth', 'verified']);
Route::get('/admin/redes_sociais/datatable_redes_sociais', [RedesSociaisController::class, 'datatable_redes_sociais'])->middleware(['auth', 'verified']);
//? EXCLUIR REDES SOCIAIS
Route::delete('/admin/redes_sociais/excluir', [RedesSociaisController::class, 'excluir'])->middleware(['auth', 'verified']);
Route::get('/admin/redes_sociais/encaminhar_cliente', [RedesSociaisController::class, 'encaminhar_cliente'])->middleware(['auth', 'verified']);
Route::get('/admin/redes_sociais/encaminhar_usuario_cliente', [RedesSociaisController::class, 'encaminhar_usuario_cliente'])->middleware(['auth', 'verified']);

///ROTAS PORTAL
//? VIEW Redes Sociais
Route::get('/admin/portais', [PortaisController::class, 'index'])->middleware(['auth', 'verified']);
Route::get('/admin/portais/datatable_portais', [PortaisController::class, 'datatable_portais'])->middleware(['auth', 'verified']);
Route::delete('/admin/portais/excluir', [PortaisController::class, 'excluir'])->middleware(['auth', 'verified']);
Route::get('/admin/portais/encaminhar_cliente', [PortaisController::class, 'encaminhar_cliente'])->middleware(['auth', 'verified']);
Route::get('/admin/portais/encaminhar_usuario_cliente', [PortaisController::class, 'encaminhar_usuario_cliente'])->middleware(['auth', 'verified']);

Route::get('/admin/portais/roleta', [PortaisController::class, 'roleta'])->middleware(['auth', 'verified']);
Route::get('/admin/portais/verificar_tempo_roleta', [PortaisController::class, 'verificar_tempo_roleta'])->middleware(['auth', 'verified']);

/// ROTAS PERFIL DE USUÁRIO
Route::get('/admin/perfil', [PerfilController::class, 'index'])->middleware(['auth', 'verified']);
Route::post('/admin/perfil/atualizar', [PerfilController::class, 'atualizar'])->middleware(['auth', 'verified']);
//? ATIVA EMAIL DE PERMISSÃO
Route::get('/admin/user/permissao/{codigo_ativacao}', [PerfilController::class, 'vw_permissao'])->middleware(['auth', 'verified']);


///ROLETA
//? VIEW Redes Sociais
Route::get('/admin/roleta', [RoletaController::class, 'index'])->middleware(['auth', 'verified']);
Route::get('/admin/roleta/datatable_roleta', [RoletaController::class, 'datatable_roleta'])->middleware(['auth', 'verified']);
Route::delete('/admin/roleta/excluir', [RoletaController::class, 'excluir'])->middleware(['auth', 'verified']);
Route::get('/admin/roleta/datatable_roleta_usuarios', [RoletaController::class, 'datatable_roleta_usuarios'])->middleware(['auth', 'verified']);

///SEDE
//? VIEW sede
Route::get('/admin/sede', [SedeController::class, 'index'])->middleware(['auth', 'verified']);
Route::get('/admin/sede/datatable_sede', [SedeController::class, 'datatable_sede'])->middleware(['auth', 'verified']);
Route::delete('/admin/sede/excluir', [SedeController::class, 'excluir'])->middleware(['auth', 'verified']);
Route::post('/admin/sede/edit_sede', [SedeController::class, 'editar'])->middleware(['auth', 'verified']);
Route::post('/admin/sede/add_sede', [SedeController::class, 'adicionar'])->middleware(['auth', 'verified']);

///FONTES
//? VIEW fontes
Route::get('/admin/fontes', [FontesController::class, 'index'])->middleware(['auth', 'verified']);
Route::get('/admin/fontes/datatable_fontes', [FontesController::class, 'datatable_fontes'])->middleware(['auth', 'verified']);
Route::delete('/admin/fontes/excluir', [FontesController::class, 'excluir'])->middleware(['auth', 'verified']);
Route::post('/admin/fontes/edit_fontes', [FontesController::class, 'editar'])->middleware(['auth', 'verified']);
Route::post('/admin/fontes/add_fontes', [FontesController::class, 'adicionar'])->middleware(['auth', 'verified']);


///STATUS
//? VIEW status
Route::get('/admin/status', [StatusController::class, 'index'])->middleware(['auth', 'verified']);
Route::get('/admin/status/datatable_status', [StatusController::class, 'datatable_status'])->middleware(['auth', 'verified']);
Route::delete('/admin/status/excluir', [StatusController::class, 'excluir'])->middleware(['auth', 'verified']);
Route::post('/admin/status/edit_status', [StatusController::class, 'editar'])->middleware(['auth', 'verified']);
Route::post('/admin/status/add_status', [StatusController::class, 'adicionar'])->middleware(['auth', 'verified']);

///TAGS
//? VIEW status
Route::get('/admin/tags', [TAGSController::class, 'index'])->middleware(['auth', 'verified']);
Route::get('/admin/tags/datatable_tags', [TAGSController::class, 'datatable_tags'])->middleware(['auth', 'verified']);
Route::delete('/admin/tags/excluir', [TAGSController::class, 'excluir'])->middleware(['auth', 'verified']);
Route::post('/admin/tags/edit_tags', [TAGSController::class, 'editar'])->middleware(['auth', 'verified']);
Route::post('/admin/tags/add_tags', [TAGSController::class, 'adicionar'])->middleware(['auth', 'verified']);




//? ATUALIZAR A PARMISSÃO DE USUÁRIO
Route::post('/admin/permissao/atualizar', [PerfilController::class, 'permissao_atualizar'])->middleware(['auth', 'verified']);

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


///ROLETA
//? VIEW Redes Sociais
Route::get('/admin/roleta', [RoletaController::class, 'index'])->middleware(['auth', 'verified']);
Route::get('/admin/roleta/datatable_roleta', [RoletaController::class, 'datatable_roleta'])->middleware(['auth', 'verified']);
Route::get('/admin/roleta/datatable_add_roleta', [RoletaController::class, 'datatable_add_roleta'])->middleware(['auth', 'verified']);
Route::get('/admin/roleta/usuario_parte_roleta', [RoletaController::class, 'usuario_parte_roleta'])->middleware(['auth', 'verified']);
Route::get('/admin/roleta/adicionar_tempo', [RoletaController::class, 'adicionar_tempo'])->middleware(['auth', 'verified']);
Route::get('/admin/roleta/salvar_roleta', [RoletaController::class, 'salvar_roleta'])->middleware(['auth', 'verified']);
Route::get('/admin/roleta/atualizar_roleta', [RoletaController::class, 'atualizar_roleta'])->middleware(['auth', 'verified']);
Route::get('/admin/roleta/criar_roleta', [RoletaController::class, 'criar_roleta'])->middleware(['auth', 'verified']);
Route::delete('/admin/roleta/excluir_roleta', [RoletaController::class, 'excluir_roleta'])->middleware(['auth', 'verified']);
Route::get('/admin/roleta/atualizar_ordem', [RoletaController::class, 'atualizar_ordem'])->middleware(['auth', 'verified']);

///CONTRATOS
Route::get('/admin/contratos/cadastro_compras', [CadastroCompraController::class, 'index'])->middleware(['auth', 'verified']);
Route::get('/admin/contratos/cadastro_compras/datatable', [CadastroCompraController::class, 'datatable'])->middleware(['auth', 'verified']);
Route::get('/admin/contratos/cadastro_compras/adicionar', [CadastroCompraController::class, 'adicionar'])->middleware(['auth', 'verified']);
Route::post('/admin/contratos/cadastro_compras/inserir', [CadastroCompraController::class, 'inserir'])->middleware(['auth', 'verified']);

Route::get('/logout', [LogoutController::class, 'logout'])->name('logout');


///xxx PÁGINA NÃO ENCONTRADA
Route::get('/admin/erro/404', function () {
    return view('erros_page.404');
});


require __DIR__.'/auth.php';
