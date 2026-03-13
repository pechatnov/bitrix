<?php
require $_SERVER['DOCUMENT_ROOT'] . '/bitrix/header.php';
/** @var CMain $APPLICATION */

$APPLICATION->SetTitle('Главная');
?>

<div id="pv-main-app">
    <!-- Hero Section -->
    <section class="pv-hero">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-8">
                    <div class="pv-hero-badge">
                        PV / MAIN MODULE
                    </div>
                    <h1>
                        Bitrix пет-проект
                    </h1>
                    <p class="lead">
                        Модульная архитектура, современный стек технологий и соблюдение best practices.
                        Проект демонстрирует применение PSR-стандартов, Vue 3 и логирования в экосистеме 1С-Битрикс.
                    </p>
                    <div class="d-flex gap-3 mt-4">
                        <pv-button-primary tag="a" href="/contacts/">
                            Контакты
                        </pv-button-primary>
                        <pv-button-outline tag="a" href="/personal/" class="pv-btn-outline-light">
                            Личный кабинет
                        </pv-button-outline>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- News Section -->
    <pv-section class="container">
        <div class="pv-section-header">
            <h2>Последние новости</h2>
            <p>Актуальная информация из инфоблока с возможностью фильтрации и сортировки</p>
        </div>

        <div class="d-flex flex-wrap justify-content-end align-items-center mb-4 gap-2">
            <input
                type="search"
                class="form-control pv-form-control"
                placeholder="Поиск по новостям"
                v-model="newsFilter.query"
                style="max-width: 250px;"
            >
            <select
                class="form-select pv-form-control"
                style="max-width: 200px;"
                v-model="newsFilter.sort"
            >
                <option value="date_desc">Сначала новые</option>
                <option value="date_asc">Сначала старые</option>
                <option value="title_asc">По заголовку (А–Я)</option>
            </select>
        </div>

        <div class="row g-4">
            <div class="col-md-6" v-for="item in newsItems" :key="item.id">
                <div class="pv-news-card">
                    <div class="pv-card-body">
                        <span class="pv-news-badge">Новость</span>
                        <h3 class="pv-news-title">{{ item.title }}</h3>
                        <p class="pv-news-preview mb-3">
                            {{ item.preview }}
                        </p>
                        <div class="d-flex justify-content-between align-items-center">
                            <a href="#" class="pv-news-link">Подробнее →</a>
                            <span class="text-muted small">{{ item.date }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <nav class="mt-4 d-flex justify-content-center">
            <ul class="pagination mb-0">
                <li class="page-item" :class="{ disabled: newsPagination.page === 1 }">
                    <button class="page-link" type="button" @click="loadNews(newsPagination.page - 1)">
                        ← Назад
                    </button>
                </li>
                <li class="page-item active">
                    <span class="page-link">
                        {{ newsPagination.page }}
                    </span>
                </li>
                <li class="page-item">
                    <button class="page-link" type="button" @click="loadNews(newsPagination.page + 1)">
                        Вперед →
                    </button>
                </li>
            </ul>
        </nav>
    </pv-section>

    <!-- Contact Form Section -->
    <pv-section class="container">
        <div class="row g-4">
            <div class="col-lg-8">
                <pv-card>
                    <div class="pv-section-header">
                        <h2>Обратная связь</h2>
                        <p>Свяжитесь с нами для получения дополнительной информации</p>
                    </div>
                    <form>
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label for="pv-feedback-name" class="form-label fw-semibold">Имя</label>
                                <input 
                                    type="text" 
                                    class="form-control pv-form-control" 
                                    id="pv-feedback-name" 
                                    placeholder="Ваше имя"
                                >
                            </div>
                            <div class="col-md-6">
                                <label for="pv-feedback-email" class="form-label fw-semibold">E-mail</label>
                                <input 
                                    type="email" 
                                    class="form-control pv-form-control" 
                                    id="pv-feedback-email" 
                                    placeholder="name@company.com"
                                >
                            </div>
                            <div class="col-12">
                                <label for="pv-feedback-message" class="form-label fw-semibold">Сообщение</label>
                                <textarea 
                                    class="form-control pv-form-control" 
                                    id="pv-feedback-message" 
                                    rows="5" 
                                    placeholder="Ваше сообщение"
                                ></textarea>
                            </div>
                        </div>
                        <div class="mt-4">
                            <pv-button-primary type="submit">
                                Отправить сообщение
                            </pv-button-primary>
                        </div>
                    </form>
                </pv-card>
            </div>
            <div class="col-lg-4">
                <pv-card class="mb-4">
                    <h3 class="h5 mb-3 fw-bold">О проекте</h3>
                    <p class="pv-text-muted mb-0">
                        Демонстрационный проект на платформе 1С-Битрикс, реализующий современные подходы
                        к разработке с использованием модульной архитектуры и актуального стека технологий.
                    </p>
                </pv-card>
                <pv-card>
                    <h3 class="h5 mb-3 fw-bold">Технологии</h3>
                    <ul class="list-unstyled mb-0">
                        <li class="mb-2 pv-text-muted">
                            <i class="bi bi-lightning-charge-fill me-2"></i>Vue 3 (Bitrix Core)
                        </li>
                        <li class="mb-2 pv-text-muted">
                            <i class="bi bi-palette-fill me-2"></i>Bootstrap 5
                        </li>
                        <li class="mb-2 pv-text-muted">
                            <i class="bi bi-code-square me-2"></i>PSR Standards
                        </li>
                        <li class="mb-2 pv-text-muted">
                            <i class="bi bi-journal-text me-2"></i>Monolog Logging
                        </li>
                        <li class="mb-0 pv-text-muted">
                            <i class="bi bi-gear-fill me-2"></i>Gulp Build System
                        </li>
                    </ul>
                </pv-card>
            </div>
        </div>
    </pv-section>
</div>

<?php
require $_SERVER['DOCUMENT_ROOT'] . '/bitrix/footer.php';
