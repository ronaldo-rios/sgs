<h1>Recuperação de Senha</h1>

<?php \App\Helpers\Flash::display(); ?>

<span id="msg"></span>

<form action="" method="POST" id="recover-password">
    <label for="emailrecover">E-mail</label><br>
    <input type="email" id="emailrecover" name="email" placeholder="Digite o seu e-mail" required><br><br>

    <button type="submit" name="sendRecoverPassword" value="Recuperar">Recuperar</button>
</form>

<p><a href="<?= \Core\Config::url() . "/login/index"; ?>">Clique aqui</a> para acessar</p>
