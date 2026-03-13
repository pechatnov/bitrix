<?php
include_once $_SERVER['DOCUMENT_ROOT'] . '/bitrix/modules/main/include/urlrewrite.php';

CHTTP::SetStatus('404 Not Found');
@define('ERROR_404', 'Y');

require $_SERVER['DOCUMENT_ROOT'] . '/bitrix/header.php';
/** @var CMain $APPLICATION */

$APPLICATION->SetTitle('Страница не найдена');
?>

<div class="row justify-content-center">
    <div class="col-md-8 col-lg-6">
        <div class="card shadow-sm text-center py-5">
            <div class="card-body">
                <p class="display-5 fw-semibold mb-2">404</p>
                <p class="h5 mb-3">Страница не найдена</p>
                <p class="text-muted mb-4">
                    Возможно, страница была удалена, переименована или никогда не существовала.
                </p>
                <div class="d-flex justify-content-center gap-2">
                    <pv-button-primary tag="a" href="/">
                        На главную
                    </pv-button-primary>
                    <pv-button-outline tag="a" href="/search/">
                        Поиск по сайту
                    </pv-button-outline>
                </div>
            </div>
        </div>
    </div>
</div>
