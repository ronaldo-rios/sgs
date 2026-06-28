<link rel="stylesheet" href="<?= \Core\Config::url() . '/assets/css/pages/list.css' ?>">

<?php
/** @var array $emails */
$configEmails = $emails;
/** @var string $pagination */
$pagination = $pagination;
/** @var array<string, bool> $buttonpermissions */
$buttonPermissions = $buttonpermissions ?? [];
?>

<div class="list-page">
    <div class="list-page__header">
        <h2 class="list-page__title">Servidores de Email</h2>
        <div class="list-page__actions">
            <?php if (!empty($buttonPermissions['add'])) : ?>
                <a href="<?= \Core\Config::url() ?>/add-config-email/index" class="btn btn-primary">
                    <i class="fa-solid fa-plus"></i> Adicionar servidor
                </a>
            <?php endif; ?>
        </div>
    </div>

    <?php \App\Helpers\Flash::display(); ?>

    <?php if (isset($configEmails)) : ?>
        <div class="list-table-wrapper">
            <table class="list-table">
                <thead>
                    <tr>
                        <th>Nome</th>
                        <th>Título</th>
                        <th>Host</th>
                        <th>Porta</th>
                        <th>E-mail</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($configEmails as $emailServer) : ?>
                        <tr>
                            <td><?= $emailServer['name'] ?></td>
                            <td><?= $emailServer['title'] ?></td>
                            <td><?= $emailServer['host'] ?></td>
                            <td><?= (string) $emailServer['port'] ?></td>
                            <td><?= $emailServer['email'] ?></td>
                            <td>
                                <div class="list-table__actions">
                                    <?php if (!empty($buttonPermissions['update'])) : ?>
                                        <a href="<?= \Core\Config::url() ?>/update-config-email/index/<?= $emailServer['id'] ?>" class="btn btn-sm btn-outline">
                                            <i class="fa-solid fa-pen"></i> Editar
                                        </a>
                                    <?php endif; ?>
                                    <?php if (!empty($buttonPermissions['delete'])) : ?>
                                        <a href="<?= \Core\Config::url() ?>/delete-config-email/index/<?= $emailServer['id'] ?>"
                                           class="btn btn-sm btn-danger"
                                           onclick="return confirm('Tem certeza que deseja excluir este registro?');">
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
    <?php endif; ?>

    <nav class="list-pagination" aria-label="Paginação">
        <?php echo $pagination; ?>
    </nav>
</div>
