<link rel="stylesheet" href="<?= \Core\Config::url() . '/assets/css/pages/list.css' ?>">

<div class="list-page">
    <div class="list-page__header">
        <h2 class="list-page__title">Módulos de Página</h2>
        <div class="list-page__actions">
            <a href="<?= \Core\Config::url() ?>/add-page-module/index" class="btn btn-primary">
                <i class="fa-solid fa-plus"></i> Adicionar módulo
            </a>
        </div>
    </div>

    <?php \App\Helpers\Flash::display(); ?>
    <div id="msg"></div>

    <?php
    /** @var array<int, array<string, mixed>> $pagemodules */
    if (!empty($pagemodules)) :
    ?>
        <div class="list-table-wrapper">
            <table class="list-table">
                <thead>
                    <tr>
                        <th>Módulo</th>
                        <th>Tipo</th>
                        <th>Ordem</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($pagemodules as $module) : ?>
                        <tr>
                            <td><?= htmlspecialchars($module['name_module']) ?></td>
                            <td><?= htmlspecialchars($module['type_module']) ?></td>
                            <td><?= htmlspecialchars($module['order_module']) ?></td>
                            <td>
                                <div class="list-table__actions">
                                    <a href="<?= \Core\Config::url() ?>/view-page-module/index/<?= $module['id'] ?>" class="btn btn-sm btn-outline">
                                        <i class="fa-solid fa-eye"></i> Visualizar
                                    </a>
                                    <a href="<?= \Core\Config::url() ?>/update-page-module/index/<?= $module['id'] ?>" class="btn btn-sm btn-outline">
                                        <i class="fa-solid fa-pen"></i> Editar
                                    </a>
                                    <a href="<?= \Core\Config::url() ?>/delete-page-module/index/<?= $module['id'] ?>" class="btn btn-sm btn-outline"
                                        onclick="return confirm('Tem certeza que deseja excluir este módulo de página?');">
                                        <i class="fa-solid fa-trash"></i> Excluir
                                    </a>
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
        <p class="list-empty">Nenhum módulo de página encontrado.</p>
    <?php endif; ?>
</div>
