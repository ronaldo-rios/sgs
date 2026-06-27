<?php

$errorCode = $code ?? "Erro";
$errorTitle = $title ?? "Algo deu errado";
$errorMessage = $message ?? "Ocorreu um erro inesperado. Tente novamente mais tarde.";
?>

<link rel="stylesheet" href="<?= \Core\Config::url() . '/assets/css/pages/error.css' ?>">

<div class="error-page">
    <div class="error-card">
        <div class="error-icon">
            <i class="fa-solid fa-triangle-exclamation"></i>
        </div>
        <p class="error-code"><?= $errorCode ?></p>
        <h1 class="error-title"><?= $errorTitle ?></h1>
        <p class="error-message"><?= $errorMessage ?></p>
        <a href="<?= \Core\Config::url() ?>" class="error-action">
            Voltar ao início
        </a>
    </div>
</div>
