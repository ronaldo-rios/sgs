<?php \App\Helpers\Flash::display(); ?>

<span id="msg"></span>
<link rel="stylesheet" href="<?= \Core\Config::url() . '/assets/css/pages/login.css' ?>">

<div class="login-page">
    <div class="container-login">
        <h1>Recuperação de Senha</h1>
        <div class="login-form-wrapper">
            <form action="" method="POST" id="recover-password" class="app-form">
                <label for="emailrecover">E-mail</label>
                <input type="email" id="emailrecover" name="email" placeholder="Digite o seu e-mail" required>

                <button type="submit" name="send_recover_password" value="Recuperar">Recuperar</button>
            </form>
        </div>
        <div class="login-links">
            <p><a href="<?= \Core\Config::url() . "/login/index"; ?>">Clique aqui</a> para acessar</p>
        </div>
    </div>
</div>
