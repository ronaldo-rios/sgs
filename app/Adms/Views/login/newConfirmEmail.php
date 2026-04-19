<h1>Novo Link</h1>

<?php \App\Helpers\Flash::display(); ?>

<span id="msg"></span>

<form action="" method="POST" id="form-new-confirm-email">
    <label for="emailconfirm">E-mail</label><br>
    <input type="email" id="emailconfirm" name="email" placeholder="Digite o seu e-mail" required><br><br>

    <button type="submit" name="sendNewConfirmEmail" value="Enviar">Enviar</button>
</form>

<p><a href="<?= \Core\Config::url() . "/login/index"; ?>">Clique aqui</a> para acessar</p>
