<h1>Atualizar Servidor de Email</h1>

<?php
    \App\Helpers\Flash::display();
    /** @var array $edit */
    $editConfigEmail = $edit;
?>
<span id="msg"></span>

<form action="" method="POST" id="form-editemailservers">
    <input type="hidden" name="id" value="<?= $editConfigEmail['id'] ?>">

    <label for="title">Título do E-mail</label><br>
    <input type="text" id="title" name="title" placeholder="Digite o título do e-mail" value="<?=$editConfigEmail['title'];?>" required><br><br>
    <label for="name">Nome</label><br>
    <input type="text" id="name" name="name" placeholder="Digite o nome do servidor de e-mail" value="<?=$editConfigEmail['name'];?>" required><br><br>
    <label for="port">Porta</label><br>
    <input type="number" id="port" name="port" placeholder="Digite a porta" value="<?=$editConfigEmail['port'];?>"><br><br>
    <label for="email">E-mail</label><br>
    <input type="email" id="email" name="email" placeholder="Digite o e-mail" value="<?=$editConfigEmail['email'];?>" required><br><br>
    <label for="username">Usuário</label><br>
    <input type="text" id="user" name="username" placeholder="Digite o usuário" value="<?=$editConfigEmail['username'];?>" required><br><br>
    <label for="smtp_secure">Smtp</label><br>
    <input type="text" id="smtp_secure" name="smtp_secure" placeholder="Digite o smtp" value="<?=$editConfigEmail['smtp_secure'];?>" required><br><br>
    <label for="host">Host</label><br>
    <input type="text" id="host" name="host" placeholder="Digite o host" value="<?=$editConfigEmail['host'];?>" required><br><br>
    <label for="password">Senha SMTP</label><br>
    <input type="password" id="password" name="password" placeholder="Deixe em branco para manter a senha atual" autocomplete="new-password"><br><br>

    <button type="submit" name="send_edit_email_config" value="Atualizar">Atualizar</button>
</form>