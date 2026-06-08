<link rel="stylesheet" href="<?= \Core\Config::url() . '/assets/css/pages/form.css' ?>">

<?php
/** @var array $details */
$infoUser = $details;
/** @var array $situation */
$selectSituation = $situation;
/** @var array $level */
$selectAccessLevel = $level;

$oldImage = ! empty($infoUser['image'])
    ? \Core\Config::url() . \Core\Config::PATH_USER_IMAGE . $infoUser['id'] . '/' . $infoUser['image']
    : \Core\Config::url() . \Core\Config::PATH_USER_IMAGE . 'default.png';
?>

<div class="form-page form-page--wide">
    <div class="form-page__header">
        <h2 class="form-page__title">Editar Usuário</h2>
        <div class="form-page__actions">
            <a href="<?= \Core\Config::url() ?>/users/index" class="btn btn-outline">
                <i class="fa-solid fa-arrow-left"></i> Voltar
            </a>
        </div>
    </div>

    <?php \App\Helpers\Flash::display(); ?>
    <div id="msg"></div>

    <div class="form-card">
        <form action="" method="POST" id="form-edituser" class="app-form form-grid" enctype="multipart/form-data">
            <input type="hidden" name="id" value="<?= $infoUser['id'] ?>">

            <div class="form-field form-field--full">
                <label>Imagem atual</label>
                <span id="preview-img" class="form-preview">
                    <img src="<?= $oldImage ?>" alt="Imagem do usuário">
                </span>
            </div>

            <div class="form-field form-field--full">
                <label for="image">Alterar imagem</label>
                <input type="file" id="image" name="image" onchange="inputFileValImg()" accept="image/png, image/jpeg, image/jpg">
            </div>

            <div class="form-field">
                <label for="name">Nome</label>
                <input type="text" id="name" name="name" placeholder="Digite o nome completo" value="<?= htmlspecialchars($infoUser['name']) ?>" required>
            </div>

            <div class="form-field">
                <label for="email">E-mail</label>
                <input type="email" id="email" name="email" placeholder="Digite o e-mail" value="<?= htmlspecialchars($infoUser['email']) ?>" required>
            </div>

            <div class="form-field">
                <label for="user">Usuário</label>
                <input type="text" id="user" name="user" oninput="toUpperCase(event)" placeholder="Digite o usuário" value="<?= htmlspecialchars($infoUser['user']) ?>" required>
            </div>

            <div class="form-field">
                <label for="password">Senha</label>
                <input type="password" id="password" name="password" placeholder="Digite a senha" value="<?= htmlspecialchars($infoUser['password']) ?>" required>
            </div>

            <div class="form-field">
                <label for="user_situation_id">Situação</label>
                <select id="user_situation_id" name="user_situation_id" required>
                    <option value="">Selecione</option>
                    <?php foreach ($selectSituation as $situation) : ?>
                        <option value="<?= $situation['id'] ?>" <?= $infoUser['user_situation_id'] == $situation['id'] ? 'selected' : '' ?>>
                            <?= htmlspecialchars($situation['situation_name']) ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="form-field">
                <label for="access_level_id">Permissão de Acesso</label>
                <select id="access_level_id" name="access_level_id" required>
                    <option value="">Selecione</option>
                    <?php foreach ($selectAccessLevel as $accessLevel) : ?>
                        <option value="<?= $accessLevel['id'] ?>" <?= $infoUser['access_level_id'] == $accessLevel['id'] ? 'selected' : '' ?>>
                            <?= htmlspecialchars($accessLevel['access_level']) ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <button type="submit" name="send_edit_user" value="Atualizar">Atualizar</button>
        </form>
    </div>
</div>

<script src="<?= \Core\Config::url() . '/assets/js/toUpper.js' ?>"></script>
