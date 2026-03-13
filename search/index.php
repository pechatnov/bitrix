<?php
require $_SERVER['DOCUMENT_ROOT'] . '/bitrix/header.php';
/** @var CMain $APPLICATION */

$APPLICATION->SetTitle('Поиск');
?>

<section class="pv-section container">
    <div class="row">
        <div class="col-lg-4 mb-4">
            <pv-card>
                <h1 class="h4 mb-3">Поиск по сайту</h1>
                <form>
                    <div class="mb-3">
                        <label for="pv-search-query" class="form-label">Что ищем?</label>
                        <input
                            type="search"
                            class="form-control"
                            id="pv-search-query"
                            placeholder="Название новости, раздела или документа"
                        >
                    </div>
                    <div class="mb-3">
                        <label for="pv-search-section" class="form-label">Раздел</label>
                        <select id="pv-search-section" class="form-select">
                            <option value="">Везде</option>
                            <option value="news">Новости</option>
                            <option value="pages">Страницы</option>
                            <option value="docs">Документы</option>
                        </select>
                    </div>
                    <pv-button-primary type="submit" class="w-100">
                        Найти
                    </pv-button-primary>
                </form>
            </pv-card>
        </div>

        <div class="col-lg-8 mb-4">
            <pv-card>
                <h2 class="h5 mb-3">Результаты поиска</h2>
                <p class="text-muted mb-0">
                    Результаты появятся здесь. Позже сюда можно подключить компонент поиска Битрикс или Vue-приложение.
                </p>
            </pv-card>
        </div>
    </div>
</section>

<?php
require $_SERVER['DOCUMENT_ROOT'] . '/bitrix/footer.php';

