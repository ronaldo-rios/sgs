<link rel="stylesheet" href="<?= \Core\Config::url() . '/assets/css/pages/form.css' ?>">

<?php
/** @var array<int, array<string, mixed>> $page_types */
/** @var array<int, array<string, mixed>> $page_modules */
?>

<div class="form-page form-page--wide">
    <div class="form-page__header">
        <h2 class="form-page__title">Nova Página</h2>
        <div class="form-page__actions">
            <a href="<?= \Core\Config::url() ?>/pages/index" class="btn btn-outline">
                <i class="fa-solid fa-arrow-left"></i> Voltar
            </a>
        </div>
    </div>

    <?php \App\Helpers\Flash::display(); ?>
    <div id="msg"></div>

    <div class="form-card">
        <form action="" method="POST" id="form-addpage" class="app-form form-grid">
            <div class="form-field form-field--full">
                <label for="name_page">Nome da página</label>
                <input
                    type="text"
                    id="name_page"
                    name="name_page"
                    value="<?= $name_page ?? '' ?>"
                    placeholder="Nome da página" required
                >
            </div>

            <div class="form-field">
                <label for="controller">Classe</label>
                <input
                    type="text"
                    id="controller"
                    name="controller"
                    value="<?= $controller ?? '' ?>"
                    placeholder="Controller da rota Ex: ListUsers" required
                />
            </div>

            <div class="form-field">
                <label for="method">Método</label>
                <input type="text" id="method" name="method" value="<?= $method ?? '' ?>" placeholder="Método da rota" required>
            </div>

            <div class="form-field">
                <label for="controller_in_the_main">Classe no Menu</label>
                <input
                    type="text"
                    id="controller_in_the_main"
                    name="controller_in_the_main"
                    value="<?= $controller_in_the_main ?? '' ?>"
                    placeholder="Controller exibido no menu. Ex: list-users" required
                >
            </div>

            <div class="form-field">
                <label for="method_in_the_main">Método principal</label>
                <input type="text" id="method_in_the_main" name="method_in_the_main" value="<?= $method_in_the_main ?? '' ?>" placeholder="Método exibido no menu" required>
            </div>

            <div class="form-field">
                <label for="page_type_id">Tipo de página</label>
                <select id="page_type_id" name="page_type_id" required>
                    <option value="" disabled <?= empty($page_type_id) ? 'selected' : '' ?>>Selecione...</option>
                    <?php foreach ($page_types as $type) : ?>
                        <option value="<?= $type['id'] ?>" <?= ($page_type_id ?? '') == $type['id'] ? 'selected' : '' ?>>
                            <?= $type['type_name'] ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="form-field">
                <label for="page_module_id">Módulo de página</label>
                <select id="page_module_id" name="page_module_id" required>
                    <option value="" disabled <?= empty($page_module_id) ? 'selected' : '' ?>>Selecione...</option>
                    <?php foreach ($page_modules as $module) : ?>
                        <option value="<?= $module['id'] ?>" <?= ($page_module_id ?? '') == $module['id'] ? 'selected' : '' ?>>
                            <?= $module['name_module'] ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="form-field">
                <label for="public">Pública</label>
                <select id="public" name="public" required>
                    <option value="0" <?= ($public ?? '0') === '0' ? 'selected' : '' ?>>Não</option>
                    <option value="1" <?= ($public ?? '0') === '1' ? 'selected' : '' ?>>Sim</option>
                </select>
            </div>

            <div class="form-field">
                <label for="enable_in_sidebar">Exibir no menu</label>
                <select id="enable_in_sidebar" name="enable_in_sidebar" required>
                    <option value="0" <?= ($enable_in_sidebar ?? '0') === '0' ? 'selected' : '' ?>>Não</option>
                    <option value="1" <?= ($enable_in_sidebar ?? '0') === '1' ? 'selected' : '' ?>>Sim</option>
                </select>
            </div>

            <div class="form-field">
                <label for="active_status">Status</label>
                <select id="active_status" name="active_status" required>
                    <option value="1" <?= ($active_status ?? '1') === '0' ? '' : 'selected' ?>>Ativo</option>
                    <option value="0" <?= ($active_status ?? '') === '0' ? 'selected' : '' ?>>Inativo</option>
                </select>
            </div>

            <div class="form-field">
                <label for="icon">Ícone</label>
                <input type="text" id="icon" name="icon" value="<?= $icon ?? '' ?>" placeholder="Ex.: fa-solid fa-house">
            </div>

            <div class="form-field form-field--full">
                <label for="obs">Observação</label>
                <textarea id="obs" name="obs" placeholder="Observação (opcional)"><?= $obs ?? '' ?></textarea>
            </div>

            <button type="submit" name="send_add_page" value="Cadastrar">Cadastrar</button>
        </form>
    </div>
</div>
