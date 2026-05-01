<h1>Atualizar Senha</h1>

<?php \App\Helpers\Flash::display(); ?>

<span id="msg"></span>

<form action="" method="POST" id="update-password">
    <label for="password">Senha</label><br>
    <input type="password" id="password" name="password" placeholder="Digite sua nova senha" required><br><br>

    <button type="submit" name="send_update_password" value="Atualizar">Atualizar</button>
</form>