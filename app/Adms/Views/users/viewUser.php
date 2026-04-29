<?php

echo "<H2>Detalhes do usuário</H2>";

echo \App\Helpers\Flash::display(); 
echo "<div id='msg'></div>";

if(isset($viewUser)) {

    $userDetails = [
        'Imagem' => 'image',
        'Nome' => 'name',
        'Email' => 'email',
        'Usuário' => 'user',
        'Apelido' => 'nickname',
        'Situação' => 'situation',
        'Nível de Permissão' => 'access_level',
        'Criado em' => 'created_at',
        'Última atualização' => 'updated_at'
    ];

    foreach ($userDetails as $label => $key) {
        $value = isset($viewUser[$key]) ? $viewUser[$key] : null;
        
        if ($key === 'image') {

            $userIdAndImage = $viewUser['id'] . "/". $value;
            $imageSrc = $value !== null 
                ? \Core\Config::url() . \Core\Config::PATH_USER_IMAGE . $userIdAndImage
                : \Core\Config::url() . \Core\Config::PATH_USER_IMAGE . 'default.png';

            echo "<img style='width:10em; height:8em;' src='". $imageSrc . "' alt='{$viewUser['name']}'><br>";
        } 
        elseif ($key === 'created_at' || $key === 'updated_at') {
        // Adjust the date format and verify if the date is not null:
            if ($value !== null) {
                $date = date_create_from_format('Y-m-d H:i:s', $value);
                if ($date !== false) {
                    echo "<span>{$label}: " . $date->format('d/m/Y') . "</span><br>";
                }
            }
        }
        else if ($key === 'situation') {
            // Define the color of the user's situation:
            echo "<span>{$label}: <span style='color: {$viewUser['color']}'>
            <strong>{$value}</strong>
            </span></span><br>";
        }
        else {
            if($value !== null) {
                echo "<span>{$label}: {$value}</span><br>";
            }
        }
        
    }

    echo "<br><a href='". \Core\Config::url() . "/edit-user/index/{$viewUser['id']}'>Editar</a><br>";
    echo "<a href='". \Core\Config::url() . "/delete-user/index/{$viewUser['id']}' 
        onclick='return confirm(\"Tem certeza que deseja excluir este usuário?\");'>Excluir</a><br><br>";
}