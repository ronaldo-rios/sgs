<h1>Editar Usuário</h1>

<?php 
\App\Helpers\Flash::display(); 

/** @var array $details */
$infoUser = $details;
/** @var array $situation */
$selectSituation = $situation;
/** @var array $level */
$selectAccessLevel = $level;
?>

<div id="msg"></div>

<form action="" method="POST" id="form-edituser" enctype="multipart/form-data">
    <input type="hidden" name="id" value="<?=$infoUser['id'];?>">

    <?php
    $old_image = (! empty($infoUser['image'])) 
        ? \Core\Config::url() . \Core\Config::PATH_USER_IMAGE . $infoUser['id'] . "/" . $infoUser['image']
        : \Core\Config::url() . \Core\Config::PATH_USER_IMAGE . "default.png";
    ?>
    <span id="preview-img">
        <img src="<?php echo $old_image; ?>" alt="Imagem" style="width: 100px; height: 100px;">
    </span><br><br>

    <label for="image">Imagem</label><br>
    <input type="file" id="image" name="image" onchange="inputFileValImg()" accept="image/png, image/jpeg, image/jpg" value="<?=$infoUser['image'];?>"><br><br>
    <label for="name">Nome</label><br>
    <input type="text" id="name" name="name" placeholder="Digite o nome completo" value="<?=$infoUser['name'];?>" required><br><br>
    <label for="email">E-mail</label><br>
    <input type="email" id="email" name="email" placeholder="Digite o e-mail" value="<?=$infoUser['email'];?>" required><br><br>
    <label for="user">Usuário</label><br>
    <input type="text" id="user" name="user" oninput="toUpperCase(event)" placeholder="Digite o usuário" value="<?=$infoUser['user'];?>" required><br><br>
    <label for="password">Senha</label><br>
    <input type="password" id="password" name="password" placeholder="Digite a senha" value="<?=$infoUser['password'];?>" required><br><br>

    <label for="user_situation_id">Situação</label><br>
    <select id="user_situation_id" name="user_situation_id" required>
        <option value="">Selecione</option>
        <?php
            foreach($selectSituation as $situation): ?>
                <?php if($infoUser['user_situation_id'] == $situation['id']): ?>
                    <option value='<?= $situation['id']; ?>' selected><?= $situation['situation_name']; ?></option>
                <?php else: ?>
                    <option value='<?= $situation['id']; ?>'><?= $situation['situation_name'];?></option>
                <?php endif; ?>
            <? endforeach;
        ?>
    </select><br><br>

    <label for="access_level_id">Permissão de Acesso</label><br>
    <select id="access_level_id" name="access_level_id" required>
        <option value="">Selecione</option>
        <?php
            foreach($selectAccessLevel as $accessLevel): ?>
                <?php if($infoUser['access_level_id'] == $accessLevel['id']): ?>
                    <option value='<?= $accessLevel['id']; ?>' selected><?= $accessLevel['access_level']; ?></option>
                <?php else: ?>
                    <option value='<?= $accessLevel['id']; ?>'><?= $accessLevel['access_level'];?></option>
                <?php endif; ?>
            <? endforeach;
        ?>
    </select><br><br>

    <button type="submit" name="send_edit_user" value="Atualizar">Atualizar</button>
</form>

<script src="<?= \Core\Config::url() . '/assets/js/toUpper.js'?>"></script>