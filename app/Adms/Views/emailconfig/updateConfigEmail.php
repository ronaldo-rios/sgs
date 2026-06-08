<link rel="stylesheet" href="<?= \Core\Config::url() . '/assets/css/pages/form.css' ?>">

<?php
/** @var array $edit */
$editConfigEmail = $edit;
?>

<div class="form-page form-page--wide">
    <div class="form-page__header">
        <h2 class="form-page__title">Atualizar Servidor de Email</h2>
        <div class="form-page__actions">
            <a href="<?= \Core\Config::url() ?>/config-emails/index" class="btn btn-outline">
                <i class="fa-solid fa-arrow-left"></i> Voltar
            </a>
        </div>
    </div>

    <?php \App\Helpers\Flash::display(); ?>
    <div id="msg"></div>

    <div class="form-card">
        <form action="" method="POST" id="form-editemailservers" class="app-form form-grid">
            <input type="hidden" name="id" value="<?= $editConfigEmail['id'] ?>">

            <div class="form-field">
                <label for="title">Título do E-mail</label>
                <input type="text" id="title" name="title" placeholder="Digite o título do e-mail" value="<?= htmlspecialchars($editConfigEmail['title']) ?>" required>
            </div>

            <div class="form-field">
                <label for="name">Nome</label>
                <input type="text" id="name" name="name" placeholder="Digite o nome do servidor de e-mail" value="<?= htmlspecialchars($editConfigEmail['name']) ?>" required>
            </div>

            <div class="form-field">
                <label for="host">Host</label>
                <input type="text" id="host" name="host" placeholder="Digite o host" value="<?= htmlspecialchars($editConfigEmail['host']) ?>" required>
            </div>

            <div class="form-field">
                <label for="port">Porta</label>
                <input type="number" id="port" name="port" placeholder="Digite a porta" value="<?= htmlspecialchars((string) $editConfigEmail['port']) ?>">
            </div>

            <div class="form-field">
                <label for="email">E-mail</label>
                <input type="email" id="email" name="email" placeholder="Digite o e-mail" value="<?= htmlspecialchars($editConfigEmail['email']) ?>" required>
            </div>

            <div class="form-field">
                <label for="username">Usuário</label>
                <input type="text" id="username" name="username" placeholder="Digite o usuário" value="<?= htmlspecialchars($editConfigEmail['username']) ?>" required>
            </div>

            <div class="form-field">
                <label for="smtp_secure">SMTP</label>
                <input type="text" id="smtp_secure" name="smtp_secure" placeholder="Ex.: tls ou ssl" value="<?= htmlspecialchars($editConfigEmail['smtp_secure']) ?>" required>
            </div>

            <div class="form-field form-field--full">
                <label for="password">Senha SMTP</label>
                <input type="password" id="password" name="password" placeholder="Deixe em branco para manter a senha atual" autocomplete="new-password">
            </div>

            <button type="submit" name="send_edit_email_config" value="Atualizar">Atualizar</button>
        </form>
    </div>
</div>
