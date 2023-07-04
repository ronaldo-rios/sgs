<?php 

require '../../conexao.php';
use src\models\Auth;

$auth = new Auth($pdo, $baseUrl);
$usuarioInfo = $auth->checkToken();

if ($usuarioInfo->getPermissao() === 'medico'){
    echo 'medico';
} else {
    echo 'not medico';
}
