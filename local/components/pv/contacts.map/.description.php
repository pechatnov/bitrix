<?php

if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) {
    die();
}

use Bitrix\Main\Localization\Loc;

Loc::loadMessages(__FILE__);

$arComponentDescription = [
    'NAME' => Loc::getMessage('PV_CONTACTS_MAP_NAME') ?: 'PV: Контакты с картой',
    'DESCRIPTION' => Loc::getMessage('PV_CONTACTS_MAP_DESCRIPTION') ?: 'Простой D7-компонент контактов с картой без Vue.',
    'PATH' => [
        'ID' => 'pv',
        'NAME' => 'PV',
    ],
];

