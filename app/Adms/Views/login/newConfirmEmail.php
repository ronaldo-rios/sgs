<?php \App\Helpers\Flash::display(); ?>

<span id="msg"></span>
<link rel="stylesheet" href="<?= \Core\Config::url() . '/assets/css/pages/login.css' ?>">

<div class="login-page">
    <div class="container-login">
        <h1>Novo Link</h1>
        <div class="login-form-wrapper">
            <form action="" method="POST" id="form-new-confirm-email" class="app-form">
                <label for="emailconfirm"><i class="fa-solid fa-envelope"></i> E-mail</label>
                <input type="email" id="emailconfirm" name="email" placeholder="Digite o seu e-mail" required>

                <button type="submit" name="send_new_confirm_email" value="Enviar">Enviar</button>
            </form>
        </div>
        <div class="login-links">
            <p><a href="<?= \Core\Config::url() . "/login/index"; ?>">Clique aqui</a> para acessar</p>
        </div>
    </div>
</div>
