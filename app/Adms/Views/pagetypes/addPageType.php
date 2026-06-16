<link rel="stylesheet" href="<?= \Core\Config::url() . '/assets/css/pages/form.css' ?>">

<div class="form-page">
    <div class="form-page__header">
        <h2 class="form-page__title">Novo Tipo de Página</h2>
        <div class="form-page__actions">
            <a href="<?= \Core\Config::url() ?>/page-types/index" class="btn btn-outline">
                <i class="fa-solid fa-arrow-left"></i> Voltar
            </a>
        </div>
    </div>

    <?php \App\Helpers\Flash::display(); ?>
    <div id="msg"></div>

    <div class="form-card">
        <form action="" method="POST" id="form-addpagetype" class="app-form">
            <label for="type_name">Nome</label>
            <input type="text" id="type_name" name="type_name" placeholder="Nome do tipo de página" required>

            <button type="submit" name="send_add_page_type" value="Cadastrar">Cadastrar</button>
        </form>
    </div>
</div>
