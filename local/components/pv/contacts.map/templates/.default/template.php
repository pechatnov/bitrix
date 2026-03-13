<?php
if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) {
    die();
}

/**
 * @var array<string, mixed> $arResult
 */
?>

<div class="card shadow-sm h-100">
    <div class="card-body">
        <h2 class="h5 mb-3">Карта</h2>
        <p class="text-muted mb-3">
            Здесь может быть карта Яндекс или другой сервис. Сейчас — заглушка с координатами.
        </p>

        <div class="border rounded-3 bg-body-secondary d-flex align-items-center justify-content-center"
             style="height: 320px;">
            <div class="text-center">
                <div class="mb-2">
                    <span class="badge bg-dark-subtle text-dark-emphasis">
                        LAT: <?= htmlspecialcharsbx((string)$arResult['LAT']) ?>,
                        LNG: <?= htmlspecialcharsbx((string)$arResult['LNG']) ?>
                    </span>
                </div>
                <p class="text-muted mb-1">
                    Здесь будет подключен JS SDK карты.
                </p>
                <p class="small text-muted mb-0">
                    Компонент написан в стиле D7 и не использует Vue.
                </p>
            </div>
        </div>
    </div>
</div>

