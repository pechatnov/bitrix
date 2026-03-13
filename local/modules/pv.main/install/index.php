<?php

use Bitrix\Main\Localization\Loc;
use Bitrix\Main\ModuleManager;

Loc::loadMessages(__FILE__);

if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) {
    die();
}

class pv_main extends CModule
{
    public $MODULE_ID          = 'pv.main';
    public $MODULE_VERSION     = '1.0.0';
    public $MODULE_VERSION_DATE = '2026-03-06 00:00:00';
    public $MODULE_NAME        = 'PV Main Module';
    public $MODULE_DESCRIPTION = 'Основной модуль pv.main: новости, API, логирование.';
    public $PARTNER_NAME       = 'PV';

    public function __construct()
    {
        $arModuleVersion = [];
        include __DIR__ . '/version.php';

        $this->MODULE_VERSION      = $arModuleVersion['VERSION'];
        $this->MODULE_VERSION_DATE = $arModuleVersion['VERSION_DATE'];
    }

    public function DoInstall(): void
    {
        ModuleManager::registerModule($this->MODULE_ID);
    }

    public function DoUninstall(): void
    {
        ModuleManager::unRegisterModule($this->MODULE_ID);
    }
}
