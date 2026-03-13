<?php

// Подключаем автозагрузчик Composer (Monolog и другие зависимости)
$composerAutoload = $_SERVER['DOCUMENT_ROOT'] . '/local/vendor/autoload.php';

if (file_exists($composerAutoload)) {
    require_once $composerAutoload;
}
