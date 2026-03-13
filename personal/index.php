<?php
require $_SERVER['DOCUMENT_ROOT'] . '/bitrix/header.php';
/** @var CMain $APPLICATION */

$APPLICATION->SetTitle('Личный кабинет');
?>

<section class="pv-section container">
    <div class="row">
        <div class="col-lg-3 mb-4">
            <pv-card>
                <div class="list-group list-group-flush">
                    <a href="#" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center active">
                        Профиль
                        <span class="badge bg-light text-dark rounded-pill">you</span>
                    </a>
                    <a href="#" class="list-group-item list-group-item-action">
                        Безопасность
                    </a>
                    <a href="#" class="list-group-item list-group-item-action">
                        Уведомления
                    </a>
                    <a href="#" class="list-group-item list-group-item-action">
                        Настройки
                    </a>
                </div>
            </pv-card>
        </div>

        <div class="col-lg-9 mb-4">
            <pv-card class="mb-4">
                <h1 class="h4 mb-3">Профиль пользователя</h1>
                <p class="text-muted mb-4">
                    Здесь будет компонент личного кабинета (например, `bitrix:main.profile` или Vue-приложение).
                </p>

                <form>
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label for="pv-profile-name" class="form-label">Имя</label>
                            <input type="text" class="form-control" id="pv-profile-name" placeholder="Иван">
                        </div>
                        <div class="col-md-6">
                            <label for="pv-profile-lastname" class="form-label">Фамилия</label>
                            <input type="text" class="form-control" id="pv-profile-lastname" placeholder="Иванов">
                        </div>
                        <div class="col-md-6">
                            <label for="pv-profile-email" class="form-label">E-mail</label>
                            <input type="email" class="form-control" id="pv-profile-email" placeholder="name@example.com">
                        </div>
                        <div class="col-md-6">
                            <label for="pv-profile-phone" class="form-label">Телефон</label>
                            <input type="tel" class="form-control" id="pv-profile-phone" placeholder="+7 (999) 999-99-99">
                        </div>
                    </div>

                    <div class="d-flex justify-content-between align-items-center mt-4">
                        <pv-button-primary type="submit">
                            Сохранить изменения
                        </pv-button-primary>
                        <pv-button-outline type="button">
                            Выйти
                        </pv-button-outline>
                    </div>
                </form>
            </pv-card>

            <pv-card>
                <h2 class="h5 mb-3">Активность</h2>
                <p class="text-muted mb-0">
                    Здесь можно вывести историю действий пользователя, подписки, заказы и т.д.
                </p>
            </pv-card>
        </div>
    </div>
</section>

<?php
require $_SERVER['DOCUMENT_ROOT'] . '/bitrix/footer.php';

