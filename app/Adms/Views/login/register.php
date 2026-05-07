<?php \App\Helpers\Flash::display(); ?>

<span id="msg"></span>
<link rel="stylesheet" href="<?= \Core\Config::url() . '/assets/css/pages/register.css' ?>">

<div class="register-page">
    <div class="container-register">
        <img src="<?= \Core\Config::url() . '/assets/img/system/logo.png' ?>" alt="Logo SGS" class="register-logo">
        <h1>Novo Registro de Usuário</h1>

        <form action="" method="POST" id="form-newuser" class="app-form">
            <label for="name"><i class="fa-solid fa-id-card"></i> Nome</label>
            <input type="text" id="name" name="name" placeholder="Digite o nome completo" required>

            <label for="email"><i class="fa-solid fa-envelope"></i> E-mail</label>
            <input type="email" id="email" name="email" placeholder="Digite o e-mail" required>

            <label for="user"><i class="fa-solid fa-circle-user"></i> Usuário</label>
            <input type="text" id="user" name="user" oninput="toUpperCase(event)" placeholder="Digite o usuário" required>

            <label for="password"><i class="fa-solid fa-key"></i> Senha</label>
            <input type="password" id="password" name="password" placeholder="Digite a senha" required>

            <button type="submit" name="send_new_user" value="Cadastrar">Cadastrar</button>
        </form>

        <p class="register-login-link"><a href="<?= \Core\Config::url() . "/login/index"; ?>">Clique aqui</a> para acessar</p>
    </div>
</div>

<script src="<?= \Core\Config::url() . '/assets/js/toUpper.js' ?>"></script>