<link rel="stylesheet" href="<?= \Core\Config::url() . '/assets/css/pages/view.css' ?>">

<div class="view-page">
    <div class="view-page__header">
        <h2 class="view-page__title">Detalhes da página</h2>
        <div class="view-page__actions">
            <a href="<?= \Core\Config::url() ?>/pages/index" class="btn btn-outline">
                <i class="fa-solid fa-arrow-left"></i> Voltar
            </a>
        </div>
    </div>

    <?php \App\Helpers\Flash::display(); ?>
    <div id="msg"></div>

    <?php
    /** @var array<string, mixed>|null $page */
    if (isset($page)) :
        $createdAt = $page['created_at'] ? date_create_from_format('Y-m-d H:i:s', $page['created_at']) : false;
        $updatedAt = $page['updated_at'] ? date_create_from_format('Y-m-d H:i:s', $page['updated_at']) : false;
    ?>
        <article class="view-card">
            <dl class="view-details">
                <div class="view-field">
                    <dt>Nome da página</dt>
                    <dd><?= $page['name_page'] ?></dd>
                </div>
                <div class="view-field">
                    <dt>Tipo</dt>
                    <dd><?= $page['type_name'] ?></dd>
                </div>
                <div class="view-field">
                    <dt>Módulo</dt>
                    <dd><?= $page['module_name'] ?></dd>
                </div>
                <div class="view-field">
                    <dt>Classe</dt>
                    <dd><?= $page['controller'] ?></dd>
                </div>
                <div class="view-field">
                    <dt>Método</dt>
                    <dd><?= $page['method'] ?></dd>
                </div>
                <div class="view-field">
                    <dt>Classe no menu</dt>
                    <dd><?= $page['controller_in_the_main'] ?></dd>
                </div>
                <div class="view-field">
                    <dt>Método no menu</dt>
                    <dd><?= $page['method_in_the_main'] ?></dd>
                </div>
                <div class="view-field">
                    <dt>Pública</dt>
                    <dd><?= (int) $page['public'] === 1 ? 'Sim' : 'Não' ?></dd>
                </div>
                <div class="view-field">
                    <dt>Exibir no menu</dt>
                    <dd><?= (int) $page['enable_in_sidebar'] === 1 ? 'Sim' : 'Não' ?></dd>
                </div>
                <div class="view-field">
                    <dt>Status</dt>
                    <dd><?= (int) $page['active_status'] === 1 ? 'Ativo' : 'Inativo' ?></dd>
                </div>
                <?php if (! empty($page['icon'])) : ?>
                    <div class="view-field">
                        <dt>Ícone</dt>
                        <dd><i class="<?= $page['icon'] ?>"></i> <?= $page['icon'] ?></dd>
                    </div>
                <?php endif; ?>
                <?php if (! empty($page['obs'])) : ?>
                    <div class="view-field">
                        <dt>Observação</dt>
                        <dd><?= $page['obs'] ?></dd>
                    </div>
                <?php endif; ?>
                <?php if ($createdAt !== false) : ?>
                    <div class="view-field">
                        <dt>Criado em</dt>
                        <dd><?= $createdAt->format('d/m/Y') ?></dd>
                    </div>
                <?php endif; ?>
                <?php if ($updatedAt !== false) : ?>
                    <div class="view-field">
                        <dt>Última atualização</dt>
                        <dd><?= $updatedAt->format('d/m/Y') ?></dd>
                    </div>
                <?php endif; ?>
            </dl>

            <div class="view-actions">
                <a href="<?= \Core\Config::url() ?>/update-page/index/<?= $page['id'] ?>" class="btn btn-outline">
                    <i class="fa-solid fa-pen"></i> Editar
                </a>
                <a href="<?= \Core\Config::url() ?>/delete-page/index/<?= $page['id'] ?>"
                   class="btn btn-danger"
                   onclick="return confirm('Tem certeza que deseja excluir esta página?');">
                    <i class="fa-solid fa-trash"></i> Excluir
                </a>
            </div>
        </article>
    <?php endif; ?>
</div>
