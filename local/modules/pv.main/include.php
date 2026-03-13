<?php

use Bitrix\Main\Loader;

if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) {
    die();
}

Loader::registerAutoLoadClasses(
    'pv.main',
    [
        'PV\\Main\\News\\NewsService'       => 'lib/news/newsservice.php',
        'PV\\Main\\News\\IblockProvider'    => 'lib/news/iblockprovider.php',
        'PV\\Main\\Logger\\LoggerFactory'   => 'lib/logger/loggerfactory.php',
    ]
);

