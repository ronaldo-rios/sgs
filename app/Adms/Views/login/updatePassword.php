<?php \App\Helpers\Flash::display(); ?>

<span id="msg"></span>
<link rel="stylesheet" href="<?= \Core\Config::url() . '/assets/css/pages/login.css' ?>">

<div class="login-page">
    <div class="container-login">
        <h1>Atualizar Senha</h1>
        <div class="login-form-wrapper">
            <form action="" method="POST" id="update-password" class="app-form">
                <label for="password"><i class="fa-solid fa-key"></i> Senha</label>
                <input type="password" id="password" name="password" placeholder="Digite sua nova senha" required>

                <button type="submit" name="send_update_password" value="Atualizar">Atualizar</button>
            </form>
        </div>
    </div>
</div>