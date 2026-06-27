<link rel="stylesheet" href="<?= \Core\Config::url() . '/assets/css/pages/form.css' ?>">

<?php /** @var array<string, mixed> $pagemodule */ ?>

<div class="form-page">
    <div class="form-page__header">
        <h2 class="form-page__title">Editar Módulo de Página</h2>
        <div class="form-page__actions">
            <a href="<?= \Core\Config::url() ?>/page-modules/index" class="btn btn-outline">
                <i class="fa-solid fa-arrow-left"></i> Voltar
            </a>
        </div>
    </div>

    <?php \App\Helpers\Flash::display(); ?>
    <div id="msg"></div>

    <div class="form-card">
        <form action="" method="POST" id="form-editpagemodule" class="app-form">
            <input type="hidden" name="id" value="<?= htmlspecialchars($pagemodule['id']) ?>">

            <label for="name_module">Nome</label>
            <input type="text" id="name_module" name="name_module"
                value="<?= htmlspecialchars($pagemodule['name_module'] ?? '') ?>"
                placeholder="Nome do módulo de página" required>

            <label for="type_module">Tipo</label>
            <input type="text" id="type_module" name="type_module"
                value="<?= htmlspecialchars($pagemodule['type_module'] ?? '') ?>"
                placeholder="Tipo do módulo de página" required>

            <label for="obs">Observação</label>
            <textarea id="obs" name="obs" placeholder="Observação (opcional)"><?= htmlspecialchars($pagemodule['obs'] ?? '') ?></textarea>

            <button type="submit" name="send_update_page_module" value="Atualizar">Atualizar</button>
        </form>
    </div>
</div>
