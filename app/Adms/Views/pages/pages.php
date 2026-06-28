<link rel="stylesheet" href="<?= \Core\Config::url() . '/assets/css/pages/list.css' ?>">

<?php
/** @var array<string, bool> $buttonpermissions */
$buttonPermissions = $buttonpermissions ?? [];
?>

<div class="list-page">
    <div class="list-page__header">
        <h2 class="list-page__title">Páginas</h2>
        <div class="list-page__actions">
            <?php if (!empty($buttonPermissions['add'])) : ?>
                <a href="<?= \Core\Config::url() ?>/add-page/index" class="btn btn-primary">
                    <i class="fa-solid fa-plus"></i> Adicionar página
                </a>
            <?php endif; ?>
        </div>
    </div>

    <?php \App\Helpers\Flash::display(); ?>
    <div id="msg"></div>

    <?php
    /** @var array<int, array<string, mixed>> $pages */
    if (!empty($pages)) :
    ?>
        <div class="list-table-wrapper">
            <table class="list-table">
                <thead>
                    <tr>
                        <th>Página</th>
                        <th>Tipo</th>
                        <th>Módulo</th>
                        <th>Status</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($pages as $page) : ?>
                        <tr>
                            <td><?= htmlspecialchars($page['name_page']) ?></td>
                            <td><?= htmlspecialchars($page['type_name']) ?></td>
                            <td><?= htmlspecialchars($page['module_name']) ?></td>
                            <td><?= (int) $page['active_status'] === 1 ? 'Ativo' : 'Inativo' ?></td>
                            <td>
                                <div class="list-table__actions">
                                    <?php if (!empty($buttonPermissions['view'])) : ?>
                                        <a href="<?= \Core\Config::url() ?>/view-page/index/<?= $page['id'] ?>" class="btn btn-sm btn-outline">
                                            <i class="fa-solid fa-eye"></i> Visualizar
                                        </a>
                                    <?php endif; ?>
                                    <?php if (!empty($buttonPermissions['update'])) : ?>
                                        <a href="<?= \Core\Config::url() ?>/update-page/index/<?= $page['id'] ?>" class="btn btn-sm btn-outline">
                                            <i class="fa-solid fa-pen"></i> Editar
                                        </a>
                                    <?php endif; ?>
                                    <?php if (!empty($buttonPermissions['delete'])) : ?>
                                        <a href="<?= \Core\Config::url() ?>/delete-page/index/<?= $page['id'] ?>" class="btn btn-sm btn-outline"
                                            onclick="return confirm('Tem certeza que deseja excluir esta página?');">
                                            <i class="fa-solid fa-trash"></i> Excluir
                                        </a>
                                    <?php endif; ?>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>

        <?php if (!empty($pagination)) : ?>
            <div class="list-pagination"><?= $pagination ?></div>
        <?php endif; ?>
    <?php else : ?>
        <p class="list-empty">Nenhuma página encontrada.</p>
    <?php endif; ?>
</div>
