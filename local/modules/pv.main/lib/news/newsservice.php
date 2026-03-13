<?php

namespace PV\Main\News;

use Bitrix\Main\Config\Option;
use Bitrix\Main\Loader;
use Bitrix\Main\SystemException;
use Psr\Log\LoggerInterface;
use PV\Main\Logger\LoggerFactory;

final class NewsService
{
    private const MODULE_ID = 'pv.main';

    private ?IblockProvider $iblockProvider = null;

    private LoggerInterface $logger;

    /**
     * @throws SystemException
     */
    public function __construct()
    {
        $this->logger = LoggerFactory::getLogger('pv.main');

        if (!Loader::includeModule('iblock')) {
            $this->logger->error('Module iblock is not available.');
            throw new SystemException('Module iblock is required for NewsService.');
        }

        $iblockId = (int)Option::get(self::MODULE_ID, 'NEWS_IBLOCK_ID', '0');

        if ($iblockId > 0) {
            $this->iblockProvider = new IblockProvider($iblockId);
            $this->logger->info('NewsService initialized with iblock.', ['iblock_id' => $iblockId]);
        } else {
            $this->logger->warning('NEWS_IBLOCK_ID is not configured. Stub data will be returned.');
        }
    }

    /**
     * @param array<string, mixed> $params
     *
     * @return array<string, mixed>
     */
    public function getNewsList(array $params = []): array
    {
        $page = max(1, (int)($params['page'] ?? 1));
        $pageSize = max(1, min(50, (int)($params['pageSize'] ?? 5)));
        $query = trim((string)($params['query'] ?? ''));
        $sort = (string)($params['sort'] ?? 'date_desc');

        $this->logger->debug('getNewsList called.', [
            'page'     => $page,
            'pageSize' => $pageSize,
            'query'    => $query,
            'sort'     => $sort,
        ]);

        $filter = [];

        if ($query !== '') {
            $filter['%NAME'] = $query;
        }

        $order = match ($sort) {
            'date_asc' => ['DATE_ACTIVE_FROM' => 'ASC'],
            'title_asc' => ['NAME' => 'ASC'],
            default => ['DATE_ACTIVE_FROM' => 'DESC'],
        };

        $offset = ($page - 1) * $pageSize;

        // Если инфоблок не настроен — возвращаем заглушку, чтобы верстка жила
        if ($this->iblockProvider === null) {
            $this->logger->info('Returning stub news list (iblock not configured).');

            return [
                'items' => [
                    [
                        'id'      => 1,
                        'title'   => 'Новость-заглушка',
                        'date'    => date('Y-m-d'),
                        'preview' => 'Инфоблок новостей ещё не настроен. Укажите ID инфоблока в настройке NEWS_IBLOCK_ID модуля pv.main.',
                        'code'    => 'stub',
                    ],
                ],
                'page'     => $page,
                'pageSize' => $pageSize,
                'total'    => 1,
            ];
        }

        $items = $this->iblockProvider->getList(
            $filter,
            $order,
            $pageSize,
            $offset
        );

        $this->logger->info('News list fetched.', ['count' => count($items), 'page' => $page]);

        // Для простоты сейчас не считаем общее количество — можно добавить позже через ::getCount()
        return [
            'items'    => $items,
            'page'     => $page,
            'pageSize' => $pageSize,
            'total'    => count($items),
        ];
    }
}
