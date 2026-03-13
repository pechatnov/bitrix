<?php

use Bitrix\Main\Application;
use Bitrix\Main\Context;
use Bitrix\Main\Loader;
use Bitrix\Main\Web\Json;
use PV\Main\Logger\LoggerFactory;
use PV\Main\News\NewsService;

require $_SERVER['DOCUMENT_ROOT'] . '/bitrix/modules/main/include/prolog_before.php';

global $APPLICATION;

Context::getCurrent()->getResponse()->addHeader('Content-Type', 'application/json; charset=UTF-8');

$logger = LoggerFactory::getLogger('pv.main');

if (!Loader::includeModule('pv.main')) {
    $logger->error('Module pv.main is not installed.');
    echo Json::encode([
        'success' => false,
        'error'   => 'Module pv.main is not installed.',
    ]);
    die();
}

try {
    $request = Application::getInstance()->getContext()->getRequest();

    $logger->debug('News API request received.', [
        'page'     => $request->get('page'),
        'pageSize' => $request->get('pageSize'),
        'q'        => $request->get('q'),
        'sort'     => $request->get('sort'),
    ]);

    $service = new NewsService();

    $data = $service->getNewsList([
        'page'     => $request->get('page'),
        'pageSize' => $request->get('pageSize'),
        'query'    => $request->get('q'),
        'sort'     => $request->get('sort'),
    ]);

    echo Json::encode([
        'success' => true,
        'data'    => $data,
    ]);
} catch (\Throwable $throwable) {
    $logger->error('News API error.', [
        'message' => $throwable->getMessage(),
        'file'    => $throwable->getFile(),
        'line'    => $throwable->getLine(),
    ]);

    echo Json::encode([
        'success' => false,
        'error'   => $throwable->getMessage(),
    ]);
}

require $_SERVER['DOCUMENT_ROOT'] . '/bitrix/modules/main/include/epilog_after.php';
