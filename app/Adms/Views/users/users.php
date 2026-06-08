<link rel="stylesheet" href="<?= \Core\Config::url() . '/assets/css/pages/list.css' ?>">

<?php
/** @var string $pagination */
$pagination = $pagination;
?>

<div class="list-page">
    <div class="list-page__header">
        <h2 class="list-page__title">Usuários</h2>
        <div class="list-page__actions">
            <?php
            // if ($this->data['button_permissions']['add_user']) {
            ?>
            <a href="<?= \Core\Config::url() ?>/add-user/index" class="btn btn-primary">
                <i class="fa-solid fa-user-plus"></i> Adicionar usuário
            </a>
            <?php
            // }
            ?>
        </div>
    </div>

    <?php \App\Helpers\Flash::display(); ?>
    <div id="msg"></div>

    <?php if (!empty($users)) : ?>
        <div class="list-table-wrapper">
            <table class="list-table">
                <thead>
                    <tr>
                        <th>Nome</th>
                        <th>E-mail</th>
                        <th>Usuário</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    /** @var array<int, array<string, mixed>> $users */
                    foreach ($users as $user) :
                    ?>
                        <tr>
                            <td><?= htmlspecialchars($user['name']) ?></td>
                            <td><?= htmlspecialchars($user['email']) ?></td>
                            <td><?= htmlspecialchars($user['user']) ?></td>
                            <td>
                                <div class="list-table__actions">
                                    <?php
                                    // echo $this->data['button_permissions']['view_user'] ?
                                    ?>
                                    <a href="<?= \Core\Config::url() ?>/view-user/index/<?= $user['id'] ?>" class="btn btn-sm btn-outline">
                                        <i class="fa-solid fa-eye"></i> Visualizar
                                    </a>
                                    <?php
                                    //     : '';
                                    // echo $this->data['button_permissions']['edit_user']
                                    //     ? "<a href='". \Core\Config::url() . "/update-user/index/{$user['id']}'>Editar</a><br>" : '';
                                    // echo $this->data['button_permissions']['delete_user']
                                    //     ? "<a href='". \Core\Config::url() . "/delete-user/index/{$user['id']}'
                                    //         onclick='return confirm(\"Tem certeza que deseja excluir este usuário?\");'>Excluir</a><br><br>"
                                    //     : '';
                                    ?>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    <?php else : ?>
        <p class="list-empty">Nenhum usuário encontrado.</p>
    <?php endif; ?>

    <nav class="list-pagination" aria-label="Paginação">
        <?php echo $pagination; ?>
    </nav>
</div>
