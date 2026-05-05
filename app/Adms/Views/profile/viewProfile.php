<?php

echo "<H2>Meu Perfil</H2>";

\App\Helpers\Flash::display();

/** @var array $profile */
if(isset($profile)) {

    $infoProfile = [
        'Imagem' => 'image',
        'Nome' => 'name',
        'Email' => 'email',
        'Usuário' => 'user',
        'Apelido' => 'nickname',
        'Permissão de Acesso' => 'access_level'
    ];

    foreach ($infoProfile as $label => $key) {
        $value = isset($profile[$key]) ? $profile[$key] : null;

        if ($key === 'image') {
            
            $userIdAndImage = $_SESSION['user_id'] . "/". $value;
            $imageSrc = $value !== null 
                ? \Core\Config::url() . \Core\Config::PATH_USER_IMAGE . $userIdAndImage
                : \Core\Config::url() . \Core\Config::PATH_USER_IMAGE . 'default.png';

            echo "<img style='width:10em; height:9em;' src='". $imageSrc . "' alt='{$profile['name']}'><br>";
        } 
        else {
            if($value !== null) {
                echo "<span>{$label}: {$value}</span><br>";
            }
        }
        
    }

    echo "<br><a href='". \Core\Config::url() . "/update-profile/index/{$_SESSION['user_id']}'>Editar</a><br>";

}