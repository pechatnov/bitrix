<?php

namespace PV\Main\News;

use Bitrix\Iblock\ElementTable;
use Bitrix\Main\ArgumentException;
use Bitrix\Main\DB\SqlQueryException;
use Bitrix\Main\ObjectPropertyException;
use Bitrix\Main\SystemException;

final class IblockProvider
{
    private int $iblockId;

    public function __construct(int $iblockId)
    {
        $this->iblockId = $iblockId;
    }

    /**
     * @param array<string, mixed> $filter
     * @param array<string, string> $order
     * @param int $limit
     * @param int $offset
     *
     * @return array<int, array<string, mixed>>
     *
     * @throws ObjectPropertyException
     * @throws ArgumentException
     * @throws SystemException
     * @throws SqlQueryException
     */
    public function getList(
        array $filter,
        array $order,
        int $limit,
        int $offset
    ): array {
        $queryFilter = array_merge(
            [
                '=IBLOCK_ID' => $this->iblockId,
                '=ACTIVE' => 'Y',
            ],
            $filter
        );

        $result = ElementTable::getList([
            'select' => [
                'ID',
                'NAME',
                'DATE_ACTIVE_FROM',
                'PREVIEW_TEXT',
                'CODE',
            ],
            'filter' => $queryFilter,
            'order' => $order,
            'limit' => $limit,
            'offset' => $offset,
        ]);

        $items = [];

        while ($row = $result->fetch()) {
            $items[] = [
                'id' => (int)$row['ID'],
                'title' => (string)$row['NAME'],
                'date' => (string)$row['DATE_ACTIVE_FROM'],
                'preview' => (string)$row['PREVIEW_TEXT'],
                'code' => (string)$row['CODE'],
            ];
        }

        return $items;
    }
}

