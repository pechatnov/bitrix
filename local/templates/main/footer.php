    </main>

    <footer class="py-5 mt-5">
        <div class="container">
            <div class="row">
                <div class="col-md-4 mb-4 mb-md-0">
                    <h5 class="mb-3">PV | MAIN</h5>
                    <p class="pv-text-muted small mb-0">
                        Профессиональный пет-проект на платформе 1С-Битрикс.
                        Демонстрация современных подходов к разработке с использованием
                        модульной архитектуры и актуального стека технологий.
                    </p>
                </div>
                <div class="col-md-3 mb-4 mb-md-0">
                    <h6 class="mb-3">Навигация</h6>
                    <ul class="list-unstyled">
                        <li class="mb-2">
                            <a href="/" class="text-decoration-none small">
                                <i class="bi bi-house-door me-2"></i>Главная
                            </a>
                        </li>
                        <li class="mb-2">
                            <a href="/search/" class="text-decoration-none small">
                                <i class="bi bi-search me-2"></i>Поиск
                            </a>
                        </li>
                        <li class="mb-2">
                            <a href="/contacts/" class="text-decoration-none small">
                                <i class="bi bi-envelope me-2"></i>Контакты
                            </a>
                        </li>
                        <li class="mb-2">
                            <a href="/personal/" class="text-decoration-none small">
                                <i class="bi bi-person me-2"></i>Личный кабинет
                            </a>
                        </li>
                    </ul>
                </div>
                <div class="col-md-3 mb-4 mb-md-0">
                    <h6 class="mb-3">Технологии</h6>
                    <ul class="list-unstyled small pv-text-muted">
                        <li class="mb-2">
                            <i class="bi bi-box me-2"></i>1С-Битрикс
                        </li>
                        <li class="mb-2">
                            <i class="bi bi-lightning-charge me-2"></i>Vue 3
                        </li>
                        <li class="mb-2">
                            <i class="bi bi-palette me-2"></i>Bootstrap 5
                        </li>
                        <li class="mb-2">
                            <i class="bi bi-code-square me-2"></i>PSR Standards
                        </li>
                        <li class="mb-2">
                            <i class="bi bi-journal-text me-2"></i>Monolog
                        </li>
                    </ul>
                </div>
                <div class="col-md-2">
                    <h6 class="mb-3">Связь</h6>
                    <pv-button-outline 
                        tag="button"
                        type="button"
                        data-bs-toggle="modal"
                        data-bs-target="#pv-feedback-modal"
                    >
                        <i class="bi bi-chat-dots me-2"></i>Связаться
                    </pv-button-outline>
                </div>
            </div>
            <hr class="my-4">
            <div class="d-flex flex-column flex-md-row justify-content-between align-items-center">
                <p class="pv-text-muted small mb-2 mb-md-0">
                    &copy; <?= date('Y') ?> PV.MAIN. Все права защищены.
                </p>
                <p class="pv-text-muted small mb-0">
                    Разработано на платформе 1С-Битрикс
                </p>
            </div>
        </div>
    </footer>

    <div id="pv-feedback-vue-root"></div>

    <script
        src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"
    ></script>

    <script src="/local/templates/main/build/app.js"></script>
</body>
</html>
