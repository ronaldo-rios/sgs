<link rel="stylesheet" href="<?= \Core\Config::url() . '/assets/css/pages/form.css' ?>">

<?php /** @var array<string, mixed> $pagetype */ ?>

<div class="form-page">
    <div class="form-page__header">
        <h2 class="form-page__title">Editar Tipo de Página</h2>
        <div class="form-page__actions">
            <a href="<?= \Core\Config::url() ?>/page-types/index" class="btn btn-outline">
                <i class="fa-solid fa-arrow-left"></i> Voltar
            </a>
        </div>
    </div>

    <?php \App\Helpers\Flash::display(); ?>
    <div id="msg"></div>

    <div class="form-card">
        <form action="" method="POST" id="form-editpagetype" class="app-form">
            <input type="hidden" name="id" value="<?= htmlspecialchars($pagetype['id']) ?>">

            <label for="type_name">Nome</label>
            <input type="text" id="type_name" name="type_name"
                value="<?= htmlspecialchars($pagetype['type_name'] ?? '') ?>"
                placeholder="Nome do tipo de página" required>

            <button type="submit" name="send_update_page_type" value="Atualizar">Atualizar</button>
        </form>
    </div>
</div>
