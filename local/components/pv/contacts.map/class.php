<?php

use Bitrix\Main\ArgumentException;
use Bitrix\Main\Localization\Loc;
use Bitrix\Main\SystemException;

if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) {
    die();
}

Loc::loadMessages(__FILE__);

class PvContactsMapComponent extends \CBitrixComponent
{
    /**
     * @throws SystemException
     */
    public function executeComponent(): void
    {
        try {
            $this->arResult = $this->buildResult();
            $this->includeComponentTemplate();
        } catch (ArgumentException | SystemException $exception) {
            ShowError($exception->getMessage());
        }
    }

    /**
     * @return array<string, mixed>
     */
    protected function buildResult(): array
    {
        // Заглушка координат — позже можно вынести в настройки модуля pv.main
        return [
            'LAT' => $this->arParams['LAT'] ?? '55.751244',
            'LNG' => $this->arParams['LNG'] ?? '37.618423',
            'ZOOM' => (int)($this->arParams['ZOOM'] ?? 14),
        ];
    }
}

