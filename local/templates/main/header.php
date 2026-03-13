<?php
if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) {
    die();
}

use Bitrix\Main\UI\Extension;

/** @var CMain $APPLICATION */

// Пытаемся подключить Vue 3 из ядра Битрикс (доступно в Битрикс 22.0+)
try {
    Extension::load(['ui.vue3']);
} catch (\Throwable $e) {
    // ui.vue3 недоступен — Vue 3 будет загружен через CDN ниже
}
?>
<!DOCTYPE html>
<html lang="<?= LANGUAGE_ID ?>">
<head>
    <?php $APPLICATION->ShowHead(); ?>
    <meta charset="<?= SITE_CHARSET ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?php $APPLICATION->ShowTitle(); ?></title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=PT+Sans:wght@400;700&display=swap" rel="stylesheet">
    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
        rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH"
        crossorigin="anonymous"
    >
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="/local/templates/main/build/app.css">
    <!-- Vue 3 CDN — используется если BX.Vue3 недоступен из ядра Битрикс -->
    <script>
        if (typeof BX === 'undefined' || typeof BX.Vue3 === 'undefined') {
            document.write('<script src="https://cdn.jsdelivr.net/npm/vue@3/dist/vue.global.prod.js"><\/script>');
        }
    </script>
</head>
<body>
<div id="panel">
    <?php $APPLICATION->ShowPanel(); ?>
</div>

<header class="pv-header">
    <nav class="navbar navbar-expand-lg navbar-dark container py-3 pv-navbar-container">
        <a class="navbar-brand" href="/">
            PV<span class="pv-logo-divider">|</span><span class="pv-logo-text-muted">main</span>
        </a>
        <button
            class="navbar-toggler"
            type="button"
            data-bs-toggle="collapse"
            data-bs-target="#pv-main-navbar"
            aria-controls="pv-main-navbar"
            aria-expanded="false"
            aria-label="Toggle navigation"
        >
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="pv-main-navbar">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link" href="/">Главная</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/search/">Поиск</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/contacts/">Контакты</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/personal/">Личный кабинет</a>
                </li>
            </ul>

            <form class="d-flex gap-2" action="/search/">
                <input
                    class="form-control form-control-sm"
                    type="search"
                    name="q"
                    placeholder="Поиск"
                    aria-label="Поиск"
                >
                <button class="btn btn-sm btn-header" type="submit">
                    Найти
                </button>
                <button
                    type="button"
                    class="btn btn-sm btn-header"
                    data-bs-toggle="modal"
                    data-bs-target="#pv-feedback-modal"
                >
                    Связаться
                </button>
            </form>
        </div>
    </nav>
</header>

<main id="pv-main-layout">
