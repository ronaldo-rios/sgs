<link rel="stylesheet" href="<?= \Core\Config::url() . '/assets/css/pages/form.css' ?>">

<?php /** @var array<string, mixed> $accesslevel */ ?>

<div class="form-page">
    <div class="form-page__header">
        <h2 class="form-page__title">Editar Nível de Acesso</h2>
        <div class="form-page__actions">
            <a href="<?= \Core\Config::url() ?>/access-levels/index" class="btn btn-outline">
                <i class="fa-solid fa-arrow-left"></i> Voltar
            </a>
        </div>
    </div>

    <?php \App\Helpers\Flash::display(); ?>
    <div id="msg"></div>

    <div class="form-card">
        <form action="" method="POST" id="form-editaccesslevel" class="app-form">
            <input type="hidden" name="id" value="<?= htmlspecialchars($accesslevel['id']) ?>">

            <label for="name">Nome</label>
            <input type="text" id="name" name="name"
                value="<?= htmlspecialchars($accesslevel['access_level'] ?? $accesslevel['name'] ?? '') ?>"
                placeholder="Nome do nível de acesso" required>

            <button type="submit" name="send_update_access_level" value="Atualizar">Atualizar</button>
        </form>
    </div>
</div>
