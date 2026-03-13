<?php
require $_SERVER['DOCUMENT_ROOT'] . '/bitrix/header.php';
/** @var CMain $APPLICATION */

$APPLICATION->SetTitle('Контакты');
?>

<section class="pv-section container">
    <div class="row">
        <div class="col-lg-4 mb-4">
            <pv-card>
                <h1 class="h4 mb-3">Как нас найти</h1>
                <p class="mb-1"><strong>Адрес</strong></p>
                <p class="text-muted">
                    Город N, ул. Примерная, д. 1
                </p>

                <p class="mb-1"><strong>Телефон</strong></p>
                <p class="text-muted">
                    +7 (999) 999-99-99
                </p>

                <p class="mb-1"><strong>E-mail</strong></p>
                <p class="text-muted">
                    info@example.com
                </p>

                <p class="mb-1"><strong>Режим работы</strong></p>
                <p class="text-muted mb-0">
                    Пн–Пт: 10:00–19:00<br>
                    Сб–Вс: выходной
                </p>
            </pv-card>
        </div>

        <div class="col-lg-8 mb-4">
            <?php
            $APPLICATION->IncludeComponent(
                'pv:contacts.map',
                '',
                [],
                false
            );
            ?>
        </div>
    </div>
</section>

<?php
require $_SERVER['DOCUMENT_ROOT'] . '/bitrix/footer.php';

