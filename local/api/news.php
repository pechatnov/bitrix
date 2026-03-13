<?php

use Bitrix\Main\Application;
use Bitrix\Main\Context;
use Bitrix\Main\Loader;
use Bitrix\Main\Web\Json;

require $_SERVER['DOCUMENT_ROOT'] . '/bitrix/modules/main/include/prolog_before.php';

global $APPLICATION;

Context::getCurrent()->getResponse()->addHeader('Content-Type', 'application/json; charset=UTF-8');

// Подключаем Monolog только если composer vendor доступен
$vendorAutoload = $_SERVER['DOCUMENT_ROOT'] . '/local/vendor/autoload.php';
$logger = null;

if (file_exists($vendorAutoload)) {
    require_once $vendorAutoload;

    if (class_exists('\PV\Main\Logger\LoggerFactory') && Loader::includeModule('pv.main')) {
        try {
            $logger = \PV\Main\Logger\LoggerFactory::getLogger('pv.main');
        } catch (\Throwable $e) {
            // логгер недоступен — продолжаем без него
        }
    }
}

if (!Loader::includeModule('pv.main')) {
    echo Json::encode([
        'success' => false,
        'error'   => 'Module pv.main is not installed. Please run: cd /bitrix/admin -> Marketplace -> Installed modules.',
    ]);
    die();
}

try {
    $request = Application::getInstance()->getContext()->getRequest();

    /** @var \PV\Main\News\NewsService $service */
    $service = new \PV\Main\News\NewsService();

    $data = $service->getNewsList([
        'page'     => $request->get('page'),
        'pageSize' => $request->get('pageSize'),
        'query'    => $request->get('q'),
        'sort'     => $request->get('sort'),
    ]);

    if ($logger) {
        $logger->info('News API request.', ['page' => $request->get('page')]);
    }

    echo Json::encode([
        'success' => true,
        'data'    => $data,
    ]);
} catch (\Throwable $throwable) {
    if ($logger) {
        $logger->error('News API error.', ['message' => $throwable->getMessage()]);
    }

    echo Json::encode([
        'success' => false,
        'error'   => $throwable->getMessage(),
    ]);
}

require $_SERVER['DOCUMENT_ROOT'] . '/bitrix/modules/main/include/epilog_after.php';
