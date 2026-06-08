<link rel="stylesheet" href="<?= \Core\Config::url() . '/assets/css/pages/form.css' ?>">

<div class="form-page">
    <div class="form-page__header">
        <h2 class="form-page__title">Novo Usuário</h2>
        <div class="form-page__actions">
            <a href="<?= \Core\Config::url() ?>/users/index" class="btn btn-outline">
                <i class="fa-solid fa-arrow-left"></i> Voltar
            </a>
        </div>
    </div>

    <?php \App\Helpers\Flash::display(); ?>
    <div id="msg"></div>

    <div class="form-card">
        <form action="" method="POST" id="form-adduser" class="app-form">
            <label for="name">Nome</label>
            <input type="text" id="name" name="name" placeholder="Digite o nome completo" required>

            <label for="email">E-mail</label>
            <input type="email" id="email" name="email" placeholder="Digite o e-mail" required>

            <label for="user">Usuário</label>
            <input type="text" id="user" name="user" oninput="toUpperCase(event)" placeholder="Digite o usuário" required>

            <label for="password">Senha</label>
            <input type="password" id="password" name="password" placeholder="Digite a senha" required>

            <button type="submit" name="send_add_user" value="Cadastrar">
                Cadastrar
            </button>
        </form>
    </div>
</div>

<script src="<?= \Core\Config::url() . '/assets/js/toUpper.js' ?>"></script>
