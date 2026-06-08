<link rel="stylesheet" href="<?= \Core\Config::url() . '/assets/css/pages/view.css' ?>">

<div class="view-page">
    <div class="view-page__header">
        <h2 class="view-page__title">Detalhes do usuário</h2>
        <div class="view-page__actions">
            <a href="<?= \Core\Config::url() ?>/users/index" class="btn btn-outline">
                <i class="fa-solid fa-arrow-left"></i> Voltar
            </a>
        </div>
    </div>

    <?php \App\Helpers\Flash::display(); ?>
    <div id="msg"></div>

    <?php
    /** @var array<string, mixed>|null $user */
    $viewUser = $user;

    if (isset($viewUser)) {
        $userDetails = [
            'Imagem' => 'image',
            'Nome' => 'name',
            'Email' => 'email',
            'Usuário' => 'user',
            'Situação' => 'situation',
            'Nível de Permissão' => 'access_level',
            'Criado em' => 'created_at',
            'Última atualização' => 'updated_at',
        ];
    ?>
        <article class="view-card">
            <dl class="view-details">
                <?php foreach ($userDetails as $label => $key) :
                    $value = isset($viewUser[$key]) ? $viewUser[$key] : null;

                    if ($key === 'image') {
                        $userIdAndImage = $viewUser['id'] . '/' . $value;
                        $imageSrc = $value !== null
                            ? \Core\Config::url() . \Core\Config::PATH_USER_IMAGE . $userIdAndImage
                            : \Core\Config::url() . \Core\Config::PATH_USER_IMAGE . 'default.png';
                ?>
                    <div class="view-field view-field--media">
                        <dt><?= $label ?></dt>
                        <dd>
                            <img class="view-image" src="<?= $imageSrc ?>" alt="<?= $viewUser['name'] ?>">
                        </dd>
                    </div>
                <?php
                    } elseif ($key === 'created_at' || $key === 'updated_at') {
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
                    } elseif ($key === 'situation') {
                ?>
                    <div class="view-field">
                        <dt><?= $label ?></dt>
                        <dd>
                            <span class="view-status" style="color: <?= $viewUser['color'] ?>">
                                <strong><?= $value ?></strong>
                            </span>
                        </dd>
                    </div>
                <?php
                    } else {
                        if ($value !== null) {
                ?>
                    <div class="view-field">
                        <dt><?= $label ?></dt>
                        <dd><?= $value ?></dd>
                    </div>
                <?php
                        }
                    }
                endforeach;
                ?>
            </dl>

            <div class="view-actions">
                <a href="<?= \Core\Config::url() ?>/update-user/index/<?= $viewUser['id'] ?>" class="btn btn-outline">
                    <i class="fa-solid fa-pen"></i> Editar
                </a>
                <a href="<?= \Core\Config::url() ?>/delete-user/index/<?= $viewUser['id'] ?>"
                   class="btn btn-danger"
                   onclick="return confirm('Tem certeza que deseja excluir este usuário?');">
                    <i class="fa-solid fa-trash"></i> Excluir
                </a>
            </div>
        </article>
    <?php } ?>
</div>
