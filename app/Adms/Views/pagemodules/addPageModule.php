<link rel="stylesheet" href="<?= \Core\Config::url() . '/assets/css/pages/form.css' ?>">

<div class="form-page">
    <div class="form-page__header">
        <h2 class="form-page__title">Novo Módulo de Página</h2>
        <div class="form-page__actions">
            <a href="<?= \Core\Config::url() ?>/page-modules/index" class="btn btn-outline">
                <i class="fa-solid fa-arrow-left"></i> Voltar
            </a>
        </div>
    </div>

    <?php \App\Helpers\Flash::display(); ?>
    <div id="msg"></div>

    <div class="form-card">
        <form action="" method="POST" id="form-addpagemodule" class="app-form">
            <label for="name_module">Nome</label>
            <input type="text" id="name_module" name="name_module" placeholder="Nome do módulo de página" required>

            <label for="type_module">Tipo</label>
            <input type="text" id="type_module" name="type_module" placeholder="Tipo do módulo de página" required>

            <label for="obs">Observação</label>
            <textarea id="obs" name="obs" placeholder="Observação (opcional)"></textarea>

            <button type="submit" name="send_add_page_module" value="Cadastrar">Cadastrar</button>
        </form>
    </div>
</div>
