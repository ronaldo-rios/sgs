<link rel="stylesheet" href="<?= \Core\Config::url() . '/assets/css/pages/list.css' ?>">

<?php
/** @var array<int, array<string, mixed>> $permissions */
$listPermissions = $permissions;
/** @var string $accesslevels */
$accessLevel = $accesslevels;
/** @var string $pagination */
$pagination = $pagination;
/** @var int $page */
$currentPage = $page;
?>

<div class="list-page">
    <div class="list-page__header">
        <h2 class="list-page__title">
            Permissões<?= !empty($accessLevel) ? ' — ' . $accessLevel : '' ?>
        </h2>
        <div class="list-page__actions">
            <a href="<?= \Core\Config::url() ?>/access-levels/index" class="btn btn-outline">
                <i class="fa-solid fa-arrow-left"></i> Voltar
            </a>
        </div>
    </div>

    <?php \App\Helpers\Flash::display(); ?>
    <div id="msg"></div>

    <?php if (!empty($listPermissions)) : ?>
        <div class="list-table-wrapper">
            <table class="list-table">
                <thead>
                    <tr>
                        <th>Página</th>
                        <th>Permissão</th>
                        <th>Aparece no menu</th>
                        <th>Ordem</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($listPermissions as $permission) : ?>
                        <?php $liberado = $permission['permission'] === 'Liberado'; ?>
                        <tr>
                            <td><?= $permission['name_page'] ?></td>
                            <td>
                                <a href="<?= \Core\Config::url() ?>/update-permission/index/<?= $permission['id'] ?>?level=<?= $permission['access_level_id'] ?>&page=<?= $currentPage ?>"
                                    class="btn btn-sm <?= $liberado ? 'btn-success' : 'btn-danger' ?>"
                                    title="Clique para <?= $liberado ? 'bloquear' : 'liberar' ?>">
                                    <i class="fa-solid <?= $liberado ? 'fa-lock-open' : 'fa-lock' ?>"></i>
                                    <?= $permission['permission'] ?>
                                </a>
                            </td>
                            <td><?= $permission['sidebar'] ?></td>
                            <td><?= $permission['order_level_page'] ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>

        <?php if (!empty($pagination)) : ?>
            <nav class="list-pagination" aria-label="Paginação">
                <?php echo $pagination; ?>
            </nav>
        <?php endif; ?>
    <?php else : ?>
        <p class="list-empty">Nenhuma permissão encontrada.</p>
    <?php endif; ?>
</div>
