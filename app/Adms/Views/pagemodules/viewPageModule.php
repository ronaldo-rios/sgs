<link rel="stylesheet" href="<?= \Core\Config::url() . '/assets/css/pages/view.css' ?>">

<div class="view-page">
    <div class="view-page__header">
        <h2 class="view-page__title">Detalhes do módulo de página</h2>
        <div class="view-page__actions">
            <a href="<?= \Core\Config::url() ?>/page-modules/index" class="btn btn-outline">
                <i class="fa-solid fa-arrow-left"></i> Voltar
            </a>
        </div>
    </div>

    <?php \App\Helpers\Flash::display(); ?>
    <div id="msg"></div>

    <?php
    /** @var array<string, mixed>|null $pagemodule */
    $viewPageModule = $pagemodule;

    if (isset($viewPageModule)) {
        $pageModuleDetails = [
            'Módulo' => 'name_module',
            'Tipo' => 'type_module',
            'Ordem' => 'order_module',
            'Observação' => 'obs',
            'Criado em' => 'created_at',
            'Última atualização' => 'updated_at',
        ];
    ?>
        <article class="view-card">
            <dl class="view-details">
                <?php foreach ($pageModuleDetails as $label => $key) :
                    $value = isset($viewPageModule[$key]) ? $viewPageModule[$key] : null;

                    if ($key === 'created_at' || $key === 'updated_at') {
                        if ($value !== null) {
                            $date = date_create_from_format('Y-m-d H:i:s', $value);
                            if ($date !== false) {
                ?>
                    <div class="view-field">
                        <dt><?= $label ?></dt>
                        <dd><?= $date->format('d/m/Y') ?></dd>
                    </div>
                <?php
                            }
                        }
                    } else {
                        if ($value !== null) {
                ?>
                    <div class="view-field">
                        <dt><?= $label ?></dt>
                        <dd><?= htmlspecialchars($value) ?></dd>
                    </div>
                <?php
                        }
                    }
                endforeach;
                ?>
            </dl>

            <div class="view-actions">
                <a href="<?= \Core\Config::url() ?>/update-page-module/index/<?= $viewPageModule['id'] ?>" class="btn btn-outline">
                    <i class="fa-solid fa-pen"></i> Editar
                </a>
                <a href="<?= \Core\Config::url() ?>/delete-page-module/index/<?= $viewPageModule['id'] ?>"
                   class="btn btn-danger"
                   onclick="return confirm('Tem certeza que deseja excluir este módulo de página?');">
                    <i class="fa-solid fa-trash"></i> Excluir
                </a>
            </div>
        </article>
    <?php } ?>
</div>
