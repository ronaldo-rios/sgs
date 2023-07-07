<?php

require '../../conexao.php';

$_SESSION['token'] = '';
header('Location: '. $baseUrl);
exit;