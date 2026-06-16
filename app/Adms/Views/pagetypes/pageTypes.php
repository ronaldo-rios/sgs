<link rel="stylesheet" href="<?= \Core\Config::url() . '/assets/css/pages/list.css' ?>">

<div class="list-page">
    <div class="list-page__header">
        <h2 class="list-page__title">Tipos de Página</h2>
        <div class="list-page__actions">
            <a href="<?= \Core\Config::url() ?>/add-page-type/index" class="btn btn-primary">
                <i class="fa-solid fa-plus"></i> Adicionar tipo
            </a>
        </div>
    </div>

    <?php \App\Helpers\Flash::display(); ?>
    <div id="msg"></div>

    <?php
    /** @var array<int, array<string, mixed>> $pagetypes */
    if (!empty($pagetypes)) :
    ?>
        <div class="list-table-wrapper">
            <table class="list-table">
                <thead>
                    <tr>
                        <th>Tipo</th>
                        <th>Ordem</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($pagetypes as $type) : ?>
                        <tr>
                            <td><?= htmlspecialchars($type['type_name']) ?></td>
                            <td><?= htmlspecialchars($type['order_page_type']) ?></td>
                            <td>
                                <div class="list-table__actions">
                                    <a href="<?= \Core\Config::url() ?>/view-page-type/index/<?= $type['id'] ?>" class="btn btn-sm btn-outline">
                                        <i class="fa-solid fa-eye"></i> Visualizar
                                    </a>
                                    <a href="<?= \Core\Config::url() ?>/update-page-type/index/<?= $type['id'] ?>" class="btn btn-sm btn-outline">
                                        <i class="fa-solid fa-pen"></i> Editar
                                    </a>
                                    <a href="<?= \Core\Config::url() ?>/delete-page-type/index/<?= $type['id'] ?>" class="btn btn-sm btn-outline"
                                        onclick="return confirm('Tem certeza que deseja excluir este tipo de página?');">
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
        <p class="list-empty">Nenhum tipo de página encontrado.</p>
    <?php endif; ?>
</div>
