<?php

echo "<h2>Usuários</h2>";

echo \App\Helpers\Flash::display(); 
echo "<div id='msg'></div>";

// if ($this->data['button_permissions']['add_user']) {
//     echo "<a href='". \Core\Config::url() . "/new-user/index'>Adicionar novo usuário</a><br><br>";
// }

foreach($users as $user) {
    echo "<span>{$user['name']} - {$user['email']} - {$user['user']}</span><br>";

    // echo $this->data['button_permissions']['view_user'] ?
            echo "<a href='". \Core\Config::url() . "/view-user/index/{$user['id']}'>Visualizar</a><br>";
    //     : '';
    // echo $this->data['button_permissions']['edit_user'] 
    //     ? "<a href='". \Core\Config::url() . "/edit-user/index/{$user['id']}'>Editar</a><br>" : '';
    // echo $this->data['button_permissions']['delete_user'] 
    //     ? "<a href='". \Core\Config::url() . "/delete-user/index/{$user['id']}' 
    //         onclick='return confirm(\"Tem certeza que deseja excluir este usuário?\");'>Excluir</a><br><br>"
    //     : '';

}

// echo $this->data['pagination'];