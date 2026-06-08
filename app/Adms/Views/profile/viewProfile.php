<link rel="stylesheet" href="<?= \Core\Config::url() . '/assets/css/pages/view.css' ?>">

<div class="view-page">
    <div class="view-page__header">
        <h2 class="view-page__title">Meu Perfil</h2>
        <div class="view-page__actions">
            <a href="<?= \Core\Config::url() ?>/dashboard/index" class="btn btn-outline">
                <i class="fa-solid fa-arrow-left"></i> Voltar
            </a>
        </div>
    </div>

    <?php \App\Helpers\Flash::display(); ?>

    <?php
    /** @var array $profile */
    if (isset($profile)) {
        $infoProfile = [
            'Imagem' => 'image',
            'Nome' => 'name',
            'Email' => 'email',
            'Usuário' => 'user',
            'Permissão de Acesso' => 'access_level',
        ];
    ?>
        <article class="view-card">
            <dl class="view-details">
                <?php foreach ($infoProfile as $label => $key) :
                    $value = isset($profile[$key]) ? $profile[$key] : null;

                    if ($key === 'image') {
                        $userIdAndImage = $_SESSION['user_id'] . '/' . $value;
                        $imageSrc = $value !== null
                            ? \Core\Config::url() . \Core\Config::PATH_USER_IMAGE . $userIdAndImage
                            : \Core\Config::url() . \Core\Config::PATH_USER_IMAGE . 'default.png';
                ?>
                    <div class="view-field view-field--media">
                        <dt><?= $label ?></dt>
                        <dd>
                            <img class="view-image" src="<?= $imageSrc ?>" alt="<?= $profile['name'] ?>">
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
                <a href="<?= \Core\Config::url() ?>/update-profile/index/<?= $_SESSION['user_id'] ?>" class="btn btn-outline">
                    <i class="fa-solid fa-pen"></i> Editar
                </a>
            </div>
        </article>
    <?php } ?>
</div>
