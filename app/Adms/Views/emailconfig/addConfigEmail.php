<link rel="stylesheet" href="<?= \Core\Config::url() . '/assets/css/pages/form.css' ?>">

<div class="form-page form-page--wide">
    <div class="form-page__header">
        <h2 class="form-page__title">Adicionar Servidor de Email</h2>
        <div class="form-page__actions">
            <a href="<?= \Core\Config::url() ?>/config-emails/index" class="btn btn-outline">
                <i class="fa-solid fa-arrow-left"></i> Voltar
            </a>
        </div>
    </div>

    <?php \App\Helpers\Flash::display(); ?>
    <div id="msg"></div>

    <div class="form-card">
        <form action="" method="POST" id="form-addemailservers" class="app-form form-grid">
            <div class="form-field">
                <label for="title">Título do E-mail</label>
                <input type="text" id="title" name="title" placeholder="Digite o título do e-mail" required>
            </div>

            <div class="form-field">
                <label for="name">Nome</label>
                <input type="text" id="name" name="name" placeholder="Digite o nome do servidor de e-mail" required>
            </div>

            <div class="form-field">
                <label for="host">Host</label>
                <input type="text" id="host" name="host" placeholder="Digite o host" required>
            </div>

            <div class="form-field">
                <label for="port">Porta</label>
                <input type="number" id="port" name="port" placeholder="Digite a porta" required>
            </div>

            <div class="form-field">
                <label for="email">E-mail</label>
                <input type="email" id="email" name="email" placeholder="Digite o e-mail" required>
            </div>

            <div class="form-field">
                <label for="username">Usuário</label>
                <input type="text" id="username" name="username" placeholder="Digite o usuário" required>
            </div>

            <div class="form-field">
                <label for="smtp_secure">SMTP</label>
                <input type="text" id="smtp_secure" name="smtp_secure" placeholder="Ex.: tls ou ssl" required>
            </div>

            <div class="form-field form-field--full">
                <label for="password">Senha</label>
                <input type="password" id="password" name="password" placeholder="Digite a senha" required>
            </div>

            <button type="submit" name="send_add_config_emails" value="Salvar">
                Salvar
            </button>
        </form>
    </div>
</div>
