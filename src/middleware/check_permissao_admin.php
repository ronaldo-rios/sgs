<?php 

require '../../conexao.php';
use src\models\Auth;

$auth = new Auth($pdo, $baseUrl);
$usuarioInfo = $auth->checkToken();

if ($usuarioInfo->getPermissao() === 'admin'){
    echo 'admin';
} else {
    echo 'not admin';
}
