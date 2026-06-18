<link rel="stylesheet" href="<?= \Core\Config::url() . '/assets/css/pages/list.css' ?>">

<div class="list-page">
    <div class="list-page__header">
        <h2 class="list-page__title">Níveis de Acesso</h2>
        <div class="list-page__actions">
            <a href="<?= \Core\Config::url() ?>/add-access-level/index" class="btn btn-primary">
                <i class="fa-solid fa-plus"></i> Adicionar nível
            </a>
            <a href="<?= \Core\Config::url() ?>/sync-page-levels/index" class="btn btn-sync">
                <i class="fa-solid fa-arrows-rotate"></i> Sincronizar
            </a>
        </div>
    </div>

    <?php \App\Helpers\Flash::display(); ?>
    <div id="msg"></div>

    <?php
    /** @var array<int, array<string, mixed>> $accesslevels */
    if (!empty($accesslevels)) :
    ?>
        <div class="list-table-wrapper">
            <table class="list-table">
                <thead>
                    <tr>
                        <th>Nível</th>
                        <th>Ordem</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($accesslevels as $access) : ?>
                        <tr>
                            <td><?= htmlspecialchars($access['access_level']) ?></td>
                            <td><?= htmlspecialchars($access['order_level']) ?></td>
                            <td>
                                <div class="list-table__actions">
                                    <a href="<?= \Core\Config::url() ?>/permissions/index?level=<?= $access['id'] ?>" class="btn btn-sm btn-outline">
                                        <i class="fa-solid fa-lock"></i> Permissões
                                    </a>
                                    <a href="<?= \Core\Config::url() ?>/view-access-level/index/<?= $access['id'] ?>" class="btn btn-sm btn-outline">
                                        <i class="fa-solid fa-eye"></i> Visualizar
                                    </a>
                                    <a href="<?= \Core\Config::url() ?>/update-access-level/index/<?= $access['id'] ?>" class="btn btn-sm btn-outline">
                                        <i class="fa-solid fa-pen"></i> Editar
                                    </a>
                                    <a href="<?= \Core\Config::url() ?>/delete-access-level/index/<?= $access['id'] ?>" class="btn btn-sm btn-outline"
                                        onclick="return confirm('Tem certeza que deseja excluir este nível de acesso?');">
                                        <i class="fa-solid fa-trash"></i> Excluir
                                    </a>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    <?php else : ?>
        <p class="list-empty">Nenhum nível de acesso encontrado.</p>
    <?php endif; ?>
</div>
