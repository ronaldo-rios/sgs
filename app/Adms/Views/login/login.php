<?php \App\Helpers\Flash::display(); ?>

<span id="msg"></span>
<link rel="stylesheet" href="<?= \Core\Config::url() . '/assets/css/pages/login.css' ?>">

<div class="login-page">
    <div class="container-login">
        <img src="<?= \Core\Config::url() . '/assets/img/system/logo.png' ?>" alt="Logo SGS" class="login-logo">
        <h1>Área Restrita</h1>
        <div class="login-form-wrapper">
            <form action="" method="POST" id="form-login" class="app-form">
                <label for="user"><i class="fa-solid fa-circle-user"></i> Usuário</label>
                <input type="text" id="user" name="user" oninput="toUpperCase(event)" placeholder="Digite o usuário" required>

                <label for="password"><i class="fa-solid fa-key"></i> Senha</label>
                <input type="password" id="password" name="password" placeholder="Digite a senha" required>

                <button type="submit" name="send_login" value="Acessar">Acessar</button>
            </form>
        </div>
        <div class="login-links">
            <p><a href="<?= \Core\Config::url() . '/register/index'; ?>">Cadastrar</a></p>
            <p><a href="<?= \Core\Config::url() . '/recover-password/index'; ?>">Esqueci minha senha</a></p>
        </div>
    </div>
</div>

<script src="<?= \Core\Config::url() . '/assets/js/toUpper.js' ?>"></script>